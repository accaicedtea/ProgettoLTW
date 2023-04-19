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
         <ul id="pagination" class="pagination pagination-sm">
         </ul>
      </nav>
      </div>
    </div>
    
   <div id="myModal2" class="modal" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title">Modal title</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
         <p>Modal body text goes here.</p>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
   </div>
  </body>
</html>
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
   <td> <a data-bs-toggle="modal" href="#myModal2" class="btn btn-primary">Launch modal</a></td>
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