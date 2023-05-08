<?php 
    require './funzioni.php';
    head("ciapo");
    $conn = db_conn();
?>

<input type='file' onchange='onChooseFile(event, onFileLoad.bind(this, "contents"))' />
<p id="contents"></p>
<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Cate.</th>
                                            <th>Descr.</th>
                                            <th>Importo</th>
                                            <th>Tipo</th>
                                        
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
                            
                            <script>
    // attenzione

</script>

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
