<?php 
    $pagina = 'Visualizza transazioni';
    include './head.php';
?>


<body id="page-top" style="background-color:#e9e9e9;">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
            require './test_buffi_json.php';
    ?>
    <script>
        function applicaFiltroCat(){
            var e = document.getElementById("selectCat0");
            var chosen = e.options[e.selectedIndex].text; 
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = gestisciCat;
            httpRequest.open("GET", "filtered_table.php"+"?categoria="+chosen+"&tipo=", true);
            httpRequest.send();
        }

        function gestisciCat(e){
            if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200){
                document.getElementById("tableBody").innerHTML = e.target.responseText;
            }
        }

        function applicaFiltroTipo(){
            var e = document.getElementById("selectTipo");
            var chosen = e.options[e.selectedIndex].text; 
            console.log(chosen);
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = gestisciCat;
            httpRequest.open("GET", "filtered_table.php"+"?tipo="+chosen+"&categoria=", true);
            httpRequest.send();
        }

        function gestisciCat(e){
            if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200){
                document.getElementById("tableBody").innerHTML = e.target.responseText;
            }
        }
    </script>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container fluid mt-5 mb-5">
                    <div class="card shadow">
                        <?php if(isset($_GET['msg'])){ ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Congratulazioni! </strong><?php echo $_GET['msg']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }?>
                        <p class="h3 text-center mb-3 mt-3">Gestione entrate e uscite</p>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">I tuoi movimenti</p>
                        </div>
                        <div class="card-body">
                            
                            <div class="container">
                                <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                                <div class="row">
                                    <div class="col-auto">
                                        <select id="selectCat0" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroCat()">
                                        <option>Tutte le categorie</option>
                                        </select> 
                                    </div>
                                    <div class="col-auto"><select id="selectTipo" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroTipo()">
                                        <option value="tutte" selected="">Tutti i tipi</option>
                                        <option value="entrate">Entrate</option>
                                        <option value="uscite">Uscite</option>
                                        </select>
                                    </div>
                                    <div class="col-1">
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaEntrata">Aggiungi entrata</button>
                                    </div>
                                    <div class="col-auto ">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaUscita">Aggiungi uscita</button>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search">
                                    </div>
                                </div>
                            </div>

                            <!-- Modal NUOVA ENTRATA-->
                            <div class="modal fade" id="modalNuovaEntrata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- INIZIO FORM -->
                                        <form action="./register_entry.php" method="post" name="insert_form">
                                            <div class="visually-hidden"><input type="" name="tipo_new" value="entrata"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label>
                                                        <select id="selectCat1"class="d-inline-block form-select form-select-sm" name="cat_new">
                                                                <option>Seleziona categoria</option>
                                                                </select>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description" placeholder="Inserisci descrizione" name="description_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date" name="date_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount" name="amount_new" step="0.01" min="0" pattern="^\d*(\.\d{0,2})$"></div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                <input type="submit" class="btn btn-primary" value="Salva transazione"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal NUOVA USCITA-->
                            <div class="modal fade" id="modalNuovaUscita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- INIZIO FORM -->
                                        <form action="./register_entry.php" method="post" name="insert_form">
                                            <div class="visually-hidden"><input type="" name="tipo_new" value="uscita"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label>
                                                                <select id="selectCat2" class="d-inline-block form-select form-select-sm" name="cat_new">
                                                                    <option>Seleziona categoria</option>
                                                                </select>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description_new" placeholder="Inserisci descrizione" name="description_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date_new" name="date_new"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount_new" name="amount_new" step="0.01" min="0" pattern="^\d*(\.\d{0,2})$"></div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                <input type="submit" class="btn btn-primary" value="Salva transazione"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Inizio tabella -->
                            <div class="table-responsive table mt-2" id="container" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Categoria</th>
                                        <th>Descrizione</th>
                                        <th>Importo</th>
                                        <th>Tipo</th>
                                        <th>Azioni</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                         
                                                   
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modalEditEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- INIZIO FORM -->
                                                                <form action="./edit_entry.php" method="post" name="edit_form">
                                                                    <div class=""><input type="" name="id_edit" value=""></div>
                                                                    <div class=""><input type="" name="tipo_edit" value=""></div>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                                                                    </div>
                                                                    <div class="modal-body left-labels">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria</strong></label>
                                                                                    <select class="d-inline-block form-select form-select-sm" name="cat_edit">
                                                                                    
                                                                                    </select>&nbsp;
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description_edit" <?php echo 'value = "'.$tuple["descrizione"].'"';?> name="description_edit"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date_edit" value=<?php echo $tuple['data']?> name="date_edit"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount_edit" value=<?php echo abs($tuple['importo'])?> name="amount_edit" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
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
                                                    </div>

                                                    <!-- Modal per ELIMINA-->
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
                                                                    <div class="hidden"><input type="" name="id_delete" value=<?php echo $tuple['id']?>></div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                        <input type="submit" class="btn btn-danger" value="Si">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                <div >
      <nav aria-label="...">
         <ul id="pagination"  class="pagination pagination-sm">
         </ul>
      </nav>
      </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<script>
    window.onload = populateSelect();
    function populateSelect() {
        // THE JSON ARRAY.
        let data = <?= getJsonCat($conn);?>;
        
        let ele = document.getElementById('selectCat0');
        for (let i = 0; i < data.length; i++) {
            // POPULATE SELECT ELEMENT WITH JSON.
            ele.innerHTML = ele.innerHTML +
                '<option value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>';
        }
        ele = document.getElementById('selectCat1');
        for (let i = 0; i < data.length; i++) {
            // POPULATE SELECT ELEMENT WITH JSON.
            ele.innerHTML = ele.innerHTML +
                '<option value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>';
        }
        ele = document.getElementById('selectCat2');
        for (let i = 0; i < data.length; i++) {
            // POPULATE SELECT ELEMENT WITH JSON.
            ele.innerHTML = ele.innerHTML +
                '<option value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>';
        }
    }
    function populateModal(id){
        
    }
</script>
<script>
   const dataSet = <?= getJsonSpese($conn);?>

const displayPageNav = perPage => {
  
  let pagination = ``
  const totalItems = dataSet.length
  perPage = perPage ? perPage : 1
  const pages = Math.ceil(totalItems/perPage)
  
   for(let i = 1; i <= pages; i++) {
      pagination += `<a class="page-link" href="#" onClick="displayItems(${i},${perPage})" >${i}</a>`
   }

   document.getElementById('pagination').innerHTML = pagination
}

const displayItems = ( page = 1, perPage = 2 ) => {
  
   let index, offSet

   if(page == 1 || page <=0)  {
      index = 0
      offSet = perPage
   } else if(page > dataSet.length) {
      index = page - 1
      offSet = dataSet.length
   } else {
      index = page * perPage - perPage
      offSet = index + perPage
   }

   const slicedItems = dataSet.slice(index, offSet)

   const html = slicedItems.map(item => 
   `<tr class="table-${(item.importo>0)? 'success': 'danger'}">
   <td>${item.data}</td>
   <td>${item.categoria}</td>
   <td>${item.descrizione}</td>
   <td>${Math.abs(item.importo)}</td>
   <td>${(item.importo>0)? "Entrata": "Uscita"}</td>
   <td> 
   <button type="button" onclick="populateModal(1)" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry">
        Modifica
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteEntry">
        Elimina
    </button>
   </td>
   </tr>`)

   document.querySelector('#container tbody').innerHTML = html.join('')
 
}

let perPage = 15
displayPageNav(perPage)
displayItems(1, perPage)
</script>
<script>
   $(document).ready(function(){
      $('#btnShowModal').click(function{
         $('#modalModifica').modal('show');
      });
   });
</script>
<?php 
}
else{
    header("Location: login.php?error=E tu chi cazzo sei");
}
?>