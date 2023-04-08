
<?php 
include 'db_conn.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    
    function validate($data){
        //da vedere
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['username']);
    $passw = validate($_POST['password']);
    //controlli per credenziali
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
        
        //controllare se l'utente non è bloccato
        $sql = "SELECT password FROM utente WHERE username='$uname'";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $passw = $row['password'];
            if(substr($passw, -10)=='adminBlock'){
                header("Location: login.php?error=Non puoi accedere sei stato bloccato da Dio");
                die();
            }
        }

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
                if($_SESSION['username']=='admin'){
                    header("Location: view.php");
                }else{
                header("Location: dashboard.php");
                }
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