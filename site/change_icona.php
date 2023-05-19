<?php
require './funzioni.php';
$conn = db_conn();
$icon = $_POST['test'];
if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
    $sus = $_SESSION['username'];
    $spw = $_SESSION['password'];
    if (!empty($icon) && $_SESSION['pfp'] != $icon) {
        if (controlla_immagine($icon)) {
            $sql = "UPDATE utente SET pfp='$icon' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['pfp'] = $_POST['test'];
            }
            echo "<script>window.location.href=' profile.php?msg=Icona aggiornata correttamente'</script>";
        } else {
            echo "<script>window.location.href=' profile.php?error=Qualcosa è andato storto'</script>";
        }
    }
}
?>
