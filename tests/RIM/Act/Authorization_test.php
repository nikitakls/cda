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

namespace PHPHealth\tests\classes\CDA\Tests\RIM\Act;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_Authorization
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_Authorization
 *
 */

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\StatusCodeElement;
use PHPHealth\CDA\RIM\Act\Authorization;
use PHPHealth\CDA\RIM\Act\Consent;
use PHPHealth\tests\MyTestCase;

class Authorization_test extends MyTestCase
{
    /**
     * see page 118 of EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_tag()
    {
        $expected          = <<<'CDA'
<authorization typeCode="AUTH">
    <consent moodCode="EVN" classCode="CONS">
        <code code="a" codeSystem="b" codeSystemName="c" displayName="d"/>
        <statusCode code="completed"></statusCode>
    </consent>
</authorization>

CDA;
        $tag               = new Authorization(
          (new Consent())
            ->setCodedValue(new CodedValue('a', 'd', 'b', 'c'))
            ->setStatusCode(StatusCodeElement::Completed()));
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_bad_class_code()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The class code xxx is not valid!');
        (new Consent())->setClassCode('xxx');
    }

    public function test_bad_mood_code()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The mood code xxx is not valid!');
        (new Consent())->setMoodCode('xxx');
    }

    public function test_bad_type_code()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The type code xxx is not valid!');
        (new Authorization(new Consent()))->setTypeCode('xxx');
    }
}

