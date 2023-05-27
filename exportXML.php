
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

// Ottieni il documento XML 
$xmlString = getXml($conn);

$dom = new DOMDocument();
$dom->loadXML($xmlString);
$dom->formatOutput = true;

$formattedXml = $dom->saveXML();

header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="tabellaXML.xml"');

echo $formattedXml;

?>