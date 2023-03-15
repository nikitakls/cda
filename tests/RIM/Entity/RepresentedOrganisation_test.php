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

namespace PHPHealth\tests\classes\CDA\RIM\Extensions;

/**
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_RepresentedOrganisation
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_RepresentedOrganisation
 *
 */


use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\DataType\TextAndMultimedia\SimpleString;
use PHPHealth\CDA\RIM\Entity\RepresentedOrganization;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\RIM\Extensions\AssigningGeographicArea;
use PHPHealth\CDA\RIM\Extensions\ExtEntityName;
use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\tests\MyTestCase;

class RepresentedOrganisation_test extends MyTestCase
{
    public function test_Id()
    {
        $expected                 = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<representedOrganization classCode="IDENT">
  <name>Good Health Clinic</name>
  <ext:asEntityIdentifier classCode="IDENT">
    <ext:id assigningAuthorityName="HPI-O" root="1.2.36.1.2001.1003.0" extension="8003621566684455"/>
    <ext:assigningGeographicArea classCode="PLC">
      <ext:name>National Identifier</ext:name>
    </ext:assigningGeographicArea>
  </ext:asEntityIdentifier>
</representedOrganization>

XML;
        $represented_organisation = new RepresentedOrganization(
          new EntityName('Good Health Clinic'),
          new AsEntityIdentifier(
            new ExtId('HPI-O', '1.2.36.1.2001.1003.0', '8003621566684455'),
            new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))));
        $dom                      = new \DOMDocument('1.0', 'UTF-8');
        $doc                      = $represented_organisation->toDOMElement($dom);
        $dom->formatOutput        = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}