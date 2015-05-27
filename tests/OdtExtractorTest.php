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
use Temp\TextExtractor\OdtExtractor;

/**
 * odt content extractor test
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class OdtExtractorText extends \PHPUnit_Framework_TestCase
{
    public function testSupportsTrue()
    {
        $extractor = new OdtExtractor();

        $this->assertTrue($extractor->supports('test.odt', new MediaType('odt', 'document')));
    }

    public function testSupportsFalse()
    {
        $extractor = new OdtExtractor();

        $this->assertFalse($extractor->supports('test.ods', new MediaType('ods', 'document')));
    }

    public function testExtract()
    {
        $extractor = new OdtExtractor();
        $content = $extractor->extract(__DIR__ . '/fixture/test.odt');

        $this->assertSame('foo bar baz', (string) $content);
    }
}
