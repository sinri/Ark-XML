<?php


namespace sinri\ark\xml\entity;


use Exception;
use SimpleXMLElement;
use sinri\ark\core\ArkHelper;
use sinri\ark\xml\writer\ArkXMLWriter;

class ArkXMLElement
{
    /**
     * @var string
     */
    protected $elementTag;
    /**
     * @var string[] [name=>value, ...]
     */
    protected $attributeDictionary=[];
    /**
     * @var array
     */
    protected $contentArray=[];

    public function __construct(string $elementTag)
    {
        $this->elementTag=$elementTag;
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
     * @param string $value
     * @return $this
     */
    public function setAttribute($name,$value){
        $this->attributeDictionary[$name]=$value;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function removeAttribute($name){
        unset($this->attributeDictionary[$name]);
        return $this;
    }

    /**
     * @param ArkXMLElement $subElement
     * @return $this
     */
    public function appendSubElement($subElement){
        $this->contentArray[]=$subElement;
        return $this;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function appendComment(string $comment){
        $this->contentArray[]=['comment',$comment];
        return $this;
    }

    /**
     * @param string $cdata
     * @return $this
     */
    public function appendCData(string $cdata){
        $this->contentArray[]=['cdata',$cdata];
        return $this;
    }

    /**
     * @param string $text
     * @param bool $escapeSingleQuote
     * @return $this
     */
    public function appendText(string $text,bool $escapeSingleQuote=false){
        if($escapeSingleQuote) {
            $content = htmlspecialchars($text, ENT_QUOTES | ENT_XML1, 'UTF-8');
            $this->contentArray[] = ['raw',$content];
        }else{
            $this->contentArray[] = $text;
        }
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function appendRawString(string $text){
        $this->contentArray[]=['raw',$text];
        return $this;
    }

    /**
     * @param ArkXMLWriter $writer
     * @throws Exception
     */
    public function compose($writer){
        $writer->startElement($this->elementTag);

        foreach ($this->attributeDictionary as $name => $value) {
            //$writer->startAttribute($name)->text($value)->endAttribute();
            $writer->writeAttribute($name,$value);
        }

        foreach ($this->contentArray as $item){
            if(is_a($item,ArkXMLElement::class)){
                $item->compose($writer);
            }elseif(is_array($item)){
                $type=ArkHelper::readTarget($item,[0]);
                $content=ArkHelper::readTarget($item,[1]);
                switch ($type){
                    case 'comment':
//                        $writer->startComment()->text($content)->endComment();
                        $writer->writeComment($content);
                        break;
                    case 'cdata':
//                        $writer->startCdata()->text($content)->endCData();
                        $writer->writeCdata($content);
                        break;
                    case 'raw':
                        $writer->writeRaw($content);
                        break;
                    default:
                        throw new Exception("unknown format");
                }
            }else{
                $writer->text($item);
            }
        }

        $writer->endElement();
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @return ArkXMLElement
     */
    public static function createWithSimpleXMLElement(SimpleXMLElement $simpleXMLElement){
        $element=new ArkXMLElement($simpleXMLElement->getName());
        foreach ($simpleXMLElement->attributes() as $n=>$v){
            $element->setAttribute($n,$v);
        }
        foreach ($simpleXMLElement->children() as $item){
            $element->appendSubElement(self::createWithSimpleXMLElement($item));
        }
        if($simpleXMLElement->__toString()!=='') {
            $element->appendText($simpleXMLElement->__toString());
        }
//        if(isset($simpleXMLElement->comment)){
//            $element->appendComment($simpleXMLElement->comment);
//        }
        return $element;
    }
}