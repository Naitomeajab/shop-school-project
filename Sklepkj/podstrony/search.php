<?php
    $conn = mysqli_connect("localhost", "root", "", "sklepkj");

    $search_query = $_GET["search"];

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
    <div class="tree-container"><i class="bi bi-folder-fill"></i> <a href="../index.php">Strona głowna</a>/<span>Wyniki wyszukiwania</span></div>
    <div class="search-header-container">
        <h2>Wyniki wyszukiwania</h2>
        <span>dla zapytania: '<b><?php echo $search_query?></b>'</span>
    </div>
    <div class="grid-container">
        <div class="filters-container">
            <form autocomplete="off">
                <!-- Reset filtrów, czyści wszystkie zaznaczenia oraz wymusza pokazanie się każdego kontenera wyszukanego produktu -->
                <h2>Filtry <input class="filters-reset" type="reset" value="wyczyść filtry" onclick="filterCheck(true)"></h2>
                <?php
                // Skrypt ma na celu zebrać różne wystąpienia producentów, aby następnie przedstawić je jako lista opcji dla filtrów
                $sql = "SELECT producenci.Nazwa_producenta, producenci.ID_producenta FROM produkty
                        INNER JOIN producenci ON producenci.ID_producenta = produkty.ID_producenta
                        WHERE produkty.nazwa_produktu LIKE '%$search_query%' OR produkty.typ LIKE '%$search_query%'
                        GROUP BY producenci.Nazwa_producenta;";
                $result = mysqli_query($conn, $sql);

                echo '<div class="filters-category"><h3>Producent</h3>';
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<label class="filters-option" onclick="filterCheck()">'.$row["Nazwa_producenta"];
                        echo '<input type="checkbox" name="filterProducent" value="'.$row["ID_producenta"].'">';
                        echo '<span class="checkmark"></span></label>';
                    }
                }
                echo '</div>';
                ?>
                <div class="filters-category">
                    <h3>Cena</h3>
                    <label class="filters-option">Do 250zł
                        <input type="radio" name="filterCost" value="0" onclick="filterCheck()">
                        <span class="check-dot"></span>
                    </label>
                    <label class="filters-option">Od 250zł do 500zł
                        <input type="radio" name="filterCost" value="250" onclick="filterCheck()">
                        <span class="check-dot"></span>
                    </label>
                    <label class="filters-option">Od 500zł do 750zł
                        <input type="radio" name="filterCost" value="500" onclick="filterCheck()">
                        <span class="check-dot"></span>
                    </label>
                    <label class="filters-option">Od 750zł do 1000zł
                        <input type="radio" name="filterCost" value="750" onclick="filterCheck()">
                        <span class="check-dot"></span>
                    </label>
                    <label class="filters-option">Od 1000zł
                        <input type="radio" name="filterCost" value="1000" onclick="filterCheck()">
                        <span class="check-dot"></span>
                    </label>
                </div>
                
            </form>
        </div>
        <div class="results-container">
            <?php
            // Skrypt pobiera potrzebne dane produktów pokrywających się z wyszukiwaną treścią (nazwa produktu albo typ), sortując od najnowszych (z największą wartością "ID_produktu"),
            // następnie dla każdego kontenera produktu przypisuje ID dla skryptu filtry.js
            // Poczym układa wszystkie dane/grafiki oraz sprawdza czy produkt jest objęty promocją i przypisując odpowiednią cenę
            // Na końcu tworzy formularz, w którym "przemyca" ID_produktu aby produkt mógłby zostać dodany do koszyka dla użytkownika 
            $sql = "SELECT nazwa_produktu, typ, opis, fotografia, cena_netto, promocja, cena_netto_promocja, ID_produktu, ID_producenta FROM produkty 
                    WHERE nazwa_produktu LIKE '%$search_query%' OR typ LIKE '%$search_query%'
                    ORDER BY ID_produktu DESC;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $temp = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    //przypisanie odpowiedniej ceny (dla funkcji filtry.js)
                    $cena = $row["cena_netto"];
                    if($row["promocja"] == "True") {$cena = $row["cena_netto_promocja"];}
                    echo '<div name="resultProduct" id="resultItem'.$temp.'" class="result-item all-transitions" data-idProducenta="'.$row["ID_producenta"].'" data-cena="'.$cena.'" >';
                    echo '<h2>'.$row["typ"].' '.$row["nazwa_produktu"].'</h2>';
                    // W następnych dwóch kontenerach jest funckja, która używa przesyłania danych GET, aby przesłać nazwę produktu na stronę produkt.php
                    echo '<div class="result-item-content image" onclick="referToProduct('."'".$row["nazwa_produktu"]."'".')"><img height="150px" width="auto" src="../grafiki/produkty/'.$row["fotografia"].'"></div>';
                    echo '<div class="result-item-content desc" onclick="referToProduct('."'".$row["nazwa_produktu"]."'".')"><span>'.$row["opis"].'</span></div>';
                    echo '<div class="result-item-content price"><div style="height: 100px;">';
                    if($row["promocja"] == "True") {
                        echo '<span style="font-size: 26px;"><del>'.$row["cena_netto"].'zł</del></span>';
                        echo '<p style="color: red;font-size: 40px;"><b> '.$row["cena_netto_promocja"].'zł</b></p>';
                    } else {
                        echo '<span style="color: red; font-size: 26px;"><b>'.$row["cena_netto"].'zł</b></span>';
                    }
                    echo '</div>';
                    echo '<form action="../processes/addtokoszyk.php" method="POST"><input type="hidden" name="product_id" value="'.$row["ID_produktu"].'" >';
                    echo '<input class="all-transitions" type="submit" value="Dodaj do koszyka"></form>';
                    echo '</div>';                  
                    echo '</div>';
                    $temp++;
                }
            } else {
                echo "<h1>Nie znaleziono żandych produktów<h1>";
            }
            ?>
        </div>
    </div>
    <script src="../skrypty/filtry.js"></script>
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
        //skrypt zastępuje spacje znakiem "+"
        function referToProduct(item) {
            item = item.split(' ').join('+');
            console.log(item);
            window.open("produkt.php?productName="+item, "_self")
        }
    </script>
</body>
</html>

<?php
    mysqli_close($conn);
?>