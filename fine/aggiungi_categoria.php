
<?php
require './funzioni.php';
$conn = db_conn();
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    $sql = "SELECT max(id) as id from categoria";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $id+=1;
        
    }   

    $nome =  $_POST['nome_add'];
   
    $colore =  $_POST['colore_add'];
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