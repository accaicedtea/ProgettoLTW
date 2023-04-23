<?php

//$user = $_SESSION['username']; 
$data = date("Y-m-g");
function get_spese(){
    $result = $conn->query("SELECT s.id,s.utente,s.importo,s.data,s.descrizione,c.nome as categoria FROM spesa as s join categoria as c on c.id=s.categoria WHERE s.utente = 'accaicedtea' and s.data<'$data' Order by s.data Desc Limit 20");
    $tuples = array();
    while($row = mysqli_fetch_assoc($result)){
        $tuples[] = $row;
    }
    return json_encode($tuples);
}

?>
 <div class="card-body">
       <div id="sampleTable">
         
       </div>
  </div>
  <script>
  $(document).ready(function(){
    function lodetable(page){
          $.ajax({
            url : 'table.php',
            type : 'POST',
            data : {page_no:page},
            success : function(data) {
              $('#sampleTable').html(data);
            }
          });
      }
      lodetable();

    $(document).on("click","#pagenation a",function(e) {
        e.preventDefault();
        var page_id = $(this).attr("id");
        lodetable(page_id);
    });


  });
</script>
