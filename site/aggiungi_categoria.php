
<?php
require './test_buffi_json.php';
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
}else if(isset($_SESSION['log']) && $_SESSION['log']=='on'){
    $sql = "SELECT max(id) as id from categoriacustom";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $id+=1;
        
    }   

    $nome =  $_POST['nome_add'];
    $img =  $_POST['img_add'];
    $colore =  $_POST['colore_add'];
    $unam = $_SESSION['username'];
    $sql = "INSERT INTO categoriacustom (id, user,nome, colore, img) VALUES ($id, '$unam', '$nome', '$colore', '$img');";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
        
        header("Location: categorie.php?msg=Transazione inserita correttamente");
    } else{
        header("Location: categorie.php?error=Qualcosa è andato storto :(");
    }
}
?>