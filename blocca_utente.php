<?php
require "./funzioni.php";
$conn = db_conn();
//se e solo se admin è loggato allora puoi bloccare altrimeni non è loggato e invia a index
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    // prende id della persona grzie al modal
    $blockThis = $_POST["blockthis"];
    $sql = "SELECT password from utente WHERE username='$blockThis'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $passw = $row["password"];
        //aggiunge alla password
        $passw .= "adminBlock";
        $sql = "UPDATE utente SET password = '$passw' WHERE utente.username = '$blockThis'";
        if (mysqli_query($conn, $sql)) {
            //echo "ok1";
            header("Location: view.php?msg= bloccato l'utente ");
        }else{
            header("Location: view.php?error=Qualcosa è andato storto");
        }
    }
}else{
    header("Location: index.php");
}
?>
