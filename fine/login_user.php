
<?php 
require './funzioni.php';
$conn = db_conn();

if(isset($_POST['username']) && isset($_POST['password'])){
    
   
    $uname = validate($_POST['username']);
    $passw = validate($_POST['password']);
    //controlli che i campi non siano vuoti
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
                $_SESSION['dataN'] = $row['dataN'];
                $_SESSION['pfp'] = $row['pfp'];
                $_SESSION['sesso'] = $row['sesso'];
                $_SESSION['nazi'] = $row['nazionalita'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['saldo'] = $row['saldo_ini'];
                $_SESSION['log'] = 'on';
                header("Location: dashboard.php");       
                exit();
            }
        }else{
            //echo 'username: '.$uname.'      password:'.$passw;
            $sql = "SELECT * FROM admin WHERE id='$uname' AND password='$passw'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
            if($row['id']=== $uname && $row['password']=== $passw ){
                $_SESSION['username'] = $row['id'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['adminLog'] = 'daje';
                header('Location: view.php');
                exit();
            }
            }else{
                header('Location: login.php?error=Username o password errati');
            }

        }

    }

}

?>