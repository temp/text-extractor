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
use Temp\TextExtractor\OdpExtractor;

/**
 * odp content extractor test
 *
 * @author Stephan Wentz <stephan@wentz.it>
 */
class OdpExtractorText extends \PHPUnit_Framework_TestCase
{
    public function testSupportsTrue()
    {
        $extractor = new OdpExtractor();

        $this->assertTrue($extractor->supports('test.odp', new MediaType('odp', 'document')));
    }

    public function testSupportsFalse()
    {
        $extractor = new OdpExtractor();

        $this->assertFalse($extractor->supports('test.odt', new MediaType('odt', 'document')));
    }

    public function testExtract()
    {
        $extractor = new OdpExtractor();
        $content = $extractor->extract(__DIR__ . '/fixture/test.odp');

        $this->assertSame('foo bar baz', (string) $content);
    }
}
