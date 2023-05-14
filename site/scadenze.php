<?php 
    $pagina = 'Visualizza scadenze';
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina,"Visualizza spese o entrate future");
?>



<?php 
    if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
?>
<script>
    function applicaFiltroCat() {
        var e = document.getElementById("selectCat");
        $.ajax({
            url:"filtered_table.php",   
            type: "get",   
            dataType: 'json',
            data: {categoria: e.options[e.selectedIndex].text, pagina: "scadenze"},
            success:function(result){
                dataSet = result;
                lastPage = Math.ceil(dataSet.length/perPage);
                displayAll(1, 15);
            }
        });
    }

    function applicaFiltroTipo() {
        var e = document.getElementById("selectTipo");
        $.ajax({
            url:"filtered_table.php",    
            type: "get",    
            dataType: 'json',
            data: {tipo: e.options[e.selectedIndex].text, pagina: "scadenze"},
            success:function(result){
                dataSet = result;
                lastPage = Math.ceil(dataSet.length/perPage);
                displayAll(1, 15);
            }
        });
    }

    // gestione modals
    $(function () {
        $(document).on("click", ".editForModal", function () {
            var row = $(this).data('row');
            $(".modal_edit #description_edit").val(row["descrizione"]);
            $(".modal_edit #date_edit").val(row["data"]);
            $(".modal_edit #amount_edit").val(Math.abs(row["importo"]));
            $(".modal_edit #id_edit").val(row["id"]);
            $(".modal_edit #tipo_edit").val(row["importo"] > 0 ? "entrata" : "uscita");
            $(".modal_edit #cat_edit > option[value='"+row['id_categoria']+"']").attr('selected', 'true');
        })
    });

    $(function () {
        $(document).on("click", ".deleteForModal", function () {
            var id = $(this).data('id');
            $(".modal_delete #id_delete").val(id);    
        })
    });
</script>

<style>
    .bottone-download{
        --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;
}
    
</style>
<!-- INIZIO PAGINA HTML -->

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container fluid mt-5 mb-5">
                    <div class="card shadow border-success">
                        <?php if(isset($_GET['msg'])){ ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Congratulazioni! </strong><?php echo $_GET['msg']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }, 1000);
</script>
                        <?php }?>
                        <div class="one"><h3 class="text-center mb-3 mt-3">Gestione Scadenze</h3></div>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Gestisci le tue entrate e uscite future</p>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <p class=" m-0 fw-bold">Filtri</p>
                                </div>

                                <div class="row">
                                    <div class="col-auto ">
                                        <select id="selectCat" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroCat()">
                                        </select> 
                                    </div>
                                    <div class="col-auto">
                                        <select id="selectTipo" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroTipo()">
                                            <option value="tutte" selected="">Tutti i tipi</option>
                                            <option value="entrate">Entrate</option>
                                            <option value="uscite">Uscite</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    
                                    <div class="col">

                                    </div>
                                    <div class="col">

                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaEntrata">Aggiungi entrata</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuovaUscita">Aggiungi uscita</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal NUOVA ENTRATA-->
                            <div class="modal fade" id="modalNuovaEntrata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- INIZIO FORM -->
                                        <form action="./register_entry.php" method="post" name="insert_form">
                                            <div class="hidden"><input type="" name="tipo_new" value="entrata"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label><select class="d-inline-block form-select form-select-sm" name="cat_new" id="cat_newE">
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
                                            <div class="hidden"><input type="" name="tipo_new" value="uscita"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Nuova transazione</h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria&nbsp;</strong></label><select class="d-inline-block form-select form-select-sm" name="cat_new" id="cat_newU">
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
                            <div class="table-responsive table mt-4" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-hover my-0" id="dataTable">
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
                                
                                    
                                    <div class="col ps-5">
                                        <nav aria-label="...">
                                            <ul id="pagination"  class="pagination justify-content-center pagination-sm">
                                            </ul>
                                        </nav>
                                    </div>
                                
                            </div>

                            <!-- MODALS -->
                            <!-- Modal per MODIFICA-->
                            <div class="modal fade" id="modalEditEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- INIZIO FORM -->
                                        <form action="./edit_entry.php" method="post" name="edit_form">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                                            </div>
                                            <div class="modal-body left-labels modal_edit">
                                                <div class="hidden"><input type="" name="id_edit" id="id_edit" value=""></div> 
                                                <div class="hidden"><input type="" name="tipo_edit" id="tipo_edit" value=""></div> 
                                                <div class="row">
                                                    <div class="col">
                                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria</strong></label><select id="cat_edit" class="d-inline-block form-select form-select-sm" name="cat_edit" >
                                                            </select>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description_edit" value="" name="description_edit"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date_edit" value="" name="date_edit"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount_edit" value="" name="amount_edit" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
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
                            <div class="modal fade" id="modalDeleteEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLongTitle">Elimina transazione</h5>
                                        </div>
                                        <div class="modal-body left-labels modal_delete">
                                            Sei sicuro di voler eliminare la transazione?
                                            <form action="./delete_entry.php" method="post" name="delete_form">
                                                <div class="hidden"><input type="" name="id_delete" id="id_delete" value=""></div> 
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <input type="submit" class="btn btn-danger" value="Si">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
        let data = <?= getJsonCat($conn)?>;
        
        let ele1 = document.getElementById('selectCat');
        let ele2 = document.getElementById('cat_edit');
        let ele3 = document.getElementById('cat_newE');
        let ele4 = document.getElementById('cat_newU');
        ele1.innerHTML = ele1.innerHTML + '<option value="Tutte le categorie">Tutte le categorie</option>';
        list = [ele1, ele2, ele3, ele4];
        for (let i = 0; i < data.length; i++) {
            for (element of list)
                // POPULATE SELECT ELEMENT WITH JSON.
                element.innerHTML = element.innerHTML + '<option value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>';
        }
    }
</script>
<script>
    // attenzione
    dataSet = <?= getJsonScadenze($conn);?>;
    let perPage = 15;
    lastPage = Math.ceil(dataSet.length/perPage);

    const displayItems = ( page , perPage , dataset ) => {

        let index, offSet;
        var currPage = page;

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

        const slicedItems = dataSet.slice(index, offSet);
        const html = slicedItems.map(item => 
        `<tr">
            <td data-label="Data">${item.data}</td>
            <td class="table-light" data-label="Categoria">${item.categoria}</td>
            <td data-label="Descrizione">${item.descrizione}</td>
            <td class="table-light" data-label="Importo">${Math.abs(item.importo)} &euro;</td>
            <td  data-label="Tipo">${(item.importo>0)? "<i class='fa-lg text-success bi bi-graph-up-arrow'></i>": "<i class='fa-lg text-danger bi bi-graph-down-arrow'></i>"}</td>
            <td data-label="Azione"><button type="button" class="editForModal btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEntry" data-row=`+`'${JSON.stringify(item)}'`+`>  
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" class="deleteForModal btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteEntry" data-id=${item.id}>
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>`);

        document.querySelector('#tableBody').innerHTML = html.join('');

    }
    const displayAll = ( page = 1, perPage = 2 ) => {
        displayItems(page, perPage)
        displayPageNav(page, perPage)
    }

    const displayPageNav = (page, perPage) => {

        let pagination = ""
        const totalItems = dataSet.length
        perPage = perPage ? perPage : 1
        const pages = Math.ceil(totalItems/perPage)

        if (page!=1){
            pagination += `<li class="page-item"><a class="page-link" href="#" onClick="displayAll(1,${perPage})" ><<</a></li>`
            pagination += `<li class="page-item"><a class="page-link" href="#" onClick="displayAll(${page-1},${perPage})" >Precedente</a></li>`
            pagination += `<li class="page-item"><a class="page-link" href="#" onClick="displayAll(${page-1},${perPage})" >${page-1}</a></li>`
        }
        pagination += `<li class="page-item active"><a class="page-link" href="#" onClick="displayAll(${page},${perPage})" >${page}</a></li>`
        if (page!=lastPage){
            pagination += `<li class="page-item"><a class="page-link" href="#" onClick="displayAll(${page+1},${perPage})" >${page+1}</a></li>`
            pagination += `<li class="page-item"><a class="page-link" href="#" onClick="displayAll(${page+1},${perPage})" >Successivo</a></li>`
            pagination += `<li class="page-item"><a class="page-link" href="#" onClick="displayAll(${lastPage},${perPage})" >>></a></li>`
        }

        document.getElementById('pagination').innerHTML = pagination
    }

    displayAll(1, perPage);

    const displayAllFiltered = (page, perPage) => {
        displayItems(page, perPage)
        displayPageNav(page, perPage)
    }
</script>



<?php 
}
else{
    header("Location: login.php?error=E tu chi sei?");
}
?>