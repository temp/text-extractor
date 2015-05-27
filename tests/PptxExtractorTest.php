<?php

/*
 * This file is part of the TextExtractor package.
 *
 * (c) Stephan Wentz <stephan@wentz.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Temp\TextExtractor\Tests;

use Temp\MediaClassifier\Model\MediaType;
use Temp\TextExtractor\PptxExtractor;

/**
 * pptx content extractor test
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class PptxExtractorText extends \PHPUnit_Framework_TestCase
{
    public function testSupportsTrue()
    {
        $extractor = new PptxExtractor();

        $this->assertTrue($extractor->supports('test.pptx', new MediaType('pptx', 'document')));
    }

    public function testSupportsFalse()
    {
        $extractor = new PptxExtractor();

        $this->assertFalse($extractor->supports('test.docx', new MediaType('docx', 'document')));
    }

    public function testExtract()
    {
        $extractor = new PptxExtractor();
        $content = $extractor->extract(__DIR__ . '/fixture/test.pptx');

        $this->assertSame('foo bar baz', (string) $content);
    }
}
