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

namespace PHPHealth\tests\classes\CDA\Tests\TemplateCode;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_Elements
 * @group       CDA_SignatureCode
 *
 * phpunit-debug  --no-coverage --group CDA_SignatureCode
 *
 */

use PHPHealth\CDA\DataType\Code\CodedSimple;
use PHPHealth\CDA\Elements\SignatureCode;
use PHPHealth\tests\MyTestCase;

class SignatureCode_test extends MyTestCase
{
    public function test_empty_instantiation()
    {
        $expected       = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<signatureCode code="S"/>
CDA;
        $signature_code = new SignatureCode();
        $dom            = new \DOMDocument('1.0', 'UTF-8');
        $doc            = $signature_code->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_string_instantiation()
    {
        $expected       = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<signatureCode code="X"/>
CDA;
        $signature_code = new SignatureCode('X');
        $dom            = new \DOMDocument('1.0', 'UTF-8');
        $doc            = $signature_code->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_coded_instantiation()
    {
        $expected       = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<signatureCode code="Y"/>
CDA;
        $signature_code = new SignatureCode(new CodedSimple('Y'));
        $dom            = new \DOMDocument('1.0', 'UTF-8');
        $doc            = $signature_code->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }


}
