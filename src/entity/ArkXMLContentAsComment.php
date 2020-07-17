<?php


namespace sinri\ark\xml\entity;


use sinri\ark\xml\writer\ArkXMLWriter;

/**
 * Class ArkXMLContentAsComment
 * @package sinri\ark\xml\entity
 * @since 0.2
 */
class ArkXMLContentAsComment
{
    use ArkXMLContent;

    const CONTENT_TYPE = 'COMMENT';
    /**
     * @var string
     */
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
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
        $writer->writeComment($this->content);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}