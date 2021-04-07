<?php


namespace sinri\ark\xml\writer;


use sinri\ark\xml\entity\ArkXMLDocument;
use sinri\ark\xml\entity\ArkXMLElement;
use sinri\ark\xml\exception\ArkXMLComposeError;
use sinri\ark\xml\exception\ArkXMLWriterSetupError;
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
     * @throws ArkXMLWriterSetupError
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
    public function getRawXMLWriter(): XMLWriter
    {
        return $this->rawXMLWriter;
    }

    /**
     * Create new xmlwriter using memory for string output
     * @return $this
     * @throws ArkXMLWriterSetupError
     */
    protected function openMemory(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->openMemory();
        if (!$done) {
            throw new ArkXMLWriterSetupError('Cannot create memory based instance of XMLWriter.');
        }
        $this->outputTarget = null;
        return $this;
    }

    /**
     * Create new xmlwriter using source uri for output
     * @param string $uri Output Target URI. A sample is 'php://output' for web XML display with non-download header
     * @return $this
     * @throws ArkXMLWriterSetupError
     */
    protected function openUri(string $uri): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->openUri($uri);
        if (!$done) {
            throw new ArkXMLWriterSetupError('Cannot create URI based instance of XMLWriter.');
        }
        $this->outputTarget = $uri;
        return $this;
    }

    /**
     * Returns current buffer
     * @param bool $flush Whether to flush the output buffer or not. Default is TRUE.
     * @return string
     */
    public function getOutputInMemory($flush = true): string
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
     * @throws ArkXMLComposeError
     */
    public function setIndentString(string $indentString): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->setIndentString($indentString);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Toggles indentation on or off.
     * @param bool $indent
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function setIndent(bool $indent): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->setIndent($indent);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * End attribute
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endAttribute(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endAttribute();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * End current CDATA
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endCData(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endCdata();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the current comment.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endComment(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endComment();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the current document.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endDocument(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endDocument();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the current DTD attribute list.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endDtdAttlist(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endDtdAttlist();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the current DTD element.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endDtdElement(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endDtdElement();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the current DTD entity.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endDtdEntity(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endDtdEntity();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the DTD of the document.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endDtd(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endDtd();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Ends the current element.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endElement(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endElement();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function endPi(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->endPi();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * @param string $prefix The namespace prefix.
     * @param string $name The attribute name.
     * @param string $uri The namespace URI.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startAttributeNs(string $prefix, string $name, string $uri): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startAttributeNs($prefix, $name, $uri);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts an attribute.
     * @param string $name The attribute name.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startAttribute(string $name): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startAttribute($name);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a CDATA.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startCdata(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startCdata();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a comment.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startComment(): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startComment();
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a document.
     * @param string $version The version number of the document as part of the XML declaration.
     * @param string|null $encoding The encoding of the document as part of the XML declaration.
     * @param string|null $standalone yes or no.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startDocument(string $version = '1.0', string $encoding = NULL, string $standalone = NULL): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startDocument($version, $encoding, $standalone);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a DTD attribute list.
     * @param string $name The attribute list name.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startDtdAttlist(string $name): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startDtdAttlist($name);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a DTD element.
     * @param string $qualifiedName The qualified name of the document type to create.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startDtdElement(string $qualifiedName): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startDtdElement($qualifiedName);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a DTD entity.
     * @param string $name The name of the entity.
     * @param bool $isParameter
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startDtdEntity(string $name, bool $isParameter): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startDtdEntity($name, $isParameter);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a DTD.
     * @param string $qualifiedName The qualified name of the document type to create.
     * @param string $publicId The external subset public identifier.
     * @param string $systemId The external subset system identifier.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startDtd(string $qualifiedName, string $publicId, string $systemId): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startDtd($qualifiedName, $publicId, $systemId);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a namespaced element.
     * @param string $prefix The namespace prefix.
     * @param string $name The element name.
     * @param string $uri The namespace URI.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startElementNs(string $prefix, string $name, string $uri): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startElementNs($prefix, $name, $uri);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts an element.
     * @param string $name The element name.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startElement(string $name): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startElement($name);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Starts a processing instruction tag.
     * @param string $target The target of the processing instruction.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function startPi(string $target): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->startPi($target);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a text.
     *
     * Notice:
     * Correct Escape
     * `>` into `&gt;`
     * `<` into `&lt;`
     * `&` into `&amp;`
     * `"` into `&quot;`
     * However,
     * Will Ignore `'`, not into `&apos;`
     *
     * @param string $string The contents of the text.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function text(string $string): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->text($string);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full namespaced attribute.
     * @param string $prefix The namespace prefix.
     * @param string $name The attribute name.
     * @param string $uri The namespace URI.
     * @param string $content The attribute value.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeAttributeNs(string $prefix, string $name, string $uri, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeAttributeNs($prefix, $name, $uri, $content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full attribute.
     * @param string $name The name of the attribute.
     * @param string $value The value of the attribute.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeAttribute(string $name, string $value): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeAttribute($name, $value);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full CDATA.
     * @param string $content The contents of the CDATA.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeCdata(string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeCdata($content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full comment.
     * @param string $content The contents of the comment.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeComment(string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeComment($content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a DTD attribute list.
     * @param string $name The name of the DTD attribute list.
     * @param string $content The content of the DTD attribute list.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeDtdAttlist(string $name, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeDtdAttlist($name, $content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full DTD element.
     * @param string $name The name of the DTD element.
     * @param string $content The content of the element.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeDtdElement(string $name, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeDtdElement($name, $content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
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
     * @throws ArkXMLComposeError
     */
    public function writeDtdEntity(string $name, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeDtdEntity($name, $content, false, '', '', '');
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full DTD.
     * @param string $name The DTD name.
     * @param string $publicId The external subset public identifier.
     * @param string $systemId The external subset system identifier.
     * @param string $subset The content of the DTD.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeDtd(string $name, string $publicId, string $systemId, string $subset): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeDtd($name, $publicId, $systemId, $subset);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a full namespaced element tag.
     * @param string $prefix The namespace prefix.
     * @param string $name The element name.
     * @param string $uri The namespace URI.
     * @param string $content The element contents.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeElementNs(string $prefix, string $name, string $uri, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeElementNs($prefix, $name, $uri, $content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * @param string $name
     * @param string $content
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeElement(string $name, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeElement($name, $content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a processing instruction.
     * @param string $target The target of the processing instruction.
     * @param string $content The content of the processing instruction.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writePi(string $target, string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writePi($target, $content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * Writes a raw xml text.
     * @param string $content The text string to write.
     * @return $this
     * @throws ArkXMLComposeError
     */
    public function writeRaw(string $content): ArkXMLWriter
    {
        $done = $this->rawXMLWriter->writeRaw($content);
        if (!$done) {
            throw new ArkXMLComposeError('XML Writer Error: Method [' . __METHOD__ . '] could not be done.');
        }
        return $this;
    }

    /**
     * @param ArkXMLDocument $document
     * @return int|string
     * @throws ArkXMLComposeError
     * @deprecated
     */
    public function composeDocumentAndFlush(ArkXMLDocument $document)
    {
        $document->compose($this);
        return $this->flush();
    }

    /**
     * @param ArkXMLElement $element
     * @return int|string
     * @throws ArkXMLComposeError
     * @deprecated
     */
    public function composeElementAndFlush(ArkXMLElement $element)
    {
        $element->compose($this);
        return $this->flush();
    }
}