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
use Temp\TextExtractor\DocxExtractor;

/**
 * docx content extractor test
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class DocxExtractorText extends \PHPUnit_Framework_TestCase
{
    public function testSupportsTrue()
    {
        $extractor = new DocxExtractor();

        $this->assertTrue($extractor->supports('test.docx', new MediaType('docx', 'document')));
    }

    public function testSupportsFalse()
    {
        $extractor = new DocxExtractor();

        $this->assertFalse($extractor->supports('test.xlsx', new MediaType('xlsx', 'document')));
    }

    public function testExtract()
    {
        $extractor = new DocxExtractor();
        $content = $extractor->extract(__DIR__ . '/fixture/test.docx');

        $this->assertSame('foo bar baz', (string) $content);
    }
}
