
<?php
require './funzioni.php';
head("ciao");
navBar("");
?>

<div class="container-fluid">
  <div class="row row-cols-2">
    <div class="col mt-5">
        <div class="card text-center shadow mb-3">
            <div class="card-header">
                <p class="text-primary m-0" >Profilo di</p>
                <p class="m-0 h5 fw-bold" id="username"></p>
            </div>
            <div>
                <img id="pfp" src="" class="rounded-circle mb-3 mt-4" width="100" height="100">
            </div>
            
            <div class="card-body text-center">

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    Cambia icona profilo
                </button>
                <!-- INIZIO MODAL MODIFICA ICONA PROFILO-->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            </div>
                            <div class="modal-body">
                                <form action="./change_icona.php" method="post" name="form-change-icon" class="form-change-icon">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-anime-sama.svg" checked >
                                                    <img src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 1" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-futurama-bender.svg">
                                                    <img src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 2" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-genshin-impact-xiao.svg">
                                                    <img src="./assets/img/avatars/icons8-genshin-impact-xiao.svg" alt="Option 3" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-hello-kitty.svg">
                                                    <img src="./assets/img/avatars/icons8-hello-kitty.svg" alt="Option 4" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-homer-simpson.svg" >
                                                    <img src="./assets/img/avatars/icons8-homer-simpson.svg" alt="Option 5" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-impero.svg">
                                                    <img src="./assets/img/avatars/icons8-impero.svg" alt="Option 6" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-iron-man.svg">
                                                    <img src="./assets/img/avatars/icons8-iron-man.svg" alt="Option 7" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-jake.svg">
                                                    <img src="./assets/img/avatars/icons8-jake.svg" alt="Option 8" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-kaedehara-kazuha.svg" >
                                                    <img src="./assets/img/avatars/icons8-kaedehara-kazuha.svg" alt="Option 9" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-koya-bt21.svg">
                                                    <img src="./assets/img/avatars/icons8-koya-bt21.svg" alt="Option 10" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-maschera-anonimo.svg">
                                                    <img src="./assets/img/avatars/icons8-maschera-anonimo.svg" alt="Option 11" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-mummia.svg">
                                                    <img src="./assets/img/avatars/icons8-mummia.svg" alt="Option 12" width="50" height="50">
                                                </label>                                                        
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-walter-white.svg" >
                                                    <img src="./assets/img/avatars/icons8-walter-white.svg" alt="Option 13" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-super-mario.svg">
                                                    <img src="./assets/img/avatars/icons8-super-mario.svg" alt="Option 14" width="50" height="50" >
                                                </label>
                                                <label>
                                                    <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-rebel.svg">
                                                    <img src="./assets/img/avatars/icons8-rebel.svg" alt="Option 15" width="50" height="50">
                                                </label>
                                                <label>
                                                    <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-pokemon.svg">
                                                    <img src="./assets/img/avatars/icons8-pokemon.svg" alt="Option 16" width="50" height="50">
                                                </label>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Chiudi</button>
                                        <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- FINE MODAL MODIFICA-->
            </div>
        </div>
    </div>


    <div class="col mt-5">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold text-start">Cambia informazioni utente <i class="bi bi-person-bounding-box"></i></p>
            </div>
            <div class="card-body">
                <form action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                    <div class="row">
                        <div class="col">
                            
                            <div class="form-floating mb-3">
                                
                                <input type="text" class="form-control" id="nome" placeholder="nome">
                                <label for="nome">Nome</label>
                                
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="cognome" placeholder="cognome">
                                <label for="cognome">Cognome</label>
                            </div> 
                            <div class="form-check ps-2 mb-2 radio-inputs">
                                <label>
                                    <input class="radio-input" type="radio" id="radio1" name="sesso" value="1" selected>
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <i class="bi bi-gender-male"></i>
                                            </span>
                                            <span class="radio-label">Uomo</span>
                                        </span>
                                </label>
                                <label>
                                    <input checked="" class="radio-input" id="radio2" type="radio" name="sesso" value="0">
                                    <span class="radio-tile">
                                        <span class="radio-icon">
                                            <i class="bi bi-gender-female"></i>
                                        </span>
                                        <span class="radio-label">Donna</span>
                                    </span>
                                </label>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                            </div>       
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col"></div>
    
    
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold text-start">Cambia informazioni utente <i class="bi bi-person-bounding-box"></i></p>
            </div>
            <div class="card-body">
                <form action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                    <div class="row">
                        <div class="col">
                            
                            <div class="form-floating mb-3">
                                
                                <input type="text" class="form-control" id="nome" placeholder="nome">
                                <label for="nome">Nome</label>
                                
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="cognome" placeholder="cognome">
                                <label for="cognome">Cognome</label>
                            </div> 
                            <div class="form-check ps-2 mb-2 radio-inputs">
                                <label>
                                    <input class="radio-input" type="radio" id="radio1" name="sesso" value="1" selected>
                                        <span class="radio-tile">
                                            <span class="radio-icon">
                                                <i class="bi bi-gender-male"></i>
                                            </span>
                                            <span class="radio-label">Uomo</span>
                                        </span>
                                </label>
                                <label>
                                    <input checked="" class="radio-input" id="radio2" type="radio" name="sesso" value="0">
                                    <span class="radio-tile">
                                        <span class="radio-icon">
                                            <i class="bi bi-gender-female"></i>
                                        </span>
                                        <span class="radio-label">Donna</span>
                                    </span>
                                </label>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                            </div>       
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- fine row-->
  </div>
</div>