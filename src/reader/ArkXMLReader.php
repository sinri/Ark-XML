<?php


namespace sinri\ark\xml\reader;


use sinri\ark\xml\entity\ArkXMLElement;

class ArkXMLReader
{
    /**
     * @param string $xmlString
     * @return bool|ArkXMLElement
     */
    public static function simplyParseXMLToElement(string $xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        if ($xml === false) {
            return false;
        }

        return ArkXMLElement::createWithSimpleXMLElement($xml);
    }

    /**
     * @param string $xmlFilePath
     * @return bool|ArkXMLElement
     */
    public static function simplyParseXMLFileToElement(string $xmlFilePath)
    {
        $xml = simplexml_load_file($xmlFilePath);
        if ($xml === false) {
            return false;
        }

        return ArkXMLElement::createWithSimpleXMLElement($xml);
    }
}