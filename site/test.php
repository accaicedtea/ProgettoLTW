<?php 
    $pagina = 'Visualizza transazioni';
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina);
?>

<script>
   

    function applicaFiltroTipo() {
        var e = document.getElementById("selectTipo");
        $.ajax({
            url:"filtered_table.php",    
            type: "get",    
            dataType: 'json',
            data: {tipo: e.options[e.selectedIndex].text, pagina: "transazioni"},
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


<!-- INIZIO PAGINA HTML -->

<body id="page-top" style="background-color:#e9e9e9;">
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
                        <p class="h3 text-center mb-3 mt-3">Visualizza le transazioni scaricate</p>
                        <div class="card-header py-3">
                            <p>Si accettano solo file .json: </p>
                            <input type='file' onchange='onChooseFile(event, onFileLoad.bind(this, "contents"))' />
                        </div>
                        <div class="card-body">
                            
                            <!-- Inizio tabella -->
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Categoria</th>
                                            <th>Descrizione</th>
                                            <th>Importo</th>
                                            <th>Tipo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    </tbody>
                                </table>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>


let dataSet;

function onFileLoad(elementId, event) {
    
    dataSet =  JSON.parse(event.target.result);
    console.log(typeof event.target.result);
    
    
    let perPage = 150000000000;
    lastPage = Math.ceil(dataSet.length/perPage);
    console.log(lastPage);
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
        `<tr class="table-${(item.importo>0)? 'success': 'danger'}">
            <td>${item.data}</td>
            <td>${item.categoria}</td>
            <td>${item.descrizione}</td>
            <td>${Math.abs(item.importo)} &euro;</td>
            <td>${(item.importo>0)? "Entrata": "Uscita"}</td>
            
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

}

function onChooseFile(event, onLoadFileHandler) {
    if (typeof window.FileReader !== 'function')
        throw ("The file API isn't supported on this browser.");
    let input = event.target;
    if (!input)
        throw ("The browser does not properly implement the event object");
    if (!input.files)
        throw ("This browser does not support the `files` property of the file input.");
    if (!input.files[0])
        return undefined;
    let file = input.files[0];
    let fr = new FileReader();
    fr.onload = onLoadFileHandler;
    fr.readAsText(file);
}
    
</script>
