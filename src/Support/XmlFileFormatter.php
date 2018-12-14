<?php

/**
 * Avoid unexpected return types
 */
declare(strict_types=1);

namespace Leonardo\Arbory\Soap\Support;

use DOMDocument;

/**
 * Class XmlFileFormatter
 * @package Leonardo\Arbory\Soap\Support
 */
class XmlFileFormatter
{
    /**
     * @param string $text
     * @return string
     */
    public static function format(string $text): string
    {
        $doc = new DOMDocument();

        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        $doc->loadXML($text);

        return $doc->loadXML($text) ?: $text;
    }
}