<?php 
    
    $emparray = array();
    $sql = "select * from categoria";
    $result = mysqli_query($conn, $sql);
    
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    return json_encode($emparray);
?>