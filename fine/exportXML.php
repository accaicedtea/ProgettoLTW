
<?php
require './funzioni.php';
$conn = db_conn();

function getXml($conn) {
    $us = $_SESSION['username'];
    // Recupera i dati dal database
    $sql = "SELECT * FROM spesa WHERE '$us'=utente";
    $result = mysqli_query($conn, $sql);

    // Crea un nuovo documento XML utilizzando la classe SimpleXMLElement
    $xml = new SimpleXMLElement('<root/>');

    // Converte i dati del database in un documento XML
    
        while($row = mysqli_fetch_assoc($result)) {
            $xmlRow = $xml->addChild('item');
            foreach ($row as $key => $value) {
                $xmlRow->addChild($key, $value);
            }
        }
    

    

    // Restituisce il documento XML come stringa
    return $xml->asXML();
}

// Ottieni il documento XML come stringa
$xmlString = getXml($conn);
// Crea un nuovo oggetto DOMDocument
$dom = new DOMDocument();
// Carica il documento XML dalla stringa
$dom->loadXML($xmlString);
// Imposta la formattazione del documento XML
$dom->formatOutput = true;
// Ottieni la stringa formattata del documento XML
$formattedXml = $dom->saveXML();

header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="tabellaXML.xml"');

echo $formattedXml;

?>