<?php

/*
 * This file is part of the TextExtractor package.
 *
 * (c) Stephan Wentz <stephan@wentz.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Temp\TextExtractor;

use Temp\MediaClassifier\Model\MediaType;

/**
 * Raw text content extract
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class RawTextExtractor implements ExtractorInterface
{
    /**
     * @var string
     */
    private $encoding;

    /**
     * @param string $encoding
     */
    public function __construct($encoding = 'UTF-8')
    {
        $this->encoding = $encoding;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($filename, MediaType $mediaType)
    {
        return $mediaType->getCategory() === 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function extract($filename)
    {
        // fetch text from file
        $contents = file_get_contents($filename);

        // ensure utf8 encoding
        $fromEncoding = mb_detect_encoding($contents);
        mb_convert_encoding($contents, $fromEncoding, $this->encoding);

        // use text as content
        $content = new Content($contents);

        return $content;
    }

}
