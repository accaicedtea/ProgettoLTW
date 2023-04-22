
<?php
require './test_buffi_json.php';
$conn = db_conn();

$sql = "SELECT max(id) as id from categoria";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    $id=$row['id'];
    $id+=1;
    
}   

$nome =  $_POST['nome_add'];
$img =  $_POST['img_add'];
$colore =  $_POST['colore_add'];
$sql = "INSERT INTO categoria (id, nome, colore, img) VALUES ($id, '$nome', '$colore', '$img');";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    
    header("Location: categorie.php?msg=Transazione inserita correttamente");
} else{
    header("Location: categorie.php?error=Qualcosa è andato storto :(");
}
?>