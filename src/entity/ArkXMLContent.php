<?php


namespace sinri\ark\xml\entity;


use sinri\ark\xml\exception\ArkXMLComposeError;
use sinri\ark\xml\writer\ArkXMLWriter;

/**
 * Trait ArkXMLContent
 * @package sinri\ark\xml\entity
 * @since 0.2
 */
trait ArkXMLContent
{
    /**
     * @return string
     */
    abstract public function getContentType(): string;

    /**
     * @param ArkXMLWriter $writer
     * @return void
     * @throws ArkXMLComposeError
     */
    abstract public function compose(ArkXMLWriter $writer);

    /**
     * @return string
     * @since 0.3
     */
    public function getContent(): string
    {
        // should be overrode if needed
        return __CLASS__;
    }
}