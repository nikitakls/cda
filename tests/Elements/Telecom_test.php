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
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 *
 * @group       CDA
 * @group       CDA_Elements
 * @group       CDA_Telecom
 *
 * phpunit-debug  --no-coverage --group CDA_Telecom
 *
 */


use PHPHealth\CDA\DataType\Code\AddressCodeType;
use PHPHealth\CDA\DataType\ValueType;
use PHPHealth\CDA\Elements\Address\Telecom;
use PHPHealth\tests\MyTestCase;

class Telecom_test extends MyTestCase
{
    public function test_with_strings()
    {
        $expected = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<telecom use=\"WP\" value=\"tel:123456789\"/>\n";
        $telecom  = new Telecom('WP', 'tel:123456789');
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $telecom->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_with_classes()
    {
        $expected = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<telecom use=\"WP\" value=\"tel:123456789\"/>\n";
        $telecom  = new Telecom(new AddressCodeType('WP'), new ValueType('tel:123456789'));
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $telecom->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }


}
