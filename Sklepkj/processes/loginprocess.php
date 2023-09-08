<?php
// Skrypt zbiera dane z formularza i porównuje je z obecnymi wpisami w bazie danych
// Jeżeli nazwa użytkownika została znaleziona, skrypt pobiera zaszyfrowane hasło, następnie je weryfikująć z tym,
// wpisanym przez użytkownika. Jeżeli hasła się pokryją, tworzy cookie informujący o zalogowaniu użytkownika
// sprawdzająć na końcu czy użytkownik ma jakieś produkty w koszyku i ponownie tworząc odpowiedni plik cookie
// kończąc na przekierowaniu na stronę głowną
$conn = mysqli_connect("localhost", "root", "", "sklepkj");

$nazwa_uzytkownika = $_POST["nazwa_uzytkownika"];
$haslo = $_POST["passw"];

$sql = "SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika = '$nazwa_uzytkownika'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0 ){
    echo "Nie znaleziono nazwy użytkownika";
} else {
    $result = mysqli_fetch_array($result);
    if (password_verify($haslo, $result["haslo"])) {
        echo "sukces";
        setcookie("logowanie", $nazwa_uzytkownika, time() + 3600, "/");
        $sql = "SELECT * FROM zamowienia WHERE ID_uzytkownika IN (SELECT ID_uzytkownika FROM uzytkownicy WHERE nazwa_uzytkownika='$nazwa_uzytkownika');";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 1 ){
            setcookie("koszyk", True, time() + 3600, "/");
        }
        header("Location: ../index.php");
        exit;
    } else {
        echo "haslo zle";
    }
}

mysqli_close($conn);
?>