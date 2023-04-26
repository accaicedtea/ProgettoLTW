<?php  
//pagination.php  
include './db_conn.php';    
$record_per_page = 15;  
$page = '';  
$output = '';
$i=0;  
$query ="SELECT nome FROM categoria";
$result = $conn->query($query);
if($result->num_rows> 0){
    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if(isset($_GET["page"]))  {  
    $page = $_GET["page"];  
}  
else  
{  
    $page = 1;  
}  
$start_from = ($page - 1)*$record_per_page;  

//TODO: query da modificare
$query = "select * from spesa where utente='accaicedtea' order by data DESC LIMIT $start_from, $record_per_page";  
$result = mysqli_query($conn, $query);  

?>
<table class="table my-0" id="dataTable">
<thead>
    <tr>
        <th>Data</th>
        <th>Categoria</th>
        <th>Descrizione</th>
        <th>Importo</th>
        <th>Tipo</th>
        <th>Opzioni</th>
    </tr>
</thead>
<tbody>  
<?php
while($row = mysqli_fetch_array($result))  
{  
 ?>
<tr class="table-<?php echo ($row['importo']<0)? 'danger' : 'success';?>">  
<td ><?php echo $row["data"] ?></td>  
            <td><?php echo $row['data']; ?></td>
            <td><?php echo $row['descrizione']; ?></td>
            <td><?php echo abs($row['importo'])." €"; ?></td>
            <td><?php if ($row['importo']>0) echo "Entrata"; else echo "Uscita";?></td>  
        
<td class="buttons">
    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry<?php echo $i?>">
        Modifica
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteEntry<?php echo $i?>">
        Elimina
    </button>
    </tr>
    <div class="modal fade" id="modalDeleteEntry<?php echo $i; $i++;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLongTitle">Elimina transazione</h5>
                                                                </div>
                                                                <div class="modal-body left-labels">
                                                                    Sei sicuro di voler eliminare la transazione?
                                                                </div>
                                                                <form action="./delete_entry.php" method="post" name="delete_form">
                                                                    <div class="hidden"><input type="" name="id_delete" value=<?php echo $row['id']?>></div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                        <input type="submit" class="btn btn-danger" value="Si">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>
<?php }?>  
</table><br /><div align="center">
    <?php   
$page_query = "select utente, importo,data,categoria from spesa where utente='accaicedtea' order by data DESC";  
$page_result = mysqli_query($conn, $page_query);  
$total_records = mysqli_num_rows($page_result);  
$total_pages = ceil($total_records/$record_per_page);  
$this_page = $page;
$next_page = $page + 1;
$prev_page = $page -1;
    ?> <nav aria-label="Page navigation ">
    <ul class="pagination justify-content-center">
      <li class="page-item">
          <span class="page-link pagination_link <?php if($prev_page<=1) echo 'disabled';?>" id="<?php if($prev_page<=1) echo 1; else echo $prev_page;
          ?>">&laquo; Previous</span>
      </li>
      <?php for($i=1; $i<=3 && $this_page<=$total_pages; $i++)  {?>
      <li class="page-item"><span class='page-link pagination_link' id="<?php echo $this_page;?>"><?php echo $this_page; ?></span></li>
      <?php 
        $this_page+=1;
        } ?>
      <li class="page-item">
          <span class="page-link pagination_link <?php if($next_page>=$total_pages) echo 'disabled';?>" id="<?php if($next_page>=$total_pages) echo $total_pages; else echo $next_page;
            ?>">Next &raquo;</span>
      </li>
    </ul>
  </nav>  
</div><br /><br /> 