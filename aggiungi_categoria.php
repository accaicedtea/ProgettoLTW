
<?php
require './funzioni.php';
$conn = db_conn();
//se e solo se admin è loggato allora aggiungi categoria altrimeni non è loggato e rinvia a login
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    // prende il massimo id della spesa
    $sql = "SELECT max(id) as id from categoria";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $id+=1;
        
    }   

    $nome =  $_POST['nome_add'];
    $colore =  $_POST['colore_add'];

    // aggiunge la categoria al database
    $sql = "INSERT INTO categoria (id, nome, colore) VALUES ($id, '$nome', '$colore');";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);
    if($query){ 
        header("Location: categorie.php?msg= inserito una nuova categoria");
    } else{
        header("Location: categorie.php?error=Qualcosa è andato storto :(");
    }
}else{ 
    header("Location: index.php");
}
?>