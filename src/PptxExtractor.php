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

use Symfony\Component\DomCrawler\Crawler;
use Temp\MediaClassifier\Model\MediaType;

/**
 * pptx content extractor
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class PptxExtractor implements ExtractorInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($filename, MediaType $mediaType)
    {
        return $mediaType->getName() === 'pptx';
    }

    /**
     * {@inheritdoc}
     */
    public function extract($filename)
    {
        $content = new Content($this->readPptx($filename));

        return $content;
    }

    private function readPptx($filename)
    {
        $content = $this->readZippedXML($filename, "xl/sharedStrings.xml");

        $crawler = new Crawler($content);
        $crawler = $crawler->filterXPath('//text()');
        $texts = array();
        foreach ($crawler as $domElement) {
            $texts[] = $domElement->wholeText;
        }

        return implode(' ', $texts);
    }

    private function readZippedXML($archiveFile)
    {
        $data = '';

        $zip = new \ZipArchive;

        if (true === $zip->open($archiveFile)) {
            $slideNumber = 1;
            while (($index = $zip->locateName("ppt/slides/slide$slideNumber.xml")) !== false) {
                $data .= $zip->getFromIndex($index);
                $slideNumber++;
            }
            $zip->close();
        }

        return $data;
    }
}
