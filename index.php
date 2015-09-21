<?php

require_once './XmlTrasnlator.php';

$xmlTra = new XmlTrasnlator("Lenovo_mozenda.xml");
//$xmlTra->load();
//$xmlTra->validateAgainstXsd();
$xmlTra->loadSX();
