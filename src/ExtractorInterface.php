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
 * Extractor interface
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
interface ExtractorInterface
{
    /**
     * Check if extractor supports the given file
     *
     * @param string    $filename
     * @param MediaType $mediaType
     *
     * @return bool
     */
    public function supports($filename, MediaType $mediaType);

    /**
     * Extract from file
     *
     * @param string $filename
     *
     * @return string
     */
    public function extract($filename);
}
