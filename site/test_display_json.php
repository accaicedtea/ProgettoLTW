<html>
<head>
    <title>Bind SELECT Dropdown with JSON using JavaScript</title>
</head>
<?php include './db_conn.php';
    require './test_buffi_json.php';
    echo getJsonStati($conn);
    ?>
<body>
  

<div class="col-auto">
                                            <!--The SELECT element.-->
                                            <select id="selectCat" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroCat(this);" >
                                                <option value="Tutte Le Categorie">Tutte le categorie</option>
                                            </select>
                                        </div>

</body>

<script>
    window.onload = populateSelect();
    function populateSelect() {
        // THE JSON ARRAY.
        let birds = <?=getJsonCat($conn);?>;
        
        let ele = document.getElementById('selectCat');
        for (let i = 0; i < birds.length; i++) {
            // POPULATE SELECT ELEMENT WITH JSON.
            ele.innerHTML = ele.innerHTML +
                '<option value="' + birds[i]['id'] + '">' + birds[i]['nome'] + '</option>';
        }
    }
    
</script>
</html>