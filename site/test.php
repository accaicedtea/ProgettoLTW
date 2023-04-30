<?php 
    require './funzioni.php';
    head("ciapo");
?>

<input type='file' onchange='onChooseFile(event, onFileLoad.bind(this, "contents"))' />
<p id="contents"></p>
<script>
function onFileLoad(elementId, event) {
    document.getElementById(elementId).innerText = JSON.stringify(event.target.result);
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