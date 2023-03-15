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
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_AsEmployment
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_AsEmployment
 *
 */

use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\DataType\TextAndMultimedia\SimpleString;
use PHPHealth\CDA\Elements\Address\Addr;
use PHPHealth\CDA\Elements\Address\Telecom;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\OriginalText;
use PHPHealth\CDA\RIM\Entity\WholeOrganisation;
use PHPHealth\CDA\RIM\Extensions\AsEmployment;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\RIM\Extensions\AssigningGeographicArea;
use PHPHealth\CDA\RIM\Extensions\ExtCode;
use PHPHealth\CDA\RIM\Extensions\ExtEmployerOrganization;
use PHPHealth\CDA\RIM\Extensions\ExtEntityName;
use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\CDA\RIM\Extensions\JobClassCode;
use PHPHealth\CDA\RIM\Role\AsOrganizationPartOf;
use PHPHealth\tests\MyTestCase;


class AsEmployment_test extends MyTestCase
{
    public function test_tag()
    {
        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<ext:asEmployment classCode="EMP">
  <!-- Position In Organisation -->
    <ext:code>
      <originalText>GP</originalText>
    </ext:code>
    <code code="253111" codeSystem="2.16.840.1.113883.13.62" codeSystemName="1220.0 - ANZSCO -- Australian and New Zealand Standard Classification of Occupations, 2013, Version 1.2" displayName="General Practitioner"/>
    <ext:jobClassCode code="FT" codeSystem="2.16.840.1.113883.5.1059" codeSystemName="HL7:EmployeeJobClass" displayName="full-time"/>
    <ext:employerOrganization>
      <name>ACME Hospital One</name>
      <asOrganizationPartOf>
        <wholeOrganization>
        <!-- Organisation Name -->
            <name use="ORGB">ACME Hospital Group</name>
            <!-- Entity Ide\ExtEmployerOrganizationntifier -->
            <ext:asEntityIdentifier classCode="IDENT">
                <ext:id assigningAuthorityName="HPI-O" root="1.2.36.1.2001.1003.0" extension="8003621566684455" />
                <ext:assigningGeographicArea classCode="PLC">
                    <ext:name>National Identifier</ext:name>
                </ext:assigningGeographicArea>
            </ext:asEntityIdentifier>
        <!-- Address -->
            <addr use="WP">
                <streetAddressLine>1 Clinician Street</streetAddressLine>
                <city>Nehtaville</city>
                <state>QLD</state>
                <postalCode>5555</postalCode>
                <additionalLocator>32568931</additionalLocator>
            </addr>
        <!-- Electronic Communication Detail -->
            <telecom use="WP" value="tel:0712341234" />
        </wholeOrganization>
      </asOrganizationPartOf>
    </ext:employerOrganization>
</ext:asEmployment>
CDA;
        $tag      = new AsEmployment(
          new ExtCode(new OriginalText('GP')),
          Code::Occupation(253111),
          new JobClassCode(JobClassCode::CODE_FULL_TIME),
          new ExtEmployerOrganization(
            new EntityName('ACME Hospital One'),
            new AsOrganizationPartOf(
              new WholeOrganisation(
                (new EntityName('ACME Hospital Group'))->setUseAttribute('ORGB'),
                new AsEntityIdentifier(
                  new ExtId('HPI-O', '1.2.36.1.2001.1003.0', '8003621566684455'),
                  new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
                ),
                (new Addr(
                  '1 clinician street',
                  'Nehtaville',
                  'QLD',
                  '5555',
                  '32568931'))->setUseAttribute('WP'),
                new Telecom('WP', 'tel:0712341234')
              )
            )
          )
        );
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}