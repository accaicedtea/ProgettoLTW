<?php
// ancora incompleto e non super giusto (tipo il sesso e la pfp sono da aggiustare) ma l'idea è questa

include './db_conn.php';
$username = $_REQUEST['username'];
$nome =  $_REQUEST['nome'];
$cognome = $_REQUEST['cognome'];
$sesso =  $_POST['sesso'];

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
//passw criptata
$encrypted_pwd = md5($password);
$dataN = $_REQUEST['dataN'];
 
// Performing insert query execution
// here our table name is college
$sql = "INSERT INTO utente  VALUES ('$username', '$nome',
    '$cognome','$dataN','$sesso','$email', '$encrypted_pwd', '')";
 
if(mysqli_query($conn, $sql)){
    echo "<h3>data stored in a database successfully.</h3>";

} else{
    echo "ERROR: Hush! Sorry $sql. "
    . mysqli_error($conn);
}
 
?>