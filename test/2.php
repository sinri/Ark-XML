<?php

use sinri\ark\xml\entity\ArkXMLElement;

require_once __DIR__ . '/../vendor/autoload.php';

$element = (new ArkXMLElement('L1'))
    ->setAttribute('x', 1)
    ->appendSubElement(
        (new ArkXMLElement('L2'))
            ->setAttribute('x', 2)
            ->appendText('GUGUGU')
    )
    ->appendSubElement(
        (new ArkXMLElement('L2'))
            ->setAttribute('x', 3)
            ->appendText('HEHEHE')
    );
echo $element->toXML() . PHP_EOL;

echo 'text of L1: ' . $element->getTextContent() . PHP_EOL;

$list = $element->getSubNodesWithFilterConditions('L2');
foreach ($list as $item) {
    echo 'text of L2: ' . $item->getTextContent() . PHP_EOL;
}

echo '----' . PHP_EOL;

$list = $element->getSubNodesWithFilterConditions('L2', ['x' => 3]);
foreach ($list as $item) {
    echo 'text of X: ' . $item->getTextContent() . PHP_EOL;
}

