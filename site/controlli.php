<?php 
function controlla_immagine($img){
    $imaginin_disponibili = 
    [
        "./assets/img/avatars/icons8-anime-sama.svg","./assets/img/avatars/icons8-futurama-bender.svg","./assets/img/avatars/icons8-genshin-impact-xiao.svg",
        "./assets/img/avatars/icons8-hello-kitty.svg","./assets/img/avatars/icons8-homer-simpson.svg",
        "./assets/img/avatars/icons8-impero.svg","./assets/img/avatars/icons8-iron-man.svg","./assets/img/avatars/icons8-jake.svg",
        "./assets/img/avatars/icons8-kaedehara-kazuha.svg","./assets/img/avatars/icons8-koya-bt21.svg","./assets/img/avatars/icons8-maschera-anonimo.svg",
        "./assets/img/avatars/icons8-mummia.svg","./assets/img/avatars/icons8-walter-white.svg","./assets/img/avatars/icons8-super-mario.svg",
        "./assets/img/avatars/icons8-rebel.svg","./assets/img/avatars/icons8-pokemon.svg"
    ];

    if (!in_array($img, $imaginin_disponibili)) {
        return false;
    }
    return true;
}






?>