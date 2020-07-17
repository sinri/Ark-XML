<?php


namespace sinri\ark\xml\writer;


use Exception;
use sinri\ark\core\ArkHelper;
use sinri\ark\xml\entity\ArkXMLDocument;
use sinri\ark\xml\entity\ArkXMLElement;
use XMLWriter;

class ArkXMLWriter
{
    /**
     * @var XMLWriter
     */
    protected $rawXMLWriter;

    /**
     * @var null|string
     * NULL for Memory Output
     * STRING for URI Output
     */
    protected $outputTarget = null;

    /**
     * ArkXMLWriter constructor.
     * @param null|string $outputUri
     * @throws Exception
     */
    public function __construct(string $outputUri=null)
    {
        $this->rawXMLWriter = new XMLWriter();
        if($outputUri===null){
            $this->openMemory();
        }else{
            $this->openUri($outputUri);
        }
    }

    /**
     * @return XMLWriter
     */
    public function getRawXMLWriter()
    {
        return $this->rawXMLWriter;
    }

    /**
     * Create new xmlwriter using memory for string output
     * @return $this
     * @throws Exception
     */
    protected function openMemory()
    {
        $done = $this->rawXMLWriter->openMemory();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        $this->outputTarget = null;
        return $this;
    }

    /**
     * Create new xmlwriter using source uri for output
     * @param string $uri Output Target URI. A sample is 'php://output' for web XML display with non-download header
     * @return $this
     * @throws Exception
     */
    protected function openUri(string $uri)
    {
        $done = $this->rawXMLWriter->openUri($uri);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        $this->outputTarget = $uri;
        return $this;
    }

    /**
     * Returns current buffer
     * @param bool $flush Whether to flush the output buffer or not. Default is TRUE.
     * @return string
     */
    public function getOutputInMemory($flush = true)
    {
        return $this->rawXMLWriter->outputMemory($flush);
    }

    /**
     * Flush current buffer
     * @param bool $empty Whether to empty the buffer or not. Default is TRUE.
     * @return string|int
     * If you opened the writer in memory, this function returns the generated XML buffer, Else, if using URI, this function will write the buffer and return the number of written bytes.
     */
    public function flush($empty = true)
    {
        return $this->rawXMLWriter->flush($empty);
    }

    /**
     * Sets the string which will be used to indent each element/attribute of the resulting xml.
     * @param string $indentString
     * @return $this
     * @throws Exception
     */
    public function setIndentString(string $indentString)
    {
        $done = $this->rawXMLWriter->setIndentString($indentString);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Toggles indentation on or off.
     * @param bool $indent
     * @return $this
     * @throws Exception
     */
    public function setIndent(bool $indent)
    {
        $done = $this->rawXMLWriter->setIndent($indent);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * End attribute
     * @return $this
     * @throws Exception
     */
    public function endAttribute()
    {
        $done = $this->rawXMLWriter->endAttribute();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * End current CDATA
     * @return $this
     * @throws Exception
     */
    public function endCData()
    {
        $done = $this->rawXMLWriter->endCdata();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the current comment.
     * @return $this
     * @throws Exception
     */
    public function endComment()
    {
        $done = $this->rawXMLWriter->endComment();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the current document.
     * @return $this
     * @throws Exception
     */
    public function endDocument()
    {
        $done = $this->rawXMLWriter->endDocument();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the current DTD attribute list.
     * @return $this
     * @throws Exception
     */
    public function endDtdAttlist()
    {
        $done = $this->rawXMLWriter->endDtdAttlist();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the current DTD element.
     * @return $this
     * @throws Exception
     */
    public function endDtdElement()
    {
        $done = $this->rawXMLWriter->endDtdElement();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the current DTD entity.
     * @return $this
     * @throws Exception
     */
    public function endDtdEntity()
    {
        $done = $this->rawXMLWriter->endDtdEntity();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the DTD of the document.
     * @return $this
     * @throws Exception
     */
    public function endDtd()
    {
        $done = $this->rawXMLWriter->endDtd();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Ends the current element.
     * @return $this
     * @throws Exception
     */
    public function endElement()
    {
        $done = $this->rawXMLWriter->endElement();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function endPi()
    {
        $done = $this->rawXMLWriter->endPi();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * @param string $prefix The namespace prefix.
     * @param string $name The attribute name.
     * @param string $uri The namespace URI.
     * @return $this
     * @throws Exception
     */
    public function startAttributeNs(string $prefix, string $name, string $uri)
    {
        $done = $this->rawXMLWriter->startAttributeNs($prefix, $name, $uri);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts an attribute.
     * @param string $name The attribute name.
     * @return $this
     * @throws Exception
     */
    public function startAttribute(string $name)
    {
        $done = $this->rawXMLWriter->startAttribute($name);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a CDATA.
     * @return $this
     * @throws Exception
     */
    public function startCdata()
    {
        $done = $this->rawXMLWriter->startCdata();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a comment.
     * @return $this
     * @throws Exception
     */
    public function startComment()
    {
        $done = $this->rawXMLWriter->startComment();
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a document.
     * @param string $version The version number of the document as part of the XML declaration.
     * @param string|null $encoding The encoding of the document as part of the XML declaration.
     * @param string|null $standalone yes or no.
     * @return $this
     * @throws Exception
     */
    public function startDocument(string $version = '1.0', string $encoding = NULL, string $standalone = NULL)
    {
        $done = $this->rawXMLWriter->startDocument($version, $encoding, $standalone);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a DTD attribute list.
     * @param string $name The attribute list name.
     * @return $this
     * @throws Exception
     */
    public function startDtdAttlist(string $name)
    {
        $done = $this->rawXMLWriter->startDtdAttlist($name);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a DTD element.
     * @param string $qualifiedName The qualified name of the document type to create.
     * @return $this
     * @throws Exception
     */
    public function startDtdElement(string $qualifiedName)
    {
        $done = $this->rawXMLWriter->startDtdElement($qualifiedName);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a DTD entity.
     * @param string $name The name of the entity.
     * @param bool $isParameter
     * @return $this
     * @throws Exception
     */
    public function startDtdEntity(string $name, bool $isParameter)
    {
        $done = $this->rawXMLWriter->startDtdEntity($name, $isParameter);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a DTD.
     * @param string $qualifiedName The qualified name of the document type to create.
     * @param string $publicId The external subset public identifier.
     * @param string $systemId The external subset system identifier.
     * @return $this
     * @throws Exception
     */
    public function startDtd(string $qualifiedName, string $publicId, string $systemId)
    {
        $done = $this->rawXMLWriter->startDtd($qualifiedName, $publicId, $systemId);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a namespaced element.
     * @param string $prefix The namespace prefix.
     * @param string $name The element name.
     * @param string $uri The namespace URI.
     * @return $this
     * @throws Exception
     */
    public function startElementNs(string $prefix, string $name, string $uri)
    {
        $done = $this->rawXMLWriter->startElementNs($prefix, $name, $uri);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts an element.
     * @param string $name The element name.
     * @return $this
     * @throws Exception
     */
    public function startElement(string $name)
    {
        $done = $this->rawXMLWriter->startElement($name);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Starts a processing instruction tag.
     * @param string $target The target of the processing instruction.
     * @return $this
     * @throws Exception
     */
    public function startPi(string $target)
    {
        $done = $this->rawXMLWriter->startPi($target);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a text.
     * @param string $string The contents of the text.
     * @return $this
     * @throws Exception
     *
     * Notice:
     * Correct Escape
     * `>` into `&gt;`
     * `<` into `&lt;`
     * `&` into `&amp;`
     * `"` into `&quot;`
     * However,
     * Will Ignore `'`, not into `&apos;`
     */
    public function text(string $string){
        $done = $this->rawXMLWriter->text($string);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full namespaced attribute.
     * @param string $prefix The namespace prefix.
     * @param string $name The attribute name.
     * @param string $uri The namespace URI.
     * @param string $content The attribute value.
     * @return $this
     * @throws Exception
     */
    public function writeAttributeNs ( string $prefix , string $name , string $uri , string $content ){
        $done = $this->rawXMLWriter->writeAttributeNs($prefix,$name,$uri,$content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full attribute.
     * @param string $name The name of the attribute.
     * @param string $value The value of the attribute.
     * @return $this
     * @throws Exception
     */
    public function writeAttribute ( string $name , string $value ){
        $done = $this->rawXMLWriter->writeAttribute($name,$value);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full CDATA.
     * @param string $content The contents of the CDATA.
     * @return $this
     * @throws Exception
     */
    public function writeCdata ( string $content ) {
        $done = $this->rawXMLWriter->writeCdata($content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full comment.
     * @param string $content The contents of the comment.
     * @return $this
     * @throws Exception
     */
    public function writeComment ( string $content ){
        $done = $this->rawXMLWriter->writeComment($content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a DTD attribute list.
     * @param string $name The name of the DTD attribute list.
     * @param string $content The content of the DTD attribute list.
     * @return $this
     * @throws Exception
     */
    public function writeDtdAttlist ( string $name , string $content ) {
        $done = $this->rawXMLWriter->writeDtdAttlist($name,$content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full DTD element.
     * @param string $name The name of the DTD element.
     * @param string $content The content of the element.
     * @return $this
     * @throws Exception
     */
    public function writeDtdElement ( string $name , string $content ){
        $done = $this->rawXMLWriter->writeDtdElement($name,$content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full DTD entity.
     * @param string $name The name of the entity.
     * @param string $content The content of the entity.
     * @undocumented bool $pe
     * @undocumented string $pubid
     * @undocumented string $sysid
     * @undocumented string $ndataid
     * @return $this
     * @throws Exception
     */
    public function writeDtdEntity ( string $name , string $content){
        $done = $this->rawXMLWriter->writeDtdEntity($name,$content,false,'','','');
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full DTD.
     * @param string $name The DTD name.
     * @param string $publicId The external subset public identifier.
     * @param string $systemId The external subset system identifier.
     * @param string $subset The content of the DTD.
     * @return $this
     * @throws Exception
     */
    public function writeDtd(string $name ,string $publicId,string $systemId,string $subset){
        $done = $this->rawXMLWriter->writeDtd($name,$publicId,$systemId,$subset);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a full namespaced element tag.
     * @param string $prefix The namespace prefix.
     * @param string $name The element name.
     * @param string $uri The namespace URI.
     * @param string $content The element contents.
     * @return $this
     * @throws Exception
     */
    public function writeElementNs ( string $prefix , string $name , string $uri , string $content ){
        $done = $this->rawXMLWriter->writeElementNs($prefix,$name,$uri,$content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * @param string $name
     * @param string $content
     * @return $this
     * @throws Exception
     */
    public function writeElement ( string $name , string $content  )
    {
        $done = $this->rawXMLWriter->writeElement($name, $content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a processing instruction.
     * @param string $target The target of the processing instruction.
     * @param string $content The content of the processing instruction.
     * @return $this
     * @throws Exception
     */
    public function writePi ( string $target , string $content ){
        $done = $this->rawXMLWriter->writePi($target, $content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * Writes a raw xml text.
     * @param string $content The text string to write.
     * @return $this
     * @throws Exception
     */
    public function writeRaw ( string $content ){
        $done = $this->rawXMLWriter->writeRaw($content);
        ArkHelper::quickNotEmptyAssert(__METHOD__ . ' Error', $done);
        return $this;
    }

    /**
     * @param ArkXMLDocument $document
     * @return int|string
     * @throws Exception
     * @deprecated
     */
    public function composeDocumentAndFlush($document)
    {
        $document->compose($this);
        return $this->flush();
    }

    /**
     * @param ArkXMLElement $element
     * @return int|string
     * @throws Exception
     * @deprecated
     */
    public function composeElementAndFlush($element)
    {
        $element->compose($this);
        return $this->flush();
    }
}