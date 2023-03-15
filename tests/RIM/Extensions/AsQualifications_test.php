<?php

/**
 * The MIT License
 *
 * Copyright 2018  Peter Gee <https://github.com/pgee70>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 *
 * see EventSummary_CDAImplementationGuide_v1.3.pdf page 79
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_AsQualifications
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_AsQualifications
 *
 */

use PHPHealth\CDA\Elements\OriginalText;
use PHPHealth\CDA\RIM\Extensions\AsQualifications;
use PHPHealth\CDA\RIM\Extensions\ExtCode;
use PHPHealth\tests\MyTestCase;

class AsQualifications_test extends MyTestCase
{
    public function test_tag()
    {
        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<ext:asQualifications classCode="QUAL">
    <ext:code>
        <originalText>M.B.B.S</originalText>
    </ext:code>
</ext:asQualifications>
CDA;
        $tag      = new AsQualifications(new ExtCode(new OriginalText('M.B.B.S')));
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}