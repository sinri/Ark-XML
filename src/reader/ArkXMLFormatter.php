<?php


namespace sinri\ark\xml\reader;

use DOMDocument;
use SimpleXMLElement;

/**
 * Class ArkXMLFormatter
 * @package sinri\ark\xml\reader
 * @since 0.4
 */
class ArkXMLFormatter
{
    public static function formatXML($xml, $toEncoding = null, $fromEncoding = null)
    {

        $document = new DOMDocument('1.0');
        $document->preserveWhiteSpace = false;
        $document->formatOutput = true;
        /* @var $xml SimpleXMLElement */
        $document->loadXML($xml);
        //$document->encoding='UTF-8';
        $xmlFormatted = $document->saveXML();
        if ($toEncoding !== null) {
            $xmlFormatted = mb_convert_encoding($xmlFormatted, $toEncoding, $fromEncoding);
        }
        return $xmlFormatted;
    }
}