<?php    
require "./funzioni.php";
$conn = db_conn();

//se e solo se admin è loggato allora puoi eliminare utente altrimeni non è loggato e rinvia a index
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    $dropThis = $_POST['dropThis'];  
    // query che elimina l'utente passato dalla POST
    $sql = "DELETE FROM spesa WHERE spesa.utente = '$dropThis'";
    if((mysqli_query($conn, $sql))){
        $sql = "DELETE FROM utente WHERE utente.username = '$dropThis'";
        if((mysqli_query($conn, $sql))){
            header("Location: view.php?msg=eliminato l'utente");
        }
    }else{
        header("Location: view.php?error=qualcosa è andato storto");
    }
}else{
    header("Location: index.php");
}       
?>