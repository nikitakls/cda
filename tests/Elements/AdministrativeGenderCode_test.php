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

namespace PHPHealth\tests\classes\CDA\Elements;

/**
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_Elements
 * @group       CDA_AdministrativeGenderCode
 *
 * phpunit-debug  --no-coverage --group CDA_AdministrativeGenderCode
 *
 */


use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AdministrativeGenderCode;
use PHPHealth\tests\MyTestCase;

class AdministrativeGenderCode_test extends MyTestCase
{
    public function test_coded_value()
    {
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<administrativeGenderCode code="M" displayName="Male" codeSystem="2.16.840.1.113883.13.68" codeSystemName="AS 5017-2006 Health Care Client Identifier Sex" />

XML;

        $tag = new AdministrativeGenderCode(new CodedValue('M', 'Male', '2.16.840.1.113883.13.68', 'AS 5017-2006 Health Care Client Identifier Sex'));
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_string_overload()
    {
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<administrativeGenderCode code="M" displayName="Male" codeSystem="2.16.840.1.113883.13.68" codeSystemName="AS 5017-2006 Health Care Client Identifier Sex" />

XML;

        $tag = new AdministrativeGenderCode('M');
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The sex value XXX is not valid!');
        new AdministrativeGenderCode('XXX');
    }

}