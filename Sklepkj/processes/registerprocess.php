<?php
// Skrypt zbiera dane z formularza i sprawdza ich poprawność
// Następnie weryfikuje czy nazwa użytkownika nie znajduję się już w bazie danych
// Jeżeli nazwa jest wolna, skrypt szyfruje hasło i przesyła wszystkie dane (nazwa, email, zaszyfrowane hasło) do bazy danych
// Na końcu tworzy cookie o zalogowaniu się i przekierowuje na stronę głowną
$conn = mysqli_connect("localhost", "root", "", "sklepkj");
$username = $_POST["nazwa_uzytkownika"];
$email = $_POST["mail"];
$password = $_POST["passw"];
$correct = 0;

//username
$pattern = '/^[a-zA-Z0-9]{8,64}+$/';
if(preg_match($pattern, $username)) {
    $correct += 1;
}
//password
if(preg_match($pattern, $password)) {
    $correct += 1;
}
//email
$pattern = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+$/';
if(preg_match($pattern, $email)) {
    $correct += 1;
}
if($correct < 3) {
    echo "Wykryto błąd w podanych danych";
} else {
    $sql = "SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika = '$username';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0 ){
        echo "Nazwa użytkownika jest już zajęta";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO uzytkownicy (nazwa_uzytkownika, email, haslo)
                VALUES ('$username', '$email', '$password');";
        mysqli_query($conn, $sql);
        echo "Sukces";
        setcookie("logowanie", $username, time() + 3600, "/");
        header("Location: ../index.php");
        exit;
    }
}
mysqli_close($conn);
?>