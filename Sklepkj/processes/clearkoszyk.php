<?php
// Technicznie powinnu tu być coś na wzór strony z płatnością
//
// Skrypt bierze ID użytkownika z koszyk.php, następnie usuwa wszystkie produkty dodane do koszyka przez tego użytkownika,
// kończąc na usuwaniu cookie z obecnością produktów w koszyku i przekierowaniu na stronę głowną
$conn = mysqli_connect("localhost", "root", "", "sklepkj");
$id_uzytkownika = $_POST["id"];
$sql = "DELETE FROM zamowienia WHERE ID_uzytkownika = $id_uzytkownika";
mysqli_query($conn, $sql);
setcookie("koszyk", "", time() - 3600, "/");
mysqli_close($conn);
header("Location: ../index.php");
exit;
?>