<?php
require './funzioni.php';
$conn = db_conn();
//se e solo se utente è loggato allora puoi cambiare icona altrimeni non è loggato e invia a index
if (isset($_SESSION['log']) && $_SESSION['log'] == 'on') {
    $icon = $_POST['test'];
    if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
        $sus = $_SESSION['username'];
        $spw = $_SESSION['password'];
        if (!empty($icon) && $_SESSION['pfp'] != $icon) {
            // controlla che l'immagine selezionata sia tra le disponibili
            if (controlla_immagine($icon)) {
                // effettua la query di aggiornamento icona profilo
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
}else{
    header("Location: index.php");
}
?>
