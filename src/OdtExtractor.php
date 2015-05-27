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
 * odt content extractor
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class OdtExtractor implements ExtractorInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($filename, MediaType $mediaType)
    {
        return $mediaType->getName() === 'odt';
    }

    /**
     * {@inheritdoc}
     */
    public function extract($filename)
    {
        $content = new Content($this->readOdt($filename));

        return $content;
    }

    private function readOdt($filename)
    {
        $content = $this->readZippedXML($filename);

        $crawler = new Crawler($content);
        $crawler = $crawler->filterXPath('//text()');
        $texts = array();
        foreach ($crawler as $domElement) {
            $texts[] = $domElement->wholeText;
        }

        return implode(' ', $texts);
    }

    private function readZippedXML($archiveFile) {
        $data = '';

        $zip = new \ZipArchive;

        if (true === $zip->open($archiveFile)) {
            // If done, search for the data file in the archive
            if (($index = $zip->locateName("content.xml")) !== false) {
                // If found, read it to the string
                $data = $zip->getFromIndex($index);
                // Close archive file
            }
            $zip->close();
        }

        return $data;
    }
}
