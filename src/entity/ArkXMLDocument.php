<?php


namespace sinri\ark\xml\entity;


use sinri\ark\xml\exception\ArkXMLComposeError;
use sinri\ark\xml\writer\ArkXMLWriter;

class ArkXMLDocument
{
    const ENCODING_UTF8="UTF-8";
    const ENCODING_GBK="GBK";
    const ENCODING_BIG5="BIG5";

    protected $version='1.0';
    protected $encoding;
    protected $standalone;

    /**
     * @var ArkXMLElement
     */
    protected $rootElement;

    /**
     * @return ArkXMLElement
     */
    public function getRootElement(): ArkXMLElement
    {
        return $this->rootElement;
    }

    /**
     * @param ArkXMLElement $rootElement
     * @return ArkXMLDocument
     */
    public function setRootElement(ArkXMLElement $rootElement): ArkXMLDocument
    {
        $this->rootElement = $rootElement;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return ArkXMLDocument
     */
    public function setVersion($version): ArkXMLDocument
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param mixed $encoding
     * @return ArkXMLDocument
     */
    public function setEncoding($encoding): ArkXMLDocument
    {
        $this->encoding = $encoding;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStandalone()
    {
        return $this->standalone;
    }

    /**
     * @param mixed $standalone
     * @return ArkXMLDocument
     */
    public function setStandalone($standalone): ArkXMLDocument
    {
        $this->standalone = $standalone;
        return $this;
    }

    /**
     * @param ArkXMLWriter $writer
     * @throws ArkXMLComposeError
     */
    public function compose(ArkXMLWriter $writer)
    {
        $writer->startDocument($this->version, $this->encoding, $this->standalone);
        $this->rootElement->compose($writer);
        $writer->endDocument();
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