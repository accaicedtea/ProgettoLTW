<?php 
    $pagina = 'Visualizza transazioni';
    include './head.php';
?>


<body id="page-top" style="background-color:#e9e9e9;">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container fluid mt-5">
                    <p class="h3 text-center mb-3 mt-3">Gestione entrate e uscite</p>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">I tuoi movimenti</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Mostra&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                </select>&nbsp;</label>
                                    </div>
                                </div>
                                <div class="col-md-2 text-nowrap">
                                    <div id="type_filter" class="type_filter" aria-controls="dataTable"><label class="form-label">Tipo&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="uscite" selected="">Uscite</option>
                                                <option value="entrate">Entrate</option>
                                                </select>&nbsp;</label>
                                    </div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="category_filter" class="category_filter" aria-controls="dataTable"><label class="form-label">Categoria&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="uscite" selected="">Categoria1</option>
                                                <option value="entrate">Categoria2</option>
                                                <option value="entrate">Categoria3</option>
                                                <option value="entrate">Categoria4</option>
                                                <option value="entrate">Categoria5</option>
                                                </select>&nbsp;</label>
                                    </div>
                                </div>
                                <div class="col-md-1 text-nowrap">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Aggiungi</button>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Categoria</th>
                                            <th>Descrizione</th>
                                            <th>Importo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>16/22/2002</td>
                                            <td>Sport</td>
                                            <td>fatti i cazzi tuoi</td>
                                            <td>123$</td>
                                            <td class="buttons">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                Modifica
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Modifica transazione</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post" name="edit_form">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-0">
                                                                        <label class="form-label"><strong>Categoria&nbsp;</strong><select class="d-inline-block form-select form-select-sm">
                                                                            <option value="uscite" selected="">Categoria1</option>
                                                                            <option value="entrate">Categoria2</option>
                                                                            <option value="entrate">Categoria3</option>
                                                                            <option value="entrate">Categoria4</option>
                                                                            <option value="entrate">Categoria5</option>
                                                                            </select>&nbsp;</label>                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3"><label class="form-label" for="description"><strong >Descrizione</strong></label><input class="form-control" type="text" id="description" placeholder="poi vediamo" name="description"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3"><label class="form-label" for="date"><strong >Data</strong></label><input class="form-control" type="date" id="date" name="date"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3"><label class="form-label" for="amount"><strong >Importo</strong></label><input class="form-control" type="number" id="amount" name="amount" step="0.01" pattern="^\d*(\.\d{0,2})$"></div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                            <button type="button" class="btn btn-primary">Salva modifiche</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm">Elimina</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>16/22/2002</td>
                                            <td>Sport</td>
                                            <td>fatti i cazzi tuoi</td>
                                            <td>123$</td>
                                            <td class="buttons"><button type="button" class="btn btn-secondary btn-sm edit">Modifica</button><button type="button" class="btn btn-danger btn-sm">Elimina</button></td>
                                        </tr>
                                        <tr>
                                            <td>16/22/2002</td>
                                            <td>Sport</td>
                                            <td>fatti i cazzi tuoi</td>
                                            <td>123$</td>
                                            <td class="buttons"><button type="button" class="btn btn-secondary btn-sm edit">Modifica</button><button type="button" class="btn btn-danger btn-sm">Elimina</button></td>
                                        </tr>
                                        <tr>
                                            <td>16/22/2002</td>
                                            <td>Sport</td>
                                            <td>fatti i cazzi tuoi</td>
                                            <td>123$</td>
                                            <td class="buttons"><button type="button" class="btn btn-secondary btn-sm edit">Modifica</button><button type="button" class="btn btn-danger btn-sm">Elimina</button></td>
                                        </tr>
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