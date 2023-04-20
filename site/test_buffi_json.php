<?php 
    function db_conn(){
        session_start();
        mysqli_report(MYSQLI_REPORT_OFF);
        /* @ is used to suppress warnings */
        $conn = @mysqli_connect('localhost', 'root', '', '4Money');
        if (!$conn) {
        /* Use your preferred error logging method here */
            header("Location: ./error.php?error=405");
            exit();   
        }
        return $conn;
    }
    
    function getJsonCat($conn){
        
        $emparray = array();
        $sql = "select * from categoria";
        $result = mysqli_query($conn, $sql);
        
        while($row =mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }
        return json_encode($emparray);
    }
    function getJsonSpese($conn){
        
        $user = $_SESSION['username']; 
        $emparray = array();
        $sql = "SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo FROM spesa s join categoria c on c.id=s.categoria WHERE utente = '$user' order by s.data DESC;";
        $result = mysqli_query($conn, $sql);
        while($row =mysqli_fetch_assoc($result)){
            $emparray[] = $row;
        }
        $_SESSION['categoria'] = "Tutte le categorie";
        $_SESSION['tipo'] = "Tutti i tipi";
        
        return json_encode($emparray);
    }
    function getJsonStati($conn) {
        $sql = "SELECT stati.id_stati as id, stati.nome_stati as nome from stati order by stati.id_stati";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }
        return json_encode($array);
    }

?>