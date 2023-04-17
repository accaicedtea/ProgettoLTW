<?php 
    $pagina='Categorie';
    include './head.php';
    ?>   
<body id="page-top">
    <?php 
        include './db_conn.php';
        include './navBar.php';
        if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']== 'daje'){
        ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content-fluid">
                <div class="container-fluid mt-5">
                    <div class="card shadow">
                        <?php if(isset($_GET['error'])){ ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Non grandioso! </strong><?php echo $_GET['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php }else if(isset($_GET['msg'])){?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Operazione esegiuta! hai correttamente: </strong><?php echo $_GET['msg']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php }?>
                        <p class="h3 text-center mb-3 mt-3">Visualizzazione utenti inscritti</p>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">I miei pagurini</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th scope="col">nome</th>
                                                <th scope="col">colore</th>
                                                <th scope="col">immagine</th>
                                                <th scope="col">modifica categoria</th>
                                                <th scope="col">elimina categoria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($_SESSION['adminLog']=='daje'){ 
                                                    $result = $conn->query("SELECT * FROM categoria ");
                                                }
                                                $tuples = array();
                                                if($result->num_rows> 0){
                                                    $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                }

                                                $i=0;
                                                foreach ($tuples as $tuple) { 
                                                    ?>
                                            <tr class="table" style="background-color: <?php echo $tuple['colore'];?>">
                                                <td scope="row">
                                                    <p><?php echo $tuple['nome'];?></p>
                                                </td>
                                                <td >
                                                    <p><?php echo $tuple['colore'];?></p>
                                                </td>
                                                <td >
                                                <td class="text-center ">
                                                    <form action="./blocca_utente.php" method="post" name="form-block-user" class="form-block-user">
                                                        <input class="visually-hidden" type="text" id="username" name="blockthis" value="<?php echo $tuple['id'];?>" readonly>
                                                        <button type="submit"  class="btn btn-warning btn-sm">Blocca utente</button>
                                                    </form>
                                                </td>
                                                <td class="text-center ">
                                                <form action="./blocca_utente.php" method="post" name="form-block-user" class="form-block-user">
                                                        <input class="visually-hidden" type="text" id="username" name="blockthis" value="<?php echo $tuple['id'];?>" readonly>
                                                        <button type="submit"  class="btn btn-warning btn-sm">Blocca utente</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php 
                                                
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php }else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>