<?php
    $conn = mysqli_connect("localhost", "root", "", "sklepkj");

    // Ze względu na to, że tylko jeden wynik zostanie otrzymany, można natychmiastowo stworzyć array z danymi
    $product_query = $_GET["productName"];
    $sql = 'SELECT produkty.nazwa_produktu, produkty.opis, produkty.fotografia, produkty.cena_netto, produkty.promocja, produkty.cena_netto_promocja, produkty.ID_produktu, producenci.Nazwa_producenta FROM produkty
            INNER JOIN producenci ON produkty.ID_producenta = producenci.ID_producenta
            WHERE produkty.nazwa_produktu LIKE "'.$product_query.'";';
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($result);
    
    if(isset($_COOKIE["logowanie"])) {
        $username = $_COOKIE["logowanie"];
    } 
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
                <form action="search.php" method="get">
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
    <div class="tree-container"><i class="bi bi-folder-fill"></i> <a href="../index.php">Strona głowna</a>/<span>produkt</span></div>
    <div class="grid-container">
        <!-- Bierze dane z powyżej utworzonego array'u, w je w odpowiednich miejscach -->
        <div class="product-header"><span><?php echo $result["nazwa_produktu"];?></span></div>
        <div class="grid-container-experimental">
            <div class="product-info information">
                <h4>Producent: <?php echo $result["Nazwa_producenta"] ?></h4>
                <p><?php echo $result["opis"]?></p>
            </div>
            <div class="product-image"><img src="<?php echo '../grafiki/produkty/'.$result["fotografia"]?>"></div>
            <div class="product-info purchase" style="text-align: right;">
            <?php
            if($result["promocja"] == "True") {
                echo '<span style="font-size: 26px;"><del>'.$result["cena_netto"].'zł</del></span>';
                echo '<p style="color: red;font-size: 40px;"><b> '.$result["cena_netto_promocja"].'zł</b></p>';
            } else {
                echo '<span style="color: red; font-size: 26px;"><b>'.$result["cena_netto"].'zł</b></span>';
            }
            ?>
            <!-- formularz, w którym zostanie "przemycone" ID_produktu aby produkt mógłby zostać dodany do koszyka dla użytkownika  -->
            <form action="../processes/addtokoszyk.php" method="POST"><input type="hidden" name="product_id" value="<?php echo $result["ID_produktu"];?>">
            <input style="product-info-button" type="submit" value="Dodaj do koszyka"></form>
            </div>
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