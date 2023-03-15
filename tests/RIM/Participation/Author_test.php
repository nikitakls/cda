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

namespace PHPHealth\tests\classes\CDA\Tests\RIM\Participation;

use PHPHealth\CDA\DataType\Code\AddressCodeType;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\DataType\Name\PersonName;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\DataType\TextAndMultimedia\SimpleString;
use PHPHealth\CDA\Elements\Address\Addr;
use PHPHealth\CDA\Elements\Address\Country;
use PHPHealth\CDA\Elements\Address\Telecom;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Elements\OriginalText;
use PHPHealth\CDA\RIM\Entity\AssignedPerson;
use PHPHealth\CDA\RIM\Entity\WholeOrganisation;
use PHPHealth\CDA\RIM\Extensions\AsEmployment;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\RIM\Extensions\AsQualifications;
use PHPHealth\CDA\RIM\Extensions\AssigningGeographicArea;
use PHPHealth\CDA\RIM\Extensions\ExtCode;
use PHPHealth\CDA\RIM\Extensions\ExtEmployerOrganization;
use PHPHealth\CDA\RIM\Extensions\ExtEntityName;
use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\CDA\RIM\Extensions\JobClassCode;
use PHPHealth\CDA\RIM\Participation\Author;
use PHPHealth\CDA\RIM\Role\AsOrganizationPartOf;
use PHPHealth\CDA\RIM\Role\AssignedAuthor;
use PHPHealth\tests\MyTestCase;

/**
 * @author     julien
 * @group      CDA
 * @group      CDA_RIM
 * @group      CDA_RIM_Author
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_Author
 *
 */
class Author_test extends MyTestCase
{
    public function test_Author()
    {
        $expected = <<<'CDA'
<author typeCode="AUT">
    <time value="2000040714"/>
    <assignedAuthor classCode="ASSIGNED">
        <id extension="KP00017" root="2.16.840.1.113883.19.5"/>
        <assignedPerson classCode="PSN">
            <name>
                <given>Robert</given>
                <family>Dolin</family>
                <suffix>MD</suffix>
            </name>
        </assignedPerson>
    </assignedAuthor>
</author>
CDA;

        $names = new Set(PersonName::class);
        $names->add((new PersonName())
          ->addPart(PersonName::FIRST_NAME, 'Robert')
          ->addPart(PersonName::LAST_NAME, 'Dolin')
          ->addPart(PersonName::SUFFIX, 'MD')
        );

        $assigned_author = new AssignedAuthor(Id::fromString('2.16.840.1.113883.19.5', 'KP00017'));
        $assigned_author->setAssignedPerson(new AssignedPerson($names));

        $tag               = new Author(
          (new TimeStamp(\DateTime::createFromFormat('Y-m-d-H:i', '2000-04-07-14:00')))->setPrecision(TimeStamp::PRECISION_HOURS),
          $assigned_author
        );
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * see page 79 of EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_australian_extension()
    {
        $expected = <<<CDA
<author>
<!-- Must hold same value as DateTime attested (ClinicalDocument.legalAuthenticator.time) -->
    <time value="20091020123500+1000"/>
  <assignedAuthor>
    <!-- ID is used for system purposes such as matching -->
    <id root="7FCB0EC4-0CD0-11E0-9DFC-8F50DFD72085"/>
    <!-- Role -->
    <code code="253111" codeSystem="2.16.840.1.113883.13.62" codeSystemName="1220.0 - ANZSCO -- Australian and New Zealand Standard Classification of Occupations, 2013, Version 1.2" displayName="General Practitioner"/>
    <!-- Address -->
    <addr use="WP">
      <streetAddressLine>1 Clinician Street</streetAddressLine>
      <city>Nehtaville</city>
      <state>QLD</state>
      <postalCode>5555</postalCode>
      <additionalLocator>32568931</additionalLocator>
      <country>Australia</country>
    </addr>
    <!-- Electronic Communication Detail -->
    <telecom use="WP" value="tel:0712341234"/> <!-- Participant -->
    <!-- Participant -->
    <assignedPerson>
        <!-- Person Name -->
        <name>
            <prefix>Dr.</prefix>
            <given>Good</given>
            <family>Doctor</family>
        </name>
        <!-- Entity Identifier -->
        <ext:asEntityIdentifier classCode="IDENT">
            <ext:id assigningAuthorityName="HPI-I" root="1.2.36.1.2001.1003.0" extension="8003619900015717" />
            <ext:assigningGeographicArea classCode="PLC">
                <ext:name>National Identifier</ext:name>
            </ext:assigningGeographicArea>
        </ext:asEntityIdentifier>
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
                    <!-- Entity Identifier -->
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
        <ext:asQualifications classCode="QUAL">
            <ext:code>
                <originalText>M.B.B.S</originalText>
            </ext:code>
        </ext:asQualifications>
      </assignedPerson>
  </assignedAuthor>
</author>
CDA;

        $names           = (new Set(PersonName::class))
          ->add((new PersonName())
            ->addPart(PersonName::HONORIFIC, 'Dr.')
            ->addPart(PersonName::FIRST_NAME, 'Good')
            ->addPart(PersonName::LAST_NAME, 'Doctor')
          );
        $assigned_author = new AssignedAuthor(
          Id::fromString('7FCB0EC4-0CD0-11E0-9DFC-8F50DFD72085'),
          Code::Occupation(253111),
          (new Addr(
            '1 Clinician Street',
            'Nehtaville',
            'QLD',
            '5555',
            '32568931'
          ))->setCountry(new Country('Australia'))
            ->setUseAttribute(new AddressCodeType('WP')),
          array(new Telecom('WP', 'tel:0712341234'),),
          (new AssignedPerson(
            $names,
            new AsEntityIdentifier(
              new ExtId('HPI-I', '1.2.36.1.2001.1003.0', '8003619900015717'),
              new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
            ),
            new AsEmployment(
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
            ),
            new AsQualifications(new ExtCode(new OriginalText('M.B.B.S')))
          ))->setClassCode(''));
        $assigned_author->setClassCode('');

        $tag = new Author(
          (new TimeStamp(new \DateTime('200910201235+1000')))->setOffset(true),
          $assigned_author
        );
        $tag->setTypeCode('');
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}
