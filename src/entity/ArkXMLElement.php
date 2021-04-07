<?php


namespace sinri\ark\xml\entity;


use SimpleXMLElement;
use sinri\ark\core\ArkHelper;
use sinri\ark\xml\exception\ArkXMLComposeError;
use sinri\ark\xml\writer\ArkXMLWriter;

class ArkXMLElement
{
    use ArkXMLContent;

    const CONTENT_TYPE = 'ELEMENT';
    /**
     * @var string
     */
    protected $elementTag;
    /**
     * @var string[] [name=>value, ...]
     */
    protected $attributeDictionary = [];
    /**
     * @var ArkXMLContent[]
     */
    protected $contentArray=[];

    public function __construct(string $elementTag)
    {
        $this->elementTag = $elementTag;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @return ArkXMLElement
     */
    public static function createWithSimpleXMLElement(SimpleXMLElement $simpleXMLElement): ArkXMLElement
    {
        $element = new ArkXMLElement($simpleXMLElement->getName());
        foreach ($simpleXMLElement->attributes() as $n => $v) {
            $element->setAttribute($n, $v);
        }
        foreach ($simpleXMLElement->children() as $item) {
            $element->appendSubElement(self::createWithSimpleXMLElement($item));
        }
        if ($simpleXMLElement->__toString() !== '') {
            $element->appendText($simpleXMLElement->__toString());
        }
//        if(isset($simpleXMLElement->comment)){
//            $element->appendComment($simpleXMLElement->comment);
//        }
        return $element;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setAttribute(string $name, string $value): ArkXMLElement
    {
        $this->attributeDictionary[$name] = $value;
        return $this;
    }

    /**
     * @param ArkXMLElement $subElement
     * @return $this
     */
    public function appendSubElement(ArkXMLElement $subElement): ArkXMLElement
    {
        $this->contentArray[] = $subElement;
        return $this;
    }

    /**
     * @param string $text
     * @param bool $escapeSingleQuote
     * @return $this
     */
    public function appendText(string $text, bool $escapeSingleQuote = false): ArkXMLElement
    {
        if ($escapeSingleQuote) {
            $this->contentArray[] = ArkXMLContentAsText::makeFullQuotedText($text);
        } else {
            $this->contentArray[] = new ArkXMLContentAsText($text, $escapeSingleQuote);
        }
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAttributeDictionary(): array
    {
        return $this->attributeDictionary;
    }

    /**
     * @param string[] $attributeDictionary
     * @return ArkXMLElement
     */
    public function setAttributeDictionary(array $attributeDictionary): ArkXMLElement
    {
        $this->attributeDictionary = $attributeDictionary;
        return $this;
    }

    /**
     * @return array
     */
    public function getContentArray(): array
    {
        return $this->contentArray;
    }

    /**
     * @param array $contentArray
     * @return ArkXMLElement
     */
    public function setContentArray(array $contentArray): ArkXMLElement
    {
        $this->contentArray = $contentArray;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function removeAttribute(string $name): ArkXMLElement
    {
        unset($this->attributeDictionary[$name]);
        return $this;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function appendComment(string $comment): ArkXMLElement
    {
        $this->contentArray[] = new ArkXMLContentAsComment($comment);
        return $this;
    }

    /**
     * @param string $cdata
     * @return $this
     */
    public function appendCData(string $cdata): ArkXMLElement
    {
        $this->contentArray[] = new ArkXMLContentAsCData($cdata);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function appendRawString(string $text): ArkXMLElement
    {
        $this->contentArray[] = new ArkXMLContentAsText($text, true);
        return $this;
    }

    /**
     * @param ArkXMLWriter $writer
     * @throws ArkXMLComposeError
     */
    public function compose(ArkXMLWriter $writer)
    {
        $writer->startElement($this->elementTag);

        foreach ($this->attributeDictionary as $name => $value) {
            $writer->writeAttribute($name, $value);
        }

        foreach ($this->contentArray as $item) {
            // @since 0.2 changed the logic
            $item->compose($writer);
        }

        $writer->endElement();
    }

    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }

    /**
     * @param int $index
     * @return ArkXMLContent|null
     * @since 0.3
     */
    public function getContentByIndex(int $index): ArkXMLContent
    {
        return ArkHelper::readTarget($this->contentArray, [$index]);
    }

    /**
     * @param string $tagName
     * @param array $attributes [key=>value, ...]
     * @return ArkXMLElement[]
     * @since 0.3
     */
    public function getSubNodesWithFilterConditions(string $tagName, array $attributes = []): array
    {
        $allSubElements = $this->getAllSubElements();

        $filtered = [];
        foreach ($allSubElements as $item) {
            if ($item->getElementTag() !== $tagName) {
                continue;
            }
            foreach ($attributes as $attributeName => $attributeValue) {
                if ($item->getAttribute($attributeName) !== $attributeValue) {
                    continue;
                }
            }
            $filtered[] = $item;
        }

        return $filtered;
    }

    /**
     * @return ArkXMLElement[]
     * @since 0.3
     */
    public function getAllSubElements(): array
    {
        $nodes = [];
        foreach ($this->contentArray as $content) {
            if ($content->getContentType() === ArkXMLElement::CONTENT_TYPE) {
                $nodes[] = $content;
            }
        }
        return $nodes;
    }

    /**
     * @return string
     */
    public function getElementTag(): string
    {
        return $this->elementTag;
    }

    /**
     * @param string $elementTag
     * @return ArkXMLElement
     */
    public function setElementTag(string $elementTag): ArkXMLElement
    {
        $this->elementTag = $elementTag;
        return $this;
    }

    /**
     * @param string $name
     * @return string|null
     * @since 0.3
     */
    public function getAttribute(string $name): string
    {
        return ArkHelper::readTarget($this->attributeDictionary, [$name]);
    }

    /**
     * @return string
     * @since 0.3
     */
    public function getTextContent(): string
    {
        $text = '';
        foreach ($this->contentArray as $content) {
            if (
                $content->getContentType() === ArkXMLContentAsText::CONTENT_TYPE
                || $content->getContentType() === ArkXMLContentAsCData::CONTENT_TYPE
            ) {
                $text .= $content->getContent();
            }
        }
        return $text;
    }

    /**
     * @return string
     * @throws ArkXMLComposeError
     */
    public function toXML(): string
    {
        $writer = (new ArkXMLWriter());
        $this->compose($writer);
        return $writer->getOutputInMemory();
    }
}