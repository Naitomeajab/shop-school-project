<?php
// Usuwa wszystkie pliki cookie (poprzez podanie daty ważności w przeszłości)
// Następnie przekierowuje na stronę głowną
if(isset($_COOKIE["logowanie"])) {
    setcookie("logowanie", "", time() - 3600, "/");
}
if(isset($_COOKIE["koszyk"])) {
    setcookie("koszyk", "", time() - 3600, "/");
}
header("Location: ../index.php");
exit;
?>