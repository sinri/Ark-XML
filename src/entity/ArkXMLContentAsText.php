<?php


namespace sinri\ark\xml\entity;


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

    public function __construct($content, $raw = false)
    {
        $this->raw = $raw;
        $this->content = $content;
    }

    /**
     * @param string $content
     * @return ArkXMLContentAsText
     */
    public static function makeFullQuotedText(string $content)
    {
        $content = htmlspecialchars($content, ENT_QUOTES | ENT_XML1, 'UTF-8');
        return new ArkXMLContentAsText($content, true);
    }

    public function getContentType()
    {
        return self::CONTENT_TYPE;
    }

    /**
     * @inheritDoc
     */
    public function compose(ArkXMLWriter $writer)
    {
        if ($this->raw) {
            $writer->writeRaw($this->content);
        } else {
            $writer->text($this->content);
        }
    }
}