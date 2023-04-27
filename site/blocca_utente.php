<?php
require "./test_buffi_json.php";
 $conn = db_conn();
$blockThis = $_POST["blockthis"];
$sql = "SELECT password from utente WHERE username='$blockThis'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $passw = $row["password"];
    $passw .= "adminBlock";
    $sql = "UPDATE utente SET password = '$passw' WHERE utente.username = '$blockThis'";

    if (mysqli_query($conn, $sql)) {
        //echo "ok1";
        header("Location: view.php?msg= bloccato l'utente ");
    }else{
        header("Location: view.php?error=qualcosa è andato storto");
    }
}
?>
