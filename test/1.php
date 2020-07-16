<?php

use sinri\ark\xml\writer\ArkXMLWriter;
use sinri\ark\xml\entity\ArkXMLDocument;
use sinri\ark\xml\entity\ArkXMLElement;

require_once __DIR__ . '/../vendor/autoload.php';

$resultXml = (new ArkXMLWriter())
//    ->setIndent(true)
    ->composeDocumentAndFlush(
        (new ArkXMLDocument())
            ->setEncoding(ArkXMLDocument::ENCODING_UTF8)
            ->setVersion('1.0')
            ->setRootElement(
                (new ArkXMLElement('CMBSDKPGK'))
                    ->setAttribute("X", "Y&B")
                    ->appendText("Make 'America' &reat Again!")
                    ->appendCData("Make 'China' &reat Again!")
                    ->appendComment("Make 'Japan' &reat Again!")
                    ->appendSubElement(
                        (new ArkXMLElement('INFO'))
                            ->appendText("Guhehe")
                    )
                    ->appendSubElement(
                        (new ArkXMLElement('INTERFACE'))
                            ->appendText("E&apos;F")
                    )
                    ->appendSubElement(
                        (new ArkXMLElement('INTERFACE'))
                            ->appendText("G'H")
                    )
                    ->appendSubElement(
                        (new ArkXMLElement('INTERFACE'))
                            ->appendText("O'P",true)
                    )
                    ->appendSubElement(
                        (new ArkXMLElement('INTERFACE2'))
                            ->appendText("Ahaha")
                            ->appendRawString('Guhehe')
                    )
                ->appendSubElement(
                    (new ArkXMLElement('NO_CHILD'))
                )
                    ->appendSubElement(
                        (new ArkXMLElement('HAS_GRAND_CHILD'))
                        ->appendSubElement(
                            (new ArkXMLElement('HAS_CHILD'))
                            ->appendSubElement(
                                (new ArkXMLElement('NO_CHILD'))
                            )
                        )
                    )
            )
    );

echo $resultXml.PHP_EOL;

echo "-----".PHP_EOL;

$element=\sinri\ark\xml\reader\ArkXMLReader::simplyParseXMLToElement($resultXml);
$resultXml = (new ArkXMLWriter())
//    ->setIndent(true)
    ->composeDocumentAndFlush(
        (new ArkXMLDocument())->setRootElement($element)
    );
echo $resultXml.PHP_EOL;