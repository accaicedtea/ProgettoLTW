
<?php 
include 'db_conn.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['username']);
    $passw = validate($_POST['password']);
    if(empty($uname)){
        header("Location: login.php?error=Inserisci un username per accedere");
        exit();
    }else if(empty($passw)){
        header("Location: login.php?error=Inserisci una password per accedere");
        exit();
    }else{
        //qui si accede se sono validi gli input

        //cifro la password
        $passw = md5($passw);
        
        $sql = "SELECT * FROM utente WHERE username='$uname' AND password='$passw'";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row['username']=== $uname && $row['password']=== $passw ){
                $_SESSION['username'] = $row['username'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['dataN'] = $row['dataNascita'];
                $_SESSION['pfp'] = $row['pfp'];
                $_SESSION['password'] = $row['password'];
                
                $_SESSION['log'] = 'on';
                
                header("Location: dashboard.php");
                exit();
            }else{
                header("Location: login.php?error=Username o password incorretti");
            }
        }else{
            header("Location: login.php?error=Username o password incorretti");
        }

    }

}else{

    //header("Location: login.php");
}

?>