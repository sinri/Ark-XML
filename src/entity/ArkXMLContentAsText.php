<?php


namespace sinri\ark\xml\entity;


use sinri\ark\xml\exception\ArkXMLComposeError;
use sinri\ark\xml\writer\ArkXMLWriter;

/**
 * Class ArkXMLContentAsText
 * @package sinri\ark\xml\entity
 * @since 0.2
 */
class ArkXMLContentAsText
{
    use ArkXMLContent;

    const CONTENT_TYPE = 'TEXT';
    /**
     * @var string
     */
    protected $content;
    /**
     * @var bool
     */
    protected $raw;

    /**
     * ArkXMLContentAsText constructor.
     * @param string $content
     * @param bool $raw
     */
    public function __construct(string $content, bool $raw = false)
    {
        $this->raw = $raw;
        $this->content = $content;
    }

    /**
     * @param string $content
     * @return ArkXMLContentAsText
     */
    public static function makeFullQuotedText(string $content): ArkXMLContentAsText
    {
        $encoding = 'UTF-8';
        $content = htmlspecialchars($content, ENT_QUOTES | ENT_XML1, $encoding);
        return new ArkXMLContentAsText($content, true);
    }

    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }

    /**
     * @param ArkXMLWriter $writer
     * @throws ArkXMLComposeError
     */
    public function compose(ArkXMLWriter $writer)
    {
        if ($this->raw) {
            $writer->writeRaw($this->content);
        } else {
            $writer->text($this->content);
        }
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}