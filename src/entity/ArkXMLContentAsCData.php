<?php


namespace sinri\ark\xml\entity;


use sinri\ark\xml\exception\ArkXMLComposeError;
use sinri\ark\xml\writer\ArkXMLWriter;

/**
 * Class ArkXMLContentAsCData
 * @package sinri\ark\xml\entity
 * @since 0.2
 */
class ArkXMLContentAsCData
{
    use ArkXMLContent;

    const CONTENT_TYPE = 'CDATA';
    /**
     * @var string
     */
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
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
        $writer->writeCdata($this->content);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}