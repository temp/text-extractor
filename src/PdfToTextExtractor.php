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

use Poppler\Processor\PdfFile;
use Temp\MediaClassifier\Model\MediaType;

/**
 * PDF to text content extractor
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class PdfToTextExtractor implements ExtractorInterface
{
    /**
     * @var PdfFile
     */
    private $pdfFile;

    /**
     * @param PdfFile $pdfFile
     */
    public function __construct(PdfFile $pdfFile)
    {
        $this->pdfFile = $pdfFile;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($filename, MediaType $mediaType)
    {
        return $mediaType->getName() === 'pdf';
    }

    /**
     * {@inheritdoc}
     */
    public function extract($filename)
    {
        $output = $this->pdfFile->toText($filename);

        // set pdftotext output as content
        // strip UTF-8 control characters
        $content = new Content(preg_replace('/\p{Co}/u', '', $output));

        return $content;
    }

}
