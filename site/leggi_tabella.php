<?php 
    $pagina = 'Visualizza transazioni';
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina);
?>

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
                        <p class="h3 text-center mb-3 mt-3">Gestione entrate e uscite</p>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">
                                <div>
                                    <input id="file" type="file" />
                                </div>
                        </div>
                            
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
                                <div class="mt-2 justify-content-center">
                                    <nav aria-label="...">
                                        <ul id="pagination"  class="pagination justify-content-center pagination-sm">
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
    // attenzione
    //dataSet da impostare
    function readJSON(file) {
        var request = new XMLHttpRequest();
        request.open('GET', file, false);
        request.send(null);
        if (request.status == 200)
            return request.responseText;
    };

    dataSet = readJSON('../../../data.json');
    console.log(dateSet);
    
    let perPage = 15;
    lastPage = Math.round(dataSet.length/perPage);

    const displayItems = ( page = 1, perPage = 2, dataset ) => {

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
        <td>${Math.abs(item.importo)}</td>
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
</script>


