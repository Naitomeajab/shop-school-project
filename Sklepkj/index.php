<?php
    $conn = mysqli_connect("localhost", "root", "", "sklepkj");

    //Weryfikacja czy istnieje cookie wskazujący o zalogowaniu na konto
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
    <link rel="icon" type="image/x-icon" href="grafiki/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="top-banner">
        <img width="60%" height="60%" src="grafiki/banery/top-banner.jpg">
    </div>
    <div id="header-grid-container">
        <div class="grid-container">
            <div id="logo">
                <a href="index.php"><img class="center" src="grafiki/logo.jpg" width="212px" height="52px"></a>
            </div>
            <div id="search-bar">
                <form action="podstrony/search.php">
                    <input type="text" placeholder="Czego szukasz?" name="search">
                    <button type="submit">
                        <i class="bi bi-search icon-styling" style="font-size: 28px; color: black;"></i>
                    </button>
                </form>
            </div>
            <!-- Lista ikon, zmieniająca się odpowiednio w zależności od posiadanego cookie "zamówienia" oraz cookie "zalogowany" -->
            <div id="icons">
                <div class="icons-koszyk"><a href="podstrony/koszyk.php">
                <?php    
                    if(isset($_COOKIE["koszyk"])) {
                        echo '<i class="bi bi-cart-fill"></i>';
                    } else {
                        echo '<i class="bi bi-cart"></i>';
                    }
                ?>
                </a></div>
                <div class="icons-logowanie"><a href="podstrony/login.php" id="login">
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
                    echo '<a href="processes/logout.php">Wyloguj się</a>';
                    echo '</div>';
                } else {
                    echo '<i class="bi bi-person"></i>Zaloguj się</a>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-container">
        <!-- Pierwszy banner jaki użytkownik ma zobaczyć powinien być umieszczany pod wszystkimi innymi. -->
        <!-- banner2 jest nakładany na banner3, a banner1 na banner2 -->
        <div class="banner-container" id="bannerContainer">
            <div class="promotion-banner all-transitions" id="banner3" onclick="promotion(3);">
                <img height="100% width="100%" src="grafiki/banery/G29-promocja.jpg">
            </div>
            <div class="promotion-banner all-transitions" id="banner2" onclick="promotion(2);">
                <img height="100%" width="100%" src="grafiki/banery/G413-promocja.jpg">
            </div>
            <div class="promotion-banner all-transitions" id="banner1" onclick="promotion(1);">
                <img height="100%" width="100%" src="grafiki/banery/razer-promocja.jpg">
            </div>
        </div>
        <div class="category-container" id="filterList">
            <div class="category-item all-transitions" onclick="category(0)"><i class="bi bi-display" ></i><p>Monitory</p></div>
            <div class="category-item all-transitions" onclick="category(1)"><i class="bi bi-mouse2"></i><p>Myszki</p></div>
            <div class="category-item all-transitions" onclick="category(2)"><i class="bi bi-keyboard" ></i><p>Klawiatury</p></div>
            <div class="category-item all-transitions" onclick="category(3)"><i class="bi bi-speaker" ></i><p>Głosniki</p></div>
            <div class="category-item all-transitions" onclick="category(4)"><i class="bi bi-webcam" ></i><p style="font-size: 18px">Kamery internetowe</p></div>
            <div class="category-item all-transitions" onclick="category(5)"><i class="bi bi-mic" ></i><p>Mikrofony</p></div>
            <div class="category-item all-transitions" onclick="category(6)"><i class="bi bi-headset" ></i><p>Słuchawki</p></div>
            <div class="category-item all-transitions" onclick="category(7)"><i class="bi bi-usb-drive" ></i><p>Pendrive'y</p></div>
            <div class="category-item all-transitions" onclick="category(8)"><i class="bi bi-hdd" ></i><p style="font-size: 18px">Dyski zewnęrzne</p></div>
            <div class="category-item all-transitions" onclick="category(9)"><i class="bi bi-joystick" ></i><p style="font-size: 18px">Kierownice do gier</p></div>
        </div>
        <div class="new-product-container">
            <h1>NOWE PRODUKTY</h1>
            <div><i class="bi bi-caret-left-fill new-products-button all-transitions" id="new-button-left" onclick="scrollNewItems(0)" style="opacity: 0.2;"></i></div>
            <div><i class="bi bi-caret-right-fill new-products-button all-transitions" id="new-button-right" onclick="scrollNewItems(1)"></i></div>
            <?php
            // Skrypt pobiera potrzebne dane na temat ośmiu najnowszych (z największą wartością "ID_produktu") produktów
            // Następnie dla każdego kontenera produktu przypisuje ID dla skryptu new_products.js, oraz początkowe przesunięcie (style="left: ")
            // Poczym układa wszystkie dane/grafiki oraz sprawdza czy produkt jest objęty promocją i przypisując odpowiednią cenę
            //
            // Bloki produktu mają właściwość css: "position: absolute", to w połączeniu z blokiem głownym i jego właściwością: "position: relative",
            // umożliwia niezależne od rozmiarów położenie każdego kontenera produktu, a jednocześnie umożliwia łatwe manipulowanie położeniem skryptom 
            $sql = 'SELECT nazwa_produktu, typ, fotografia, cena_netto, promocja, cena_netto_promocja FROM produkty ORDER BY data_dodania DESC, ID_produktu DESC LIMIT 8;';
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $temp = 1;
                $left = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="new-product all-transitions" id="newItem'.$temp.'" style="left:'.$left."px".'; border-left: #57007F 1px solid;" onclick="referToProduct('."'".$row["nazwa_produktu"]."'".')">';
                    echo '<div style="width:50%; height: 150px; margin: auto;">';
                    echo '<img id="newItemImage'.$temp.'" width="auto" height="150px" src="grafiki/produkty/'.$row["fotografia"].'">';
                    echo '</div>';
                    echo '<p>'.$row["typ"].'<br>';
                    echo '<span style="font-size: 26px;">'.$row["nazwa_produktu"].'</span></p>';
                    if ($row["promocja"] == "True") {
                        echo '<p style=";font-size: 26px;"><del>'.$row["cena_netto"].'zł</del><span style="color: red;font-size: 40px;"><b> '.$row["cena_netto_promocja"].'zł</b></span></p></div>';  
                    } else {
                        echo '<p style="color: red;font-size: 26px;"><b>'.$row["cena_netto"].'zł</b></p></div>';
                    }
                    $temp++;
                    $left += 400;
                }
            }
            ?>
        </div>
    </div>
    <script src="skrypty/kategorie.js"></script>
    <script src="skrypty/banner.js"></script>
    <script src="skrypty/new_products.js"></script>
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
        function referToProduct(item) {
            item = item.split(' ').join('+');
            console.log(item);
            window.open("podstrony/produkt.php?productName="+item, "_self")
        }
    </script>
</body>
</html>

<?php
    mysqli_close($conn);
?>