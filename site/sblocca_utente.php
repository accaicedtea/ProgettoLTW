<?php
//TODO: Gestione errori
include "./db_conn.php";
$sblockThis = $_POST["sblockthis"];
$sql = "SELECT password from utente WHERE username='$sblockThis'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $passw = $row["password"];
    $passw = rtrim($passw, "adminBlock");
    $sql = "UPDATE utente SET password = '$passw' WHERE username = '$sblockThis'";
    if (mysqli_query($conn, $sql)) {
        header("Location: view.php?msg= sbloccato l'utente ");
    }
}
?>
