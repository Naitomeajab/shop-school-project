<?php
    $conn = mysqli_connect("localhost", "root", "", "sklepkj");

    if(isset($_COOKIE["logowanie"])) {
        $username = $_COOKIE["logowanie"];
    } else {
        header("Location: login.php");
        exit;
    } 
    $userIDsql = "SELECT zamowienia.ID_uzytkownika FROM zamowienia
                INNER JOIN produkty ON zamowienia.ID_produktu = produkty.ID_produktu
                WHERE zamowienia.ID_uzytkownika IN (SELECT ID_uzytkownika FROM uzytkownicy WHERE nazwa_uzytkownika = '$username')
                LIMIT 1";
    $userID = mysqli_query($conn, $userIDsql);
    $userID = mysqli_fetch_array($userID);

    $inventory_sql = "SELECT COUNT(produkty.ID_produktu) AS ilosc, produkty.*, zamowienia.ID_uzytkownika FROM produkty 
                INNER JOIN zamowienia ON zamowienia.ID_produktu = produkty.ID_produktu
                WHERE zamowienia.ID_uzytkownika IN (SELECT ID_uzytkownika FROM uzytkownicy WHERE nazwa_uzytkownika = '$username')
                GROUP BY produkty.ID_produktu;";
    $inventory_result = mysqli_query($conn, $inventory_sql);
            
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Komputronex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../grafiki/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <div class="top-banner">
        <img width="60%" height="60%" src="../grafiki/banery/top-banner.jpg">
    </div>
    <div id="header-grid-container">
        <div class="grid-container">
            <div id="logo">
                <a href="../index.php"><img class="center" src="../grafiki/logo.jpg" width="212px" height="52px"></a>
            </div>
            <div id="search-bar">
                <form action="search.php">
                    <input type="text" placeholder="Czego szukasz?" name="search">
                    <button type="submit">
                        <i class="bi bi-search icon-styling" style="font-size: 28px; color: black;"></i>
                    </button>
                </form>
            </div>
            <div id="icons">
            <div class="icons-koszyk"><a href="koszyk.php">
                <!-- Lista ikon, zmieniająca się odpowiednio w zależności od posiadanego cookie "zamówienia" oraz cookie "zalogowany" -->
                <?php    
                    if(isset($_COOKIE["koszyk"])) {
                        echo '<i class="bi bi-cart-fill"></i>';
                    } else {
                        echo '<i class="bi bi-cart"></i>';
                    }
                ?>
                </a></div>
                <div class="icons-logowanie"><a href="login.php" id="login">
                <?php 
                if(isset($username)) {
                    echo '<i class="bi bi-person-fill"></i>';
                    if(strlen($username) > 10) {
                        echo '<span style="font-size: 22px;">'.$username.'</span></a>';
                    } else {
                        echo '<span>'.$username.'</span></a>';
                    }
                    echo '<div class="wyloguj-sie">';
                    echo '<a href="#">PLACEHOLDER</a>';
                    echo '<a href="../processes/logout.php">Wyloguj się</a>';
                    echo '</div>';
                } else {
                    echo '<i class="bi bi-person"></i>Zaloguj się</a>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="tree-container"><i class="bi bi-folder-fill"></i> <a href="../index.php">Strona głowna</a>/<span>Koszyk</span></div>
    <div class="koszyk-header">
    <?php
        $sql = "SELECT * FROM zamowienia WHERE ID_uzytkownika IN (SELECT ID_uzytkownika FROM uzytkownicy WHERE nazwa_uzytkownika='$username');";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0 ){
            echo "<h2>Koszyk użytkownika: ".$username."</h2>";
            echo "<p>".mysqli_num_rows($result)." Wpisów</p>";
        } else {
            echo "<h2>Twój koszyk jest pusty</h2>";
        }
    ?>
    </div>
    <div class="koszyk-grid">
        <div class="koszyk-inventory">
        <?php
            $koszt = 0;
            if (mysqli_num_rows($inventory_result) > 0 ){
                while($row = mysqli_fetch_assoc($inventory_result)) {
                    echo '<div class="koszyk-inventory-item">';

                    echo '<div class="koszyk-inventory-opis">';
                    echo '<h2>'.$row["nazwa_produktu"].' ('.$row["ilosc"].'szt.)</h2>';
                    $cena = 0;
                    if ($row["promocja"] == "True") {
                        echo '<span style="font-size: 26px;"><del>'.$row["cena_netto"].'zł</del></span>';
                        echo '<span style="color: red;font-size: 40px;"><b>'.$row["cena_netto_promocja"].'zł</b></span>';
                        $cena = $row["cena_netto_promocja"] * $row["ilosc"];
                        $koszt += $cena;
                    } else {
                        echo '<span style="color: red;font-size: 26px;"><b>'.$row["cena_netto"].'</b></span>';
                        $cena = $row["cena_netto"] * $row["ilosc"];
                        $koszt += $cena;
                    }
                    echo '<span style="font-size: 26px;"> X '.$row["ilosc"].' = </span>';
                    echo '<span style="color: #57007F;font-size: 40px;"><b>'.$cena.'zł</b></span>';

                    echo '</div>';

                    echo '<div class="koszyk-inventory-image">';
                    echo '<img height="100px" width="auto" src="../grafiki/produkty/'.$row["fotografia"].'">';
                    echo '</div>';
                    echo '</div>';
                }
            }
            if ($koszt >= 500) {
                $dostawa = '<del>29zł</del> <span style="color: #57007F"><b>0zł</b><span>';
                $laczny_koszt = $koszt;
            } else {
                $dostawa = '29zł';
                $laczny_koszt = $koszt + 29;
            }
        ?>
        </div>
        <div class="koszyk-checkout" <?php if(mysqli_num_rows($inventory_result) == 0) {echo 'style="display: none;"';}?>>
        <?php
        // if (isset($koszt) && isset($dostawa) && isset($laczny_koszt)) {
        //     echo "yes";
        // }
        ?>
        <table>
            <tr>
                <td>Produkty: </td>
                <td><?php echo $koszt.'zł'?></td>
            </tr>
            <tr>
                <td>Dostawa:</td>
                <td><?php echo $dostawa?></td>
            </tr>
            <tr style="border-top: 1px solid black;">
                <td>Do zapłaty:</td>
                <td><?php  echo $laczny_koszt.'zł'?></td>
            </tr>
        </table>
        <form action="../processes/clearkoszyk.php" method="post">
            <input type="hidden" name="id" value="<?php echo $userID["ID_uzytkownika"]?>">
            <input class="all-transitions" type="submit" value="Złóż zamówienie"> 
        </form>
        </div>
    </div>
    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("header-grid-container");
        var fixedthreshold = navbar.offsetTop;
        // Skrypt uruchamia się kiedy kontener z logiem zaczyna wychodzić poza okno przeglądarki
        // Przypisuje kontenerowi właściwość, która powoduje że kontener jest w stałym miejscu niezależnie od przesunięcia (scroll'a) zawartości strony
        function myFunction() {
            if (window.pageYOffset >= fixedthreshold) {
                navbar.classList.add("fixed-header")
            } else {
                navbar.classList.remove("fixed-header");
            }
        }
    </script>
</body>
</html>

<?php
    mysqli_close($conn);
?>