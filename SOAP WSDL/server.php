<?php
// Server SOAP

function metriToPollici($metri) {
    return $metri * 39.3701;
}

function polliciToMetri($pollici) {
    return $pollici / 39.3701;
}

$server = new SoapServer("test.wsdl");
$server->addFunction(["metriToPollici", "polliciToMetri"]);
$server->handle();
?>
