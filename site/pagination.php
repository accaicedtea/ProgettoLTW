<?php  
//pagination.php  
include './db_conn.php';
$record_per_page = 15;  
$page = '';  
$output = '';  
if(isset($_POST["page"]))  {  
    $page = $_POST["page"];  
}  
else  
{  
    $page = 1;  
}  
$start_from = ($page - 1)*$record_per_page;  
$query = "select * from spesa where utente='accaicedtea' order by data DESC LIMIT $start_from, $record_per_page";  
$result = mysqli_query($conn, $query);  
$output .= '<table class="table my-0" id="dataTable">
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
';  
while($row = mysqli_fetch_array($result))  
{  
    if ($row['importo']>0) {
        $tipo = "Entrata"; 
        $colore = "success";
    }else {
        $tipo = "Uscita";
        $colore = "danger";
    }
    $output .= '  
        <tr class="table-'.$colore.'">  
            <td >'.$row["data"].'</td>  
            <td>'.$row["categoria"].'</td>
            <td>'.$row["descrizione"].'</td>
            <td>'.$row["importo"].'</td>
            <td>'.$tipo.'</td>  
        
    ';
    $output .= '<td class="buttons">
    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry<?php echo $i?>">
        Modifica
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteEntry<?php echo $i?>">
        Elimina
    </button>
    </tr> ';  

    $output .= '<div class="modal fade" id="modalEditEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- INIZIO FORM -->
            <form action="./edit_entry.php" method="post" name="edit_form">
                <div class="hidden"><input type="" name="id_edit" value=></div>
                <div class="hidden"><input type="" name="tipo_edit" value=></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                </div>
                <div class="modal-body left-labels">
                    <div class="row">
                        <div class="col">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria</strong></label><select class="d-inline-block form-select form-select-sm" name="cat_edit">

                                        <option >eihhoe</option>
                             
                                </select>&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description_edit" name="description_edit"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date_edit" value= name="date_edit"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount_edit" value= name="amount_edit" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <input type="submit" class="btn btn-primary" value="Salva modifiche">
                </div>
            </form>
        </div>
    </div>
</div>';
}  
$output .= '</table><br /><div align="center">';  
$page_query = "select utente, importo,data,categoria from spesa where utente='accaicedtea' order by data DESC";  
$page_result = mysqli_query($conn, $page_query);  
$total_records = mysqli_num_rows($page_result);  
$total_pages = ceil($total_records/$record_per_page);  
for($i=1; $i<=$total_pages; $i++)  
{  
    $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
}  
$output .= '</div><br /><br />';  
echo $output;  
 ?>  