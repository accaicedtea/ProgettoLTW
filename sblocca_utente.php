<?php
require "./funzioni.php";
$conn = db_conn();
//se e solo se admin è loggato allora aggiungi categoria altrimeni non è loggato e rinvia a login
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    // id utente da sbloccare
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
        }else{
            header("Location: view.php?error=qualcosa è andato storto");
        }
    }
}else{
    header("Location: index.php");
}
?>
