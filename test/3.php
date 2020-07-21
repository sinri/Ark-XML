<?php

use sinri\ark\xml\entity\ArkXMLDocument;
use sinri\ark\xml\entity\ArkXMLElement;
use sinri\ark\xml\reader\ArkXMLFormatter;

require_once __DIR__ . '/../vendor/autoload.php';

// Chinese!

$document = new ArkXMLDocument();
$document->setEncoding(ArkXMLDocument::ENCODING_GBK);

$element = new ArkXMLElement('MAIN');
//$element->appendText('中文');
$element->appendSubElement(
    (new ArkXMLElement('NAME'))
        ->appendText('银企直连网银互联 1')
);

$document->setRootElement($element);

$xml = $document->toXML();
echo $xml; // it is GBK

echo PHP_EOL;

echo ArkXMLFormatter::formatXML($xml) . PHP_EOL;
echo ArkXMLFormatter::formatXML($xml, 'UTF-8') . PHP_EOL;
echo ArkXMLFormatter::formatXML($xml, 'UTF-8', 'GBK') . PHP_EOL;
