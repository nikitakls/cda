<?php

/**
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
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
use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Name\PersonName;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\DataType\TextAndMultimedia\SimpleString;
use PHPHealth\CDA\DataType\ValueType;
use PHPHealth\CDA\Elements\Address\AdditionalLocator;
use PHPHealth\CDA\Elements\Address\Addr;
use PHPHealth\CDA\Elements\Address\BirthPlace;
use PHPHealth\CDA\Elements\Address\City;
use PHPHealth\CDA\Elements\Address\Country;
use PHPHealth\CDA\Elements\Address\Place;
use PHPHealth\CDA\Elements\Address\PostalCode;
use PHPHealth\CDA\Elements\Address\State;
use PHPHealth\CDA\Elements\Address\StreetAddressLine;
use PHPHealth\CDA\Elements\Address\Telecom;
use PHPHealth\CDA\Elements\AdministrativeGenderCode;
use PHPHealth\CDA\Elements\EthnicGroupCode;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\RIM\Entity\Patient;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\RIM\Extensions\AssigningGeographicArea;
use PHPHealth\CDA\RIM\Extensions\DeceasedInd;
use PHPHealth\CDA\RIM\Extensions\DeceasedTime;
use PHPHealth\CDA\RIM\Extensions\ExtEntityName;
use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\CDA\RIM\Extensions\MultipleBirthInd;
use PHPHealth\CDA\RIM\Extensions\MultipleBirthOrderNumber;
use PHPHealth\CDA\RIM\Participation\RecordTarget;
use PHPHealth\CDA\RIM\Role\PatientRole;
use PHPHealth\tests\MyTestCase;

/**
 * @author     Julien Fastré <julien.fastre@champs-libres.coop>
 * @group      CDA
 * @group      CDA_RecordTarget
 *
 * phpunit-debug  --no-coverage --group CDA_RecordTarget
 *
 */
class RecordTarget_test extends MyTestCase
{

    public function test_RecordTarget()
    {
        $rt = new RecordTarget($this->getPatientRole());


        $expected = <<<'CDA'
<recordTarget typeCode="RCT">
    <patientRole classCode="PAT">
        <id extension="12345" root="2.16.840.1.113883.19.5"/>
        <patient classCode="PSN">
            <name>
                <given>Henry</given>
                <family>Levin</family>
                <suffix>the 7th</suffix>
            </name>
            <administrativeGenderCode code="M" codeSystem="2.16.840.1.113883.5.1"/>
            <birthTime value="19320924"/>
        </patient>
    </patientRole>  
</recordTarget>
CDA;

        $expectedDoc = new \DOMDocument('1.0');
        $expectedDoc->loadXML($expected);
        $expectedRecordTarget = $expectedDoc
          ->getElementsByTagName('recordTarget')
          ->item(0);

        $this->assertEqualXMLStructure($expectedRecordTarget,
          $rt->toDOMElement(new \DOMDocument()), true);
    }

    protected function getPatientRole(): PatientRole
    {
        return new PatientRole($this->getId(), $this->getPatient());
    }

    protected function getId(): Id
    {
        return Id::fromString('2.16.840.1.113883.19.5', '12345');
    }

    protected function getPatient(): Patient
    {
        $names = new Set(PersonName::class);
        $names->add((new PersonName())
          ->addPart(PersonName::FIRST_NAME, 'Henry')
          ->addPart(PersonName::LAST_NAME, 'Levin')
          ->addPart('suffix', 'the 7th'));
        $patient = new Patient(
          $names,
          new TimeStamp(\DateTime::createFromFormat('Y-m-d', '1932-09-24')),
          new CodedValue('M', '', '2.16.840.1.113883.5.1', '')
        );

        return $patient;
    }

    /**
     * see EventSummary_CDAImplementationGuide_v1.3.pdf page 86 for details.
     */
    public function test_australian_extensions()
    {
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<recordTarget typeCode="RCT">
  <patientRole classCode="PAT">
    <id root="7AA0BAAC-0CD0-11E0-9516-4350DFD72085"/>
    <addr use="H">
      <streetAddressLine>1 Patient Street</streetAddressLine>
      <city>Nehtaville</city>
      <state>QLD</state>
      <postalCode>5555</postalCode>
      <additionalLocator>32568931</additionalLocator>
    </addr>
    <telecom use="H" value="tel:0499999999"/>
    <patient classCode="PSN">
      <name use="L">
        <prefix>Ms</prefix>
        <given>Sally</given>
        <family>Grant</family>
      </name>
      <administrativeGenderCode code="F" displayName="Female" codeSystem="2.16.840.1.113883.13.68" codeSystemName="AS 5017-2006 Health Care Client Sex"/>
      <birthTime value="20110712000000"/>
      <ethnicGroupCode code="4" displayName="Neither Aboriginal nor Torres Strait Islander origin" codeSystem="2.16.840.1.113883.3.879.291036" codeSystemName="METeOR Indigenous Status"/>
      <ext:multipleBirthInd value="true"/>
      <ext:multipleBirthOrderNumber value="2"/>
      <ext:deceasedInd value="true"/>
      <ext:deceasedTime value="20121112000000"/>
      <birthplace>
        <place>
          <addr>
            <state>QLD</state>
            <country>Australia</country>
          </addr>
        </place>
      </birthplace>
      <ext:asEntityIdentifier classCode="IDENT">
        <ext:id assigningAuthorityName="IHI" root="1.2.36.1.2001.1003.0" extension="8003608833357361"/>
        <ext:assigningGeographicArea classCode="PLC">
          <ext:name>National Identifier</ext:name>
        </ext:assigningGeographicArea>
      </ext:asEntityIdentifier>
    </patient>
  </patientRole>
</recordTarget>

XML;

        $addr = new Addr(
          new StreetAddressLine('1 Patient Street'),
          new City('Nehtaville'),
          new State('QLD'),
          new PostalCode('5555'),
          new AdditionalLocator('32568931'));
        $addr->setUseAttribute(AddressCodeType::HOME);

        $person_name = (new PersonName())
          ->addPart(PersonName::HONORIFIC, 'Ms')
          ->addPart(PersonName::FIRST_NAME, 'Sally')
          ->addPart(PersonName::LAST_NAME, 'Grant')
          ->setUseAttribute('L');

        $names = new Set(PersonName::class);
        $names->add($person_name);
        $birth_place_address = new Addr(null, null, 'QLD');
        $birth_place_address->setCountry(new Country('Australia'));
        $patient      = (new Patient($names))
          ->setAdministrativeGenderCode(new AdministrativeGenderCode(new CodedValue(
            'F',
            'Female',
            '2.16.840.1.113883.13.68', 'AS 5017-2006 Health Care Client Sex')))
          ->setBirthTime(new TimeStamp(new \DateTime('2011-07-12 0:00:00', new \DateTimeZone('UTC'))))
          ->setEthnicGroupCode(new EthnicGroupCode(EthnicGroupCode::status_neither_aboriginal_torres_strait))
          ->setMultipleBirthInd(new MultipleBirthInd('true'))
          ->setMultipleBirthOrderNumber(new MultipleBirthOrderNumber('2'))
          ->setDeceasedInd(new DeceasedInd('true'))
          ->setDeceasedTime(new DeceasedTime(new TimeStamp(new \DateTime('2012-11-12 0:00:00', new \DateTimeZone('UTC')))))
          ->setBirthPlace(new BirthPlace(new Place($birth_place_address)))
          ->setAsEntityIdentifier(new AsEntityIdentifier(
            new ExtId('IHI', '1.2.36.1.2001.1003.0', '8003608833357361'),
            new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
          ));
        $patient_role = new PatientRole(Id::fromString('7AA0BAAC-0CD0-11E0-9516-4350DFD72085'), $patient);
        $patient_role->addAddr($addr)
          ->addTelecom(new Telecom(new AddressCodeType(AddressCodeType::HOME), new ValueType('tel:0499999999')));
        $recordTarget = new RecordTarget($patient_role);

        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $doc               = $recordTarget->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}
