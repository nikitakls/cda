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
 * Test Addr element
 *
 * @author     julien.fastre@champs-libres.coop
 * @group      CDA
 * @group      CDA_Elements
 * @group      CDA_addresses
 *
 * phpunit-debug  --no-coverage --group CDA_addresses
 *
 */

use PHPHealth\CDA\Elements\Address\AdditionalLocator;
use PHPHealth\CDA\Elements\Address\Addr;
use PHPHealth\CDA\Elements\Address\City;
use PHPHealth\CDA\Elements\Address\PostalCode;
use PHPHealth\CDA\Elements\Address\State;
use PHPHealth\CDA\Elements\Address\StreetAddressLine;
use PHPHealth\tests\MyTestCase;

class Addr_test extends MyTestCase
{
    public function test_street_address_line()
    {
        $expected = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<addr use="WP">
  <streetAddressLine>1 clinician street</streetAddressLine>
  <city>Nethaville</city>
  <state>QLD</state>
  <postalCode>5555</postalCode>
  <additionalLocator>xyz</additionalLocator>
</addr>

XML;
        $address  = new Addr(
          new StreetAddressLine('1 clinician street'),
          new City('Nethaville'),
          new State('QLD'),
          new PostalCode('5555'),
          new AdditionalLocator('xyz')
        );
        $address->setUseAttribute('WP');
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $doc               = $address->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_state_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The state value unit-tester is not valid!');
        new State('unit-tester');
    }
}