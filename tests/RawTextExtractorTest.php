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
use Temp\TextExtractor\RawTextExtractor;

/**
 * Raw text extractor test
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class RawTextExtractorText extends \PHPUnit_Framework_TestCase
{
    public function testSupportsTrue()
    {
        $extractor = new RawTextExtractor();

        $this->assertTrue($extractor->supports('test.txt', new MediaType('plain', 'text')));
    }

    public function testSupportsFalse()
    {
        $extractor = new RawTextExtractor();

        $this->assertFalse($extractor->supports('test.jpg', new MediaType('jpg', 'image')));
    }

    public function testExtract()
    {
        $extractor = new RawTextExtractor();
        $content = $extractor->extract(__FILE__);

        $this->assertSame(file_get_contents(__FILE__), (string) $content);
    }
}
