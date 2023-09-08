<?php
if(isset($_COOKIE["logowanie"])) {
    header("Location: ../index.php");
    exit;
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
                <form action="search.php">
                    <input type="text" placeholder="Czego szukasz?" name="search">
                    <button type="submit">
                        <i class="bi bi-search icon-styling" style="font-size: 28px; color: black;"></i>
                    </button>
                </form>
            </div>
            <div id="icons">
                <a href="koszyk.php"><i class="bi bi-cart"></i></a>  
                <a href="login.php" id="login"><i class="bi bi-person"></i>
                Zaloguj się</a>
            </div>
        </div>
    </div>
    <div class="tree-container"><i class="bi bi-folder-fill"></i> <a href="../index.php">Strona głowna</a>/<span>login</span></div>
    <div style="width: 500px;margin: auto;" >
        <!-- Standardowy formularz -->
        <form action="../processes/loginprocess.php" method="post">
            <h2>Formularz logowania</h2>
            <div class="login-container">
                <i class="bi bi-person-fill login-icon"></i>
                <input type="text" name="nazwa_uzytkownika" placeholder="Nazwa użytkownika">
            </div>
            <div class="login-container">
                <i class="bi bi-key-fill login-icon"></i>
                <input type="password" name="passw" placeholder="Hasło">
            </div>
            <button class="login-container-button">Potwierdź</button>   
        </form>
    </div>
    <a href="register.php">Nie masz jeszcze konta? Zarejestruj się!</a>
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
