<?php
// Skrypt początkowo sprawdza czy użytkownik jest zalogowany
// Następnie pobiera ID_użytkownika bazująć na nazwię zapisanej w cookie oraz pobiera ID_produktu
// Dodaje wpis do tabeli "zamowienia" oraz tworzy cookie, które oznacza, czy użytkownik ma przynajmniej jeden produkt w koszyku.
// Następnie przekierowuje na stronę głowną 
$conn = mysqli_connect("localhost", "root", "", "sklepkj");
if(isset($_COOKIE["logowanie"])) {
    $username = $_COOKIE["logowanie"];
} else {
    header("Location: ../podstrony/login.php");
    exit;
}
$sql = "SELECT ID_uzytkownika FROM uzytkownicy WHERE nazwa_uzytkownika = '$username'";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($result);
$username = $result["ID_uzytkownika"];
$produkt = $_POST["product_id"];
$sql = "INSERT INTO zamowienia (ID_uzytkownika, ID_produktu)
        VALUES ($username, $produkt);";
mysqli_query($conn, $sql);
setcookie("koszyk", True, time() + 3600, "/");
header("Location: ../index.php");
exit;

?>