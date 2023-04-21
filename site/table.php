<?php include './head.php';
include './db_conn.php';
require './test_buffi_json.php';
?>
<!Doctype html>
<html lang="en">
  <head>
    <title>JSON pagination</title>
  </head>
  <body>
   
    <div id="container">
      <table class="table">
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
        <tbody>
        </tbody>
      </table>
      <div >
      <nav aria-label="...">
         <ul id="pagination"  class="pagination pagination-sm">
         </ul>
      </nav>
      </div>
    </div>
   <!-- Inizio madal-->
   <div id="myModal2" class="modal" tabindex="-1">
   <div class="modal-dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- INIZIO FORM -->
                                                                <form action="./edit_entry.php" method="post" name="edit_form">
                                                                    <div class="visually-hidden"><input type="" name="id_edit" value=""></div>
                                                                    <div class="visually-hidden"><input type="" name="tipo_edit" value=""></div>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                                                                    </div>
                                                                    <div class="modal-body left-labels">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label"><strong>Categoria</strong></label>
                                                                                <select id="selectCat" class="d-inline-block form-select form-select-sm">
                                                                                 
                                                                                 </select>
                                                                                &nbsp;
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
   <!-- Fine madal-->
  </body>
</html>
<script>
    window.onload = populateSelect();
    function populateSelect() {
        // THE JSON ARRAY.
        let data = <?= getJsonCat($conn);?>;
        
        let ele = document.getElementById('selectCat');
        for (let i = 0; i < data.length; i++) {
            // POPULATE SELECT ELEMENT WITH JSON.
            ele.innerHTML = ele.innerHTML +
                '<option value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>';
        }
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
   <td> <a data-bs-toggle="modal" data-id="${item.id}" href="#myModal2" class="btn btn-primary">Launch modal</a></td>
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