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

namespace PHPHealth\tests\classes\CDA;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_NCTIS
 *
 * phpunit-debug  --no-coverage --group CDA_NCTIS
 *
 */

use PHPHealth\CDA\Component\RootBodyComponent;
use PHPHealth\CDA\Component\SingleComponent;
use PHPHealth\CDA\Component\SingleComponent\Section;
use PHPHealth\CDA\Component\XMLBodyComponent;
use PHPHealth\CDA\DataType\Code\AddressCodeType;
use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Interval\PeriodicIntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\DataType\Name\EntityName;
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
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Desc;
use PHPHealth\CDA\Elements\EffectiveTime;
use PHPHealth\CDA\Elements\Entry;
use PHPHealth\CDA\Elements\EthnicGroupCode;
use PHPHealth\CDA\Elements\High;
use PHPHealth\CDA\Elements\Html\LinkHtml;
use PHPHealth\CDA\Elements\Html\Paragraph;
use PHPHealth\CDA\Elements\Html\ReferenceElement;
use PHPHealth\CDA\Elements\Html\Table;
use PHPHealth\CDA\Elements\Html\TableCell;
use PHPHealth\CDA\Elements\Html\Text;
use PHPHealth\CDA\Elements\Html\Title;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Elements\InterpretationCode;
use PHPHealth\CDA\Elements\Low;
use PHPHealth\CDA\Elements\MethodCode;
use PHPHealth\CDA\Elements\Name;
use PHPHealth\CDA\Elements\OriginalText;
use PHPHealth\CDA\RIM\Participation\Participant;
use PHPHealth\CDA\Elements\Procedure;
use PHPHealth\CDA\Elements\Qualifier;
use PHPHealth\CDA\Elements\Quantity;
use PHPHealth\CDA\Elements\StatusCodeElement;
use PHPHealth\CDA\Elements\TargetSiteCode;
use PHPHealth\CDA\Elements\Value;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MediaTypeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\Interfaces\UseAttributeInterface;
use PHPHealth\CDA\Interfaces\XSITypeInterface;
use PHPHealth\CDA\RIM\Act\Act;
use PHPHealth\CDA\RIM\Act\EntryRelationship;
use PHPHealth\CDA\RIM\Act\Observation;
use PHPHealth\CDA\RIM\Act\ObservationMedia;
use PHPHealth\CDA\RIM\Act\ObservationRange;
use PHPHealth\CDA\RIM\Act\Organizer;
use PHPHealth\CDA\RIM\Act\OrganizerComponent;
use PHPHealth\CDA\RIM\Act\ReferenceRange;
use PHPHealth\CDA\RIM\Act\SubstanceAdministration;
use PHPHealth\CDA\RIM\Entity\AssignedEntity;
use PHPHealth\CDA\RIM\Entity\AssignedPerson;
use PHPHealth\CDA\RIM\Entity\ManufacturedMaterial;
use PHPHealth\CDA\RIM\Entity\Patient;
use PHPHealth\CDA\RIM\Entity\PlayingEntity;
use PHPHealth\CDA\RIM\Entity\RepresentedOrganization;
use PHPHealth\CDA\RIM\Entity\SpecimenPlayingEntity;
use PHPHealth\CDA\RIM\Entity\WholeOrganisation;
use PHPHealth\CDA\RIM\Extensions\AsEmployment;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\RIM\Extensions\AsQualifications;
use PHPHealth\CDA\RIM\Extensions\AssigningGeographicArea;
use PHPHealth\CDA\RIM\Extensions\DeceasedInd;
use PHPHealth\CDA\RIM\Extensions\DeceasedTime;
use PHPHealth\CDA\RIM\Extensions\ExtAsSpecimenInContainer;
use PHPHealth\CDA\RIM\Extensions\ExtCode;
use PHPHealth\CDA\RIM\Extensions\ExtContainer;
use PHPHealth\CDA\RIM\Extensions\ExtCoverage2;
use PHPHealth\CDA\RIM\Extensions\ExtEffectiveTime;
use PHPHealth\CDA\RIM\Extensions\ExtEmployerOrganization;
use PHPHealth\CDA\RIM\Extensions\ExtEntitlement;
use PHPHealth\CDA\RIM\Extensions\ExtEntityName;
use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\CDA\RIM\Extensions\ExtJobCode;
use PHPHealth\CDA\RIM\Extensions\JobClassCode;
use PHPHealth\CDA\RIM\Extensions\MultipleBirthInd;
use PHPHealth\CDA\RIM\Extensions\MultipleBirthOrderNumber;
use PHPHealth\CDA\RIM\Participation\Consumable;
use PHPHealth\CDA\RIM\Extensions\ExtParticipant;
use PHPHealth\CDA\RIM\Participation\Performer;
use PHPHealth\CDA\RIM\Participation\RecordTarget;
use PHPHealth\CDA\RIM\Participation\Specimen;
use PHPHealth\CDA\RIM\Role\AsOrganizationPartOf;
use PHPHealth\CDA\RIM\Extensions\ExtParticipantRole;
use PHPHealth\CDA\RIM\Role\ManufacturedProduct;
use PHPHealth\CDA\RIM\Role\PatientRole;
use PHPHealth\CDA\RIM\Role\SpecimenRole;
use PHPHealth\CDA\RIM\Role\ParticipantRole;
use PHPHealth\tests\MyTestCase;

class NCTIS_test extends MyTestCase
{

    /**
     *
     */
    public function test_header()
    {
        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<recordTarget typeCode="RCT">
	<patientRole classCode="PAT">
		<!-- This system generated id is used for matching patient Entitlement -->
		<id root="7AA0BAAC-0CD0-11E0-9516-4350DFD72085"/>
		<!-- Address -->
		<addr use="H">
			<streetAddressLine>1 Patient Street</streetAddressLine>
			<city>Nehtaville</city>
			<state>QLD</state>
			<postalCode>5555</postalCode>
			<additionalLocator>32568931</additionalLocator>
			<country>Australia</country>
		</addr>
		<!-- Electronic Communication Detail -->
		<telecom use="H" value="tel:0499999999"/>
		<!-- Participant -->
		<patient>
			<!-- Person Name -->
			<name use="L">
				<prefix>Ms</prefix>
				<given>Sally</given>
				<family>Grant</family>
			</name>
			<!-- Sex -->
			<administrativeGenderCode code="F" codeSystem="2.16.840.1.113883.13.68" codeSystemName="AS 5017-2006 Health Care Client Identifier Sex" displayName="Female" />
			<!-- Date of Birth -->
			<birthTime value="20110712"/>
			<!-- Indigenous Status -->
			<ethnicGroupCode code="4" codeSystem="2.16.840.1.113883.3.879.291036" codeSystemName="METeOR Indigenous Status" displayName="Neither Aboriginal nor Torres Strait Islander origin" />
			<!-- Multiple Birth Indicator -->
			<ext:multipleBirthInd value="true"/>
			<ext:multipleBirthOrderNumber value="2"/>
			<!-- Date of Death -->
			<ext:deceasedInd value="true"/>
			<ext:deceasedTime value="20121112"/>
			<!-- Country of Birth/State of Birth -->
			<birthplace>
				<place>
					<addr>
						<state>QLD</state>
						<country>Australia</country>
					</addr>
				</place>
			</birthplace>
			<!-- Entity Identifier -->
			<ext:asEntityIdentifier classCode="IDENT">
				<ext:id assigningAuthorityName="IHI"  root="1.2.36.1.2001.1003.0" extension="8003608833357361"/>
				<ext:assigningGeographicArea classCode="PLC">
					<ext:name>National Identifier</ext:name>
				</ext:assigningGeographicArea>
			</ext:asEntityIdentifier>
		</patient>
	</patientRole>
</recordTarget>
CDA;

        $addr = new Addr(
          new StreetAddressLine('1 Patient Street'),
          new City('Nehtaville'),
          new State('QLD'),
          new PostalCode('5555'),
          new AdditionalLocator('32568931'));
        $addr->setCountry(new Country('Australia'));
        $addr->setUseAttribute(AddressCodeType::HOME);
        $id          = Id::fromString('7AA0BAAC-0CD0-11E0-9516-4350DFD72085');
        $person_name = (new PersonName())
          ->addPart(PersonName::HONORIFIC, 'Ms')
          ->addPart(PersonName::FIRST_NAME, 'Sally')
          ->addPart(PersonName::LAST_NAME, 'Grant')
          ->setUseAttribute('L');
        $names       = new Set(PersonName::class);
        $names->add($person_name);
        $birth_place_address = new Addr(null, null, 'QLD');
        $birth_place_address->setCountry(new Country('Australia'));
        $patient = new Patient($names);
        $patient
          ->setDeceasedInd(new DeceasedInd('true'))
          ->setDeceasedTime(new DeceasedTime(
            (new TimeStamp(new \DateTime('2012-11-12 0:00:00', new \DateTimeZone('UTC'))))
              ->setPrecision(TimeStamp::PRECISION_DAY)))
          ->setAdministrativeGenderCode(new AdministrativeGenderCode('F'))
          ->setBirthTime(
            (new TimeStamp(new \DateTime('2011-07-12 0:00:00', new \DateTimeZone('UTC'))))
              ->setPrecision(TimeStamp::PRECISION_DAY))
          ->setEthnicGroupCode(new EthnicGroupCode(EthnicGroupCode::status_neither_aboriginal_torres_strait))
          ->setMultipleBirthInd(new MultipleBirthInd('true'))
          ->setMultipleBirthOrderNumber(new MultipleBirthOrderNumber('2'))
          ->setBirthPlace(new BirthPlace(new Place($birth_place_address)))
          ->setAsEntityIdentifier(new AsEntityIdentifier(
            new ExtId('IHI', '1.2.36.1.2001.1003.0', '8003608833357361'),
            new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
          ))
          ->setClassCode('');
        $patient_role = new PatientRole($id, $patient);
        $patient_role->addAddr($addr)
          ->addTelecom(new Telecom(AddressCodeType::HOME, 'tel:0499999999'));

        $tag = new RecordTarget($patient_role);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 6.3. SUBJECT OF CARE XML Fragment
     * see page 87 of EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_Administrative_Observations_section()
    {

        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<component>
	<!-- [admin_obs] -->
	<section>
		<code code="102.16080" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Administrative Observations"/>
		<title>Administrative Observations</title>
		<!-- Narrative text -->
		<text>
			<table>
				<tbody>
					<tr>
						<th>Date of Birth is Calculated From Age</th>
						<td>True</td>
					</tr>
					<tr>
						<th>Date of Birth Accuracy Indicator</th>
						<td>AAA</td>
					</tr>
					<tr>
						<th>Age</th>
						<td>1</td>
					</tr>
					<tr>
						<th>Age Accuracy Indicator</th>
						<td>True</td>
					</tr>
					<tr>
						<th>Birth Plurality</th>
						<td>3</td>
					</tr>
					<tr>
						<th>Source of Death Notification</th>
						<td>Relative</td>
					</tr>
					<tr>
						<th>Mother's Maiden Name</th>
						<td>Smith</td>
					</tr>
					<tr>
						<th>Australian Medicare Card Number</th>
						<td>2296818481</td>
					</tr>
				</tbody>
			</table>
		</text>
		<!-- Begin SUBJECT OF CARE – Body -->
		<!-- Begin Date of Birth is Calculated From Age -->
		<entry>
			<!-- [calc_age] -->
			<observation classCode="OBS" moodCode="EVN">
				<id root="DA10C13E-EFD0-11DF-91AF-B5CCDFD72085"/>
				<code code="103.16233"
codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Date of Birth is Calculated From Age"/>
				<value value="true" xsi:type="BL"/>
			</observation>
		</entry>
		<!-- [calc_age] -->
		<!-- End Date of Birth is Calculated From Age -->
		<!-- Begin Date of Birth Accuracy Indicator-->
		<entry>
			<!-- [dob_acc] -->
			<observation classCode="OBS" moodCode="EVN">
				<id root="D253216C-EFD0-11DF-A686-ADCCDFD72085"/>
				<code code="102.16234"
codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Date of Birth Accuracy Indicator"/>
				<value code="AAA" xsi:type="CS"/>
			</observation>
		</entry>
		<!-- [dob_acc] -->
		<!-- End Date of Birth Accuracy Indicator-->
		<!-- Begin Age -->
		<entry>
			<!-- [age] -->
			<observation classCode="OBS" moodCode="EVN">
				<id root="CCF0D55C-EFD0-11DF-BEA2-A6CCDFD72085"/>
				<code code="103.20109"
codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Age"/>
				<value xsi:type="PQ" value="1" unit="a"/>
			</observation>
		</entry>
		<!-- [age] -->
		<!-- End Age -->
		<!-- Age Accuracy Indicator -->
		<entry>
			<!-- [age_acc] -->
			<observation classCode="OBS" moodCode="EVN">
				<id root="C629C9F4-EFD0-11DF-AA9E-96CCDFD72085"/>
				<code code="103.16279"
codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Age Accuracy Indicator"/>
				<value value="true" xsi:type="BL"/>
			</observation>
		</entry>
		<!-- [age_acc] -->
		<!-- Birth Plurality -->
		<entry>
			<!-- [birth_plr] -->
			<observation classCode="OBS" moodCode="EVN">
				<id root="C1EE2646-EFD0-11DF-8D9C-95CCDFD72085"/>
				<code code="103.16249"
codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Birth Plurality"/>
				<value value="3" xsi:type="INT"/>
			</observation>
		</entry>
		<!-- [birth_plr] -->
		<!-- Begin Source of Death Notification-->
		<entry>
			<!-- [src_notif] -->
			<observation classCode="OBS" moodCode="EVN">
				<!-- ID is used for system purposes such as matching -->
				<id root="C749A146-2789-11E1-90AC-74064824019B" />
				<code code="103.10243" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components"
displayName="Source of Death Notification" />
				<value code="R" codeSystem="2.16.840.1.113883.13.64"
codeSystemName="AS 5017-2006 Health Care Client Source of Death Notification" displayName="Relative"
xsi:type="CD" />
			</observation>
		</entry>
		<!-- [src_notif] -->
		<!-- End Source of Death Notification-->
		<!-- Begin Mother's Original Family Name -->
		<entry>
			<!-- [mothers_name] -->
			<observation classCode="OBS" moodCode="EVN">
				<!-- ID is used for system purposes such as matching -->
				<id root="E432CD48-278C-11E1-BDA1-0F0A4824019B" />
				<code code="103.10245" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components"
displayName="Mother's Original Family Name" />
				<value xsi:type="PN">
					<family>Smith</family>
				</value>
			</observation>
		</entry>
		<!-- [mothers_name] -->
		<!-- End Mother's Original Family Name -->
		<!-- Begin Date of Death Accuracy Indicator-->
		<entry>
			<!-- [dod_acc] -->
			<observation classCode="OBS" moodCode="EVN">
				<!-- ID is used for system purposes such as matching -->
				<id root="D253216C-EFD0-11DF-A686-ADCCDFD72085" />
				<code code="102.16252" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components"
displayName="Date of Death Accuracy Indicator" />
				<value code="AAA" xsi:type="CS" />
			</observation>
		</entry>
		<!-- [dod_acc] -->
		<!-- End Date of Death Accuracy Indicator-->
		<!-- Begin Entitlement -->
		<ext:coverage2 typeCode="COVBY">
			<ext:entitlement classCode="COV" moodCode="EVN">
				<ext:id assigningAuthorityName="Medicare Card Number" root="1.2.36.1.5001.1.0.7.1" extension="2296818481" />
				<ext:code code="1" codeSystem="1.2.36.1.2001.1001.101.104.16047" codeSystemName="NCTIS Entitlement Type Values" displayName="Medicare Benefits"/>
				<ext:effectiveTime>
					<high value="20110101"/>
				</ext:effectiveTime>
				<ext:participant typeCode="BEN">
					<ext:participantRole classCode="PAT">
						<ext:id root="7AA0BAAC-0CD0-11E0-9516-4350DFD72085" />
					</ext:participantRole>
				</ext:participant>
			</ext:entitlement>
		</ext:coverage2>
		<!-- End Entitlement -->
		<!-- End SUBJECT OF CARE – Body -->
	</section>
</component>
CDA;

        $section = (new Section())
          ->setMoodCode('')
          ->setClassCode('')
          ->setCode(
            new Code(
              new CodedValue('102.16080', 'Administrative Observations', '1.2.36.1.2001.1001.101', 'NCTIS Data Components')))
          ->setTitle(new Title('Administrative Observations'))
          ->setText(new Text(
            (new Table())
              ->getTbody()
              ->createRow()
              ->createCell('Date of Birth is Calculated From Age', TableCell::TH)->getRow()
              ->createCell('True', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Date of Birth Accuracy Indicator', TableCell::TH)->getRow()
              ->createCell('AAA', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Age', TableCell::TH)->getRow()
              ->createCell('1', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Age Accuracy Indicator', TableCell::TH)->getRow()
              ->createCell('True', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Birth Plurality', TableCell::TH)->getRow()
              ->createCell('3', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Source of Death Notification', TableCell::TH)->getRow()
              ->createCell('Relative', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Mother\'s Maiden Name', TableCell::TH)->getRow()
              ->createCell('Smith', TableCell::TD)->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Australian Medicare Card Number', TableCell::TH)->getRow()
              ->createCell('2296818481', TableCell::TD)->getRow()
              ->getSection()
              ->getTable()
          ))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('DA10C13E-EFD0-11DF-91AF-B5CCDFD72085'))
                ->setCode(Code::NCTIS('103.16233', 'Date of Birth is Calculated From Age'))
                ->addValue(new Value('true', XSITypeInterface::BOOLEAN))))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('D253216C-EFD0-11DF-A686-ADCCDFD72085'))
                ->setCode(Code::NCTIS('102.16234', 'Date of Birth Accuracy Indicator'))
                ->addValue((new Value('', XSITypeInterface::CODED_SIMPLE_VALUE))->setCode('AAA'))))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('CCF0D55C-EFD0-11DF-BEA2-A6CCDFD72085'))
                ->setCode(Code::NCTIS('103.20109', 'Age'))
                ->addValue((new Value('1', XSITypeInterface::PHYSICAL_QUANTITY))->setUnits('a'))))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('C629C9F4-EFD0-11DF-AA9E-96CCDFD72085'))
                ->setCode(Code::NCTIS('103.16279', 'Age Accuracy Indicator'))
                ->addValue(new Value('true', XSITypeInterface::BOOLEAN))))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('C1EE2646-EFD0-11DF-8D9C-95CCDFD72085'))
                ->setCode(Code::NCTIS('103.16249', 'Birth Plurality'))
                ->addValue(new Value('3', XSITypeInterface::INTEGER))))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('C749A146-2789-11E1-90AC-74064824019B'))
                ->setCode(Code::NCTIS('103.10243', 'Source of Death Notification'))
                ->addValue((new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                  ->setCode('R')
                  ->setCodeSystem('2.16.840.1.113883.13.64')
                  ->setCodeSystemName('AS 5017-2006 Health Care Client Source of Death Notification')
                  ->setDisplayName('Relative'))))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('E432CD48-278C-11E1-BDA1-0F0A4824019B'))
                ->setCode(Code::NCTIS('103.10245', 'Mother\'s Original Family Name'))
                ->addValue((new Value('', XSITypeInterface::PERSON_NAME))
                  ->addTagValue('family', 'Smith')
                )))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('D253216C-EFD0-11DF-A686-ADCCDFD72085'))
                ->setCode(Code::NCTIS('102.16252', 'Date of Death Accuracy Indicator'))
                ->addValue((new Value('', XSITypeInterface::CODED_SIMPLE_VALUE))->setCode('AAA'))))
          ->setExtCoverage2(
            new ExtCoverage2(
              new ExtEntitlement(
                new ExtId('Medicare Card Number', '1.2.36.1.5001.1.0.7.1', '2296818481'),
                new ExtCode(null, new CodedValue(
                  '1',
                  'Medicare Benefits',
                  '1.2.36.1.2001.1001.101.104.16047',
                  'NCTIS Entitlement Type Values')),
                (new ExtEffectiveTime(new IntervalOfTime(
                  null,
                  (new TimeStamp(
                    new \DateTime('2011-01-01', new \DateTimeZone('+1100'))
                  ))->setPrecision(TimeStamp::PRECISION_DAY)
                )))->setXSIType(''),
                (new ExtParticipant(
                  (new ExtParticipantRole(
                    new ExtId('', '7AA0BAAC-0CD0-11E0-9516-4350DFD72085')))->setClassCode(ClassCodeInterface::PATIENT)
                ))->setTypeCode(TypeCodeInterface::BENEFIT))
            )
          );

        $tag = (new SingleComponent($section))->setTypeCode('');
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.2. Event Details (EVENT OVERVIEW) XML Fragment
     * see page 102 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_event_details()
    {
        $expected = <<<CDA
<component>
  <structuredBody classCode="DOCBODY">
    <!-- Begin Event Details (EVENT OVERVIEW) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Event Overview Instance Identifier -->
        <id root="61583ded-ceab-4a6b-ae75-10c21b50d8f5" />
        <!-- Section Type -->
        <code code="101.16672" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Event Overview" />
        <title>Event Details</title>
        <!-- Narrative text -->
        <text>Sally presented to me today after a fall in a local shopping centre. Suffered a deep laceration to her right calf which required cleaning and 4 sutures.</text>
        <!-- Begin Event Details (CLINICAL SYNOPSIS) -->
        <entry>
            <act classCode="ACT" moodCode="EVN" />
        </entry>
        <!-- End Event Details (CLINICAL SYNOPSIS) -->
      </section>
    </component>
  <!-- End Event Details (EVENT OVERVIEW) -->
  </structuredBody>
</component>
CDA;
        $section  = new Section(
          new Id(new InstanceIdentifier('61583ded-ceab-4a6b-ae75-10c21b50d8f5')),
          new Code(new CodedValue('101.16672', 'Event Overview', '1.2.36.1.2001.1001.101', 'NCTIS Data Components')),
          new Title('Event Details'),
          new Text('Sally presented to me today after a fall in a local shopping centre. Suffered a deep laceration to her right calf which required cleaning and 4 sutures.'),
          (new Entry(new Act()))->setTypeCode('')
        );
        $section->setMoodCode(MoodCodeInterface::EVENT);
        $tag = new RootBodyComponent(
          new XMLBodyComponent(
            new SingleComponent($section)
          )
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.3. Event Details (CLINICAL SYNOPSIS) XML Fragment
     * see page 106 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_event_overview()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin Event Details (EVENT OVERVIEW) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Begin Event Details (CLINICAL SYNOPSIS) -->
        <entry>
          <act classCode="ACT" moodCode="EVN">
            <!-- Clinical Synopsis Instance Identifier -->
            <id root="4a8b424c-be62-4220-ad01-f1a927c401ad" />
            <!-- Detailed Clinical Model Identifier -->
            <code code="102.15513" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Clinical Synopsis" />
            <!-- Clinical Synopsis Description -->
            <text>Sally presented to me today after a fall in a local shopping centre. Suffered a deep laceration to her right calf which required cleaning and 4 sutures.</text>
          </act>
        </entry>
        <!-- End Event Details (CLINICAL SYNOPSIS) -->
      </section>
    </component>
    <!-- End Event Details (EVENT OVERVIEW) -->
  </structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->addEntry(
            (new Entry(
              (new Act())
                ->addId(Id::fromString('4a8b424c-be62-4220-ad01-f1a927c401ad'))
                ->setCode(new Code(new CodedValue('102.15513', 'Clinical Synopsis', '1.2.36.1.2001.1001.101', 'NCTIS Data Components')))
                ->setText(new Text('Sally presented to me today after a fall in a local shopping centre. Suffered a deep laceration to her right calf which required cleaning and 4 sutures.'))
            ))->setTypeCode(''));
        $section->setMoodCode(MoodCodeInterface::EVENT);
        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.4. Newly Identified Adverse Reactions (ADVERSE REACTIONS) XML Fragment
     * see page 110 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_newly_identified_adverse_reactions()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin ADVERSE REACTIONS -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Adverse Reactions Instance Identifier -->
        <id root="50846572-EFC7-11E0-8337-65094924019B" />
        <!-- Section Type -->
        <code code="101.20113" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Adverse Reactions" />
        <title>Adverse Reactions</title>
        <!-- Narrative text -->
        <text>Narrative.</text>
        <!-- Begin ADVERSE REACTION -->
        <entry>
          <act />
        </entry>
        <!-- End ADVERSE REACTION -->
      </section>
    </component>
    <!-- End ADVERSE REACTIONS -->
  </structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = new Section(
          new Id(new InstanceIdentifier('50846572-EFC7-11E0-8337-65094924019B')),
          new Code(new CodedValue('101.20113', 'Adverse Reactions', '1.2.36.1.2001.1001.101', 'NCTIS Data Components')),
          new Title('Adverse Reactions'),
          new Text('Narrative.'),
          (new Entry((new Act())->setMoodCode('')->setClassCode('')))->setTypeCode(''));
        $section->setMoodCode(MoodCodeInterface::EVENT);
        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.5. ADVERSE REACTION XML Fragment
     * see page 117 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_adverse_reaction_fragment()
    {
        $expected = <<<CDA
<component>
	<structuredBody>
		<!-- Begin ADVERSE REACTIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin ADVERSE REACTION -->
				<entry>
					<act classCode="ACT" moodCode="EVN">
						<!-- Adverse Reaction Instance Identifier -->
						<id root="547FC5C0-7F8A-11E0-AE79-EE2B4924019B" />
						<!-- Detailed Clinical Model Identifier -->
						<code code="102.15517" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Adverse Reaction" />
						<!-- Begin Substance/Agent -->
						<participant typeCode="CAGNT">
							<participantRole>
								<playingEntity>
									<code code="385420005" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Contrast media" />
								</playingEntity>
							</participantRole>
						</participant>
						<!-- End Substance/Agent -->
						<!-- Begin REACTION EVENT -->
						<entryRelationship typeCode="CAUS">
							<observation classCode="OBS" moodCode="EVN">
								<code code="102.16474" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Reaction Event" />
								<entryRelationship inversionInd="true" typeCode="MFST">
									<observation classCode="OBS" moodCode="EVN">
										<id root="547FF5C0-7F8A-11E0-AE79-EE2B4924019B" />
										<!-- Manifestation -->
										<code code="39579001" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Anaphylaxis" />
										<!-- Reaction Type -->
										<value code="419076005" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Allergic reaction" xsi:type="CD" />
									</observation>
								</entryRelationship>
							</observation>
						</entryRelationship>
						<!-- End REACTION EVENT -->
					</act>
				</entry>
				<!-- End ADVERSE REACTION -->
			</section>
		</component>
		<!-- End ADVERSE REACTIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct((new Act())
              ->addId(Id::fromString('547FC5C0-7F8A-11E0-AE79-EE2B4924019B'))
              ->setCode(Code::NCTIS('102.15517', 'Adverse Reaction'))
              ->addParticipant(
                (new Participant(
                  (new ParticipantRole(
                    (new PlayingEntity(
                      Code::SNOMED('385420005', 'Contrast media')
                    ))->setClassCode('')
                  ))->setClassCode('')))
                  ->setContextControlCode(''))
              ->addEntryRelationship((new EntryRelationship(
                (new Observation())
                  ->setMoodCode(MoodCodeInterface::EVENT)
                  ->setCode(Code::NCTIS('102.16474', 'Reaction Event'))
                  ->addEntryRelationship(
                    (new EntryRelationship(
                      (new Observation())
                        ->setMoodCode(MoodCodeInterface::EVENT)
                        ->addId(Id::fromString('547FF5C0-7F8A-11E0-AE79-EE2B4924019B'))
                        ->setCode(Code::SNOMED('39579001', 'Anaphylaxis'))
                        ->addValue(
                          (new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                            ->setCode('419076005')
                            ->setCodeSystem('2.16.840.1.113883.6.96')
                            ->setCodeSystemName('SNOMED CT')
                            ->setDisplayName('Allergic reaction')
                        )
                    )
                    )->setTypeCode(TypeCodeInterface::MANIFESTATION)
                      ->setInversionInd(true))
              ))->setTypeCode(TypeCodeInterface::CAUSE)
              )
            )
          );
        $tag      = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.6. Medications (MEDICATION ORDERS) XML Fragment
     * see page 122 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_medication_orders()
    {
        $expected = <<<CDA
<component>
  <structuredBody>
    <!-- Begin Medications (MEDICATION ORDERS) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Medication Orders Instance Identifier -->
        <id root="50846572-EFC7-11E0-8337-65094924219B" />
        <!-- Section Type -->
        <code code="101.16146" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Medication Orders" />
        <title>Medications</title>
        <!-- Begin Narrative text -->
        <text>
          <table>
            <thead>
              <tr>
                <th>Status</th>
                <th>Item Description</th>
                <th>Dose Instructions</th>
                <th>Reason for Medication</th>
                <th>Additional Comments</th>
                <th>Reason for Change</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>New - prescribed</td>
                <td>Lasix (frusemide 40 mg) tablet</td>
                <td>1 tablet once daily oral</td>
                <td>Fluid retention, 3 months</td>
                <td>Trial</td>
                <td />
              </tr>
            </tbody>
          </table>
        </text>
        <!-- End Narrative text -->
        <!-- Begin Known Medication (MEDICATION INSTRUCTION) -->
        <entry>
            <substanceAdministration />
        </entry>
        <!-- End Known Medication (MEDICATION INSTRUCTION) -->
      </section>
    </component>
    <!-- End Medications (MEDICATION ORDERS) -->
  </structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section(
          new Id(new InstanceIdentifier('50846572-EFC7-11E0-8337-65094924219B')),
          new Code(new CodedValue('101.16146', 'Medication Orders', '1.2.36.1.2001.1001.101', 'NCTIS Data Components'))
        ))
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->setTitle(new Title('Medications'))
          ->setText(new Text(
            (new Table())
              ->getThead()
              ->createRow()
              ->createCell('Status')->getRow()
              ->createCell('Item Description')->getRow()
              ->createCell('Dose Instructions')->getRow()
              ->createCell('Reason for Medication')->getRow()
              ->createCell('Additional Comments')->getRow()
              ->createCell('Reason for Change')->getRow()
              ->getSection()
              ->getTable()
              ->getTbody()
              ->createRow()
              ->createCell('New - prescribed')->getRow()
              ->createCell('Lasix (frusemide 40 mg) tablet')->getRow()
              ->createCell('1 tablet once daily oral')->getRow()
              ->createCell('Fluid retention, 3 months')->getRow()
              ->createCell('Trial')->getRow()
              ->createCell('')->getRow()
              ->getSection()
              ->getTable()
          ))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setSubstanceAdministration(
              (new SubstanceAdministration())
                ->setMoodCode('')
                ->setClassCode('')
            ));

        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.7. Known Medication (MEDICATION INSTRUCTION) XML Fragment
     * see page 133 EventSummary_CDAImplementationGuide_v1.3.pdf
     */

    public function test_known_medication()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
  <structuredBody>
  <!-- Begin Medications (MEDICATION ORDERS) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Begin Known Medication (MEDICATION INSTRUCTION) -->
        <entry>
          <substanceAdministration classCode="SBADM" moodCode="EVN">
            <!-- Medication Instruction Instance Identifier -->
            <id root="461B6EF6-754C-11E0-A3C3-D19F4824019B" />
            <!-- Directions -->
            <text xsi:type="ST">2 tablets daily after breakfast</text>
            <consumable>
              <manufacturedProduct>
                <manufacturedMaterial>
                  <!-- Therapeutic Good Identification -->
                  <code code="6647011000036101" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Panadeine Forte tablet: uncoated" />
                </manufacturedMaterial>
              </manufacturedProduct>
            </consumable>
            <!-- Begin Clinical Indication -->
            <entryRelationship typeCode="RSON">
              <act classCode="INFRM" moodCode="EVN">
                  <code code="103.10141" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Clinical Indication" />
                  <text xsi:type="ST">Pain control.</text>
              </act>
            </entryRelationship>
            <!-- End Clinical Indication -->
            <!-- Begin Comment -->
            <entryRelationship typeCode="COMP">
              <act classCode="INFRM" moodCode="EVN">
                  <code code="103.16044" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Additional Comments" />
                  <text xsi:type="ST">Dosage to be reviewed in 10 days.</text>
              </act>
            </entryRelationship>
            <!-- End Comment -->
            <!-- Begin Change Type -->
            <entryRelationship typeCode="SPRT">
              <observation classCode="OBS" moodCode="EVN">
                <code code="103.16593" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Change Type" />
                <!-- Change Description -->
                <text>New - prescribed.</text>
                <value code="105681000036100" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Prescribed" xsi:type="CD" />
                <!-- End Change Type -->
                <!-- Begin Change Status -->
                <entryRelationship typeCode="COMP">
                  <observation classCode="OBS" moodCode="EVN">
                    <code code="103.16595" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Change Status" />
                    <value code="703465008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Change made" xsi:type="CD" />
                  </observation>
                </entryRelationship>
                <!-- End Change Status -->
                <!-- Begin Change or Recommendation Reason -->
                <entryRelationship typeCode="RSON">
                  <act classCode="INFRM" moodCode="EVN">
                    <code code="103.10177" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Change or Recommendation Reason" />
                    <text xsi:type="ST">New - prescribed.</text>
                  </act>
                </entryRelationship>
                <!-- End Change or Recommendation Reason -->
              </observation>
            </entryRelationship>
          </substanceAdministration>
        </entry>
        <!-- End Known Medication (MEDICATION INSTRUCTION) -->
      </section>
    </component>
  <!-- End Medications (MEDICATION ORDERS) -->
  </structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setSubstanceAdministration(
              (new SubstanceAdministration(
                (new Consumable(
                  (new ManufacturedProduct(
                    (new ManufacturedMaterial(Code::SNOMED('6647011000036101', 'Panadeine Forte tablet: uncoated')))
                      ->setClassCode('')
                  ))->setClassCode('')
                ))->setTypeCode('')
              ))
                ->setText((new Text('2 tablets daily after breakfast'))->setXSIType(XSITypeInterface::CHARACTER_STRING))
                ->addId(Id::fromString('461B6EF6-754C-11E0-A3C3-D19F4824019B'))
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Act())
                      ->setClassCode(ClassCodeInterface::INFORM)
                      ->setCode(Code::NCTIS('103.10141', 'Clinical Indication'))
                      ->setText((new Text('Pain control.'))->setXSIType(XSITypeInterface::CHARACTER_STRING))
                  ))
                    ->setTypeCode(TypeCodeInterface::HAS_REASON))
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Act())
                      ->setClassCode(ClassCodeInterface::INFORM)
                      ->setCode(Code::NCTIS('103.16044', 'Additional Comments'))
                      ->setText((new Text('Dosage to be reviewed in 10 days.'))->setXSIType(XSITypeInterface::CHARACTER_STRING))
                  ))
                    ->setTypeCode(TypeCodeInterface::COMPONENT))
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Observation())
                      ->setMoodCode(MoodCodeInterface::EVENT)
                      ->setText(new Text('New - prescribed.'))
                      ->setCode(Code::NCTIS('103.16593', 'Change Type'))
                      ->addValue((new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                        ->setCode('105681000036100')
                        ->setDisplayName('Prescribed')
                        ->setCodeSystem('2.16.840.1.113883.6.96')
                        ->setCodeSystemName('SNOMED CT'))
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Observation())
                            ->setMoodCode(MoodCodeInterface::EVENT)
                            ->setCode(Code::NCTIS('103.16595', 'Change Status'))
                            ->addValue(
                              (new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                                ->setCode('703465008')
                                ->setDisplayName('Change made')
                                ->setCodeSystem('2.16.840.1.113883.6.96')
                                ->setCodeSystemName('SNOMED CT')
                            )
                        ))->setTypeCode(TypeCodeInterface::COMPONENT)
                      )
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Act())
                            ->setClassCode(ClassCodeInterface::INFORM)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                            ->setCode(Code::NCTIS('103.10177', 'Change or Recommendation Reason'))
                            ->setText((new Text('New - prescribed.'))->setXSIType(XSITypeInterface::CHARACTER_STRING))
                        ))
                          ->setTypeCode(TypeCodeInterface::HAS_REASON)
                      )
                  ))->setTypeCode(TypeCodeInterface::HAS_SUPPORT)
                )
            )
          );

        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.8. Diagnoses/Interventions (MEDICAL HISTORY) XML Fragment
     * see page 138 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_medical_history()
    {
        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin Diagnoses/Interventions (MEDICAL HISTORY) -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Medical History Instance Identifier -->
				<id root="50846572-EFC7-11E0-8337-65094944019B" />
				<!-- Section Type -->
				<code code="101.16117" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Medical History" />
				<title>Diagnoses/Interventions</title>
				<!-- Narrative text -->
				<text>Narrative.</text>
				<!-- Begin PROBLEM/DIAGNOSIS -->
				<entry>
					<observation />
				</entry>
				<!-- End PROBLEM/DIAGNOSIS -->
				<!-- Begin PROCEDURE -->
				<entry>
					<procedure />
				</entry>
				<!-- End PROCEDURE -->
				<!-- Begin UNCATEGORISED MEDICAL HISTORY ITEM -->
				<entry>
					<act />
				</entry>
				<!-- End UNCATEGORISED MEDICAL HISTORY ITEM -->
			</section>
		</component>
		<!-- End Diagnoses/Interventions (MEDICAL HISTORY) -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->setId(Id::fromString('50846572-EFC7-11E0-8337-65094944019B'))
          ->setCode(Code::NCTIS('101.16117', 'Medical History'))
          ->setTitle(new Title('Diagnoses/Interventions'))
          ->setText(new Text('Narrative.'))
          ->addEntry(
            (new Entry(
              (new Observation())
                ->setClassCode('')
            ))->setTypeCode(''))
          ->addEntry(
            (new Entry(
              (new Procedure())
                ->setMoodCode('')
                ->setClassCode(''))
            )->setTypeCode(''))
          ->addEntry(
            (new Entry(
              (new Act())
                ->setMoodCode('')
                ->setClassCode(''))
            )->setTypeCode(''));

        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.9. PROBLEM/DIAGNOSIS XML Fragment
     * see page 144 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_problem_diagnosis()
    {
        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin Diagnoses/Interventions (MEDICAL HISTORY) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Begin PROBLEM/DIAGNOSIS -->
        <entry>
          <observation classCode="OBS" moodCode="EVN">
            <!-- Problem/Diagnosis Instance Identifier -->
            <id root="74D29C88-706E-11E0-9726-5ABE4824019B" />
            <!-- Detailed Clinical Model Identifier -->
            <code code="282291009" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Diagnosis interpretation" />
            <!-- Date of Onset -->
            <effectiveTime>
                <low value="20110410" />
            </effectiveTime>
            <!-- Problem/Diagnosis Identification -->
            <value code="85189001"
                codeSystemName="SNOMED CT"
                displayName="Acute appendicitis" xsi:type="CD" />
            <!-- Begin Problem/Diagnosis Comment -->
            <entryRelationship typeCode="COMP">
                <act classCode="INFRM" moodCode="EVN">
                   <code code="103.16545" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Problem/Diagnosis Comment" />
                   <text xsi:type="ST">Problem/Diagnosis Comment goes here.</text>
                </act>
            </entryRelationship>
          </observation>
        </entry>
        <!-- End PROBLEM/DIAGNOSIS -->
      </section>
    </component>
    <!-- End Diagnoses/Interventions (MEDICAL HISTORY) -->
  </structuredBody>
</component>
<!-- End CDA Body -->

CDA;
        $section  = (new Section())
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry(
            (new Entry(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('74D29C88-706E-11E0-9726-5ABE4824019B'))
                ->setCode(Code::SNOMED(282291009, 'Diagnosis interpretation'))
                ->setEffectiveTime(
                  (new IntervalOfTime(
                    (new TimeStamp(new \DateTime('2011-04-10', new \DateTimeZone('UTC'))))
                      ->setPrecision(TimeStamp::PRECISION_DAY)
                  ))->setShowXSIType(false)
                )
                ->addValue(
                  (new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                    ->setCode('85189001')
                    ->setCodeSystemName('SNOMED CT')
                    ->setDisplayName('Acute appendicitis')
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Act())
                      ->setCode(Code::NCTIS('103.16545', 'Problem/Diagnosis Comment'))
                      ->setText(
                        (new Text('Problem/Diagnosis Comment goes here.')
                        )->setXSIType(XSITypeInterface::CHARACTER_STRING)
                      )
                      ->setClassCode(ClassCodeInterface::INFORM)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                  ))->setTypeCode(TypeCodeInterface::COMPONENT)
                )
            ))->setTypeCode('')
          );
        $tag      = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.10. PROCEDURE XML Fragment
     * see page 144 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_procedure()
    {
        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin Diagnoses/Interventions (MEDICAL HISTORY) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Begin PROCEDURE -->
        <entry>
          <procedure classCode="PROC" moodCode="EVN">
            <!-- Procedure Instance Identifier -->
            <id root="B96A38C6-706C-11E0-AD2E-42BC4824019B" />
            <!-- Procedure Name -->
            <code code="80146002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Appendicectomy" />
            <!-- Begin Procedure DateTime -->
            <effectiveTime xsi:type="IVL_TS">
              <low value="20130101"/>
              <high value="20130201"/>
            </effectiveTime>
            <!-- End Procedure DateTime -->
            <!-- Begin Procedure Comment -->
            <entryRelationship typeCode="COMP">
              <act classCode="INFRM" moodCode="EVN">
                <code code="103.15595" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Procedure Comment" />
                <text xsi:type="ST">Procedure Comment goes here.</text>
              </act>
            </entryRelationship>
            <!-- End Procedure Comment -->
          </procedure>
        </entry>
      </section>
    </component>
    <!-- End Diagnoses/Interventions (MEDICAL HISTORY) -->
  </structuredBody>
</component>
<!-- End CDA Body -->

CDA;
        $section  = (new Section())
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry(
            (new Entry(
              (new Procedure())
                ->addId(Id::fromString('B96A38C6-706C-11E0-AD2E-42BC4824019B'))
                ->setCode(Code::SNOMED(80146002, 'Appendicectomy'))
                ->setEffectiveTime(
                  new EffectiveTime(
                    new IntervalOfTime(
                      (new TimeStamp(new \DateTime('2013-01-01', new \DateTimeZone('UTC'))))
                        ->setPrecision(TimeStamp::PRECISION_DAY),
                      (new TimeStamp(new \DateTime('2013-02-01', new \DateTimeZone('UTC'))))
                        ->setPrecision(TimeStamp::PRECISION_DAY)
                    )
                  )
                )
                ->addEntryRelationShip(
                  (new EntryRelationship(
                    (new Act())
                      ->setCode(Code::NCTIS('103.15595', 'Procedure Comment'))
                      ->setText(
                        (new Text('Procedure Comment goes here.')
                        )->setXSIType(XSITypeInterface::CHARACTER_STRING)
                      )
                      ->setClassCode(ClassCodeInterface::INFORM)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                  ))->setTypeCode(TypeCodeInterface::COMPONENT)
                )
            ))->setTypeCode('')
          );
        $tag      = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.11. UNCATEGORISED MEDICAL HISTORY ITEM XML Fragment
     * see page 156 EventSummary_CDAImplementationGuide_v1.3.pdf
     * note the xml sample in this snippet didn't conform to the sequence order in xsd
     * POCD_MT000040.Act complexType
     */
    public function test_uncategorised_medical_history_item()
    {

        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin Diagnoses/Interventions (MEDICAL HISTORY) -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Begin UNCATEGORISED MEDICAL HISTORY ITEM -->
        <entry>
          <act classCode="ACT" moodCode="EVN">
            <!-- Uncategorised Medical History Item Instance Identifier -->
            <id root="0CBE0B42-7072-11E0-94B1-26C24824019B" />
            <!-- Detailed Clinical Model Identifier -->
            <code code="102.16627" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Uncategorised Medical History Item" />
            <!-- Medical History Item Description -->
            <text xsi:type="ST">Other Medical History Item Description goes here.</text>
            <!-- Begin Medical History Item Time Interval -->
            <effectiveTime>
              <low value="201010131000+1000" />
              <high value="201010131030+1000" />
            </effectiveTime>
            <!-- End Medical History Item Time Interval -->            
            <!-- Begin Medical History Item Comment -->
            <entryRelationship typeCode="COMP">
              <act classCode="INFRM" moodCode="EVN">
                <code code="103.16630" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Medical History Item Comment" />
                <text xsi:type="ST">Medical History Item Comment goes here.</text>
              </act>
            </entryRelationship>
          </act>
        </entry>
        <!-- End UNCATEGORISED MEDICAL HISTORY ITEM -->
      </section>
    </component>
    <!-- End Diagnoses/Interventions (MEDICAL HISTORY) -->
  </structuredBody>
</component>
<!-- End CDA Body -->


CDA;
        $section  = (new Section())
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry(
            (new Entry(
              (new Act())
                ->addId(Id::fromString('0CBE0B42-7072-11E0-94B1-26C24824019B'))
                ->setCode(Code::NCTIS('102.16627', 'Uncategorised Medical History Item'))
                ->setEffectiveTime(
                  (New IntervalOfTime(
                    (new TimeStamp(new \DateTime('2010-10-13 10:00', new \DateTimeZone('+1000'))))
                      ->setPrecision(TimeStamp::PRECISION_MINUTES)
                      ->setOffset(true),
                    (new TimeStamp(new \DateTime('2010-10-13 10:30', new \DateTimeZone('+1000'))))
                      ->setPrecision(TimeStamp::PRECISION_MINUTES)
                      ->setOffset(true)
                  ))->setShowXSIType(false)
                )
                ->setText(
                  (new Text('Other Medical History Item Description goes here.'))->setXSIType(XSITypeInterface::CHARACTER_STRING)
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Act())
                      ->setClassCode(ClassCodeInterface::INFORM)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                      ->setCode(Code::NCTIS('103.16630', 'Medical History Item Comment'))
                      ->setText(
                        (new Text('Medical History Item Comment goes here.'))
                          ->setXSIType(XSITypeInterface::CHARACTER_STRING))
                  )
                  )->setTypeCode(TypeCodeInterface::COMPONENT)
                )
            ))->setTypeCode('')
          );

        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }


    /**
     * Example 7.12. IMMUNISATIONS XML Fragment
     * see page 161 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_immunisations_fragment()
    {

        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Immunisations Section -->
    <component>
      <section>
        <code code="101.16638" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Immunisations" />
        <title>Immunisations</title>
        <text>
          <table>
            <thead>
              <tr><th>Vaccine Name</th></tr>
            </thead>
            <tbody>
              <tr><td>Boostrix(DTPa)</td></tr>
            </tbody>
          </table>
        </text>
      </section>
    </component>
    <!-- End Immunisations Section -->
  </structuredBody>
</component>
<!-- End CDA Body -->


CDA;
        $section  = (new Section(
          null,
          Code::NCTIS('101.16638', 'Immunisations'),
          new Title('Immunisations'),
          new Text(
            (new Table())
              ->getThead()
              ->createRow()
              ->createCell('Vaccine Name', TableCell::TH)->getRow()
              ->getSection()
              ->getTable()
              ->getTbody()
              ->createRow()
              ->createCell('Boostrix(DTPa)')->getRow()
              ->getSection()
              ->getTable()
          )))
          ->setMoodCode('')
          ->setClassCode('');

        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            (new SingleComponent($section))->setTypeCode('')
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.13. Administered Immunisation (MEDICATION ACTION) XML Fragment
     * see page 166 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_administered_immunisations()
    {

        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin IMMUNISATIONS -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Begin Administered Immunisation (MEDICATION ACTION) -->
        <entry>
          <substanceAdministration classCode="SBADM" moodCode="EVN">
            <!-- Medication Action Instance Identifier -->
            <id root="C5F9D7BA-A2B3-11E0-9C5E-5D194924019B" />
            <!-- Medication Action DateTime -->
            <effectiveTime value="20110427" />
            <consumable>
              <manufacturedProduct>
                <manufacturedMaterial>
                  <!-- Therapeutic Good Identification -->
                  <code code="162551000036100" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fluvax 2014 injection: suspension, 0.5 mL syringe" />
                </manufacturedMaterial>
              </manufacturedProduct>
            </consumable>
          </substanceAdministration>
        </entry>
      <!-- End Administered Immunisation (MEDICATION ACTION) -->
      </section>
    </component>
    <!-- End IMMUNISATIONS -->
  </structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->addEntry(
            (new Entry(
              (new SubstanceAdministration())
                ->addId(Id::fromString('C5F9D7BA-A2B3-11E0-9C5E-5D194924019B'))
                ->returnSubstanceAdministration()
                ->addEffectiveTime(TimeStamp::fromString('2011-04-27', 'UTC')->setPrecision(Timestamp::PRECISION_DAY))
                ->returnSubstanceAdministration()
                ->setConsumable((new Consumable(
                  (new ManufacturedProduct(
                    (new ManufacturedMaterial(
                      Code::SNOMED(162551000036100, 'Fluvax 2014 injection: suspension, 0.5 mL syringe')
                    ))->setClassCode('')
                  ))->setClassCode('')
                    ->returnManufacturedProduct()
                ))->setTypeCode('')
                  ->returnConsumable()
                )
            ))->setTypeCode('')
          );
        $tag      = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          )
          )->setClassCode('')
        );
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.14. DIAGNOSTIC INVESTIGATIONS XML Fragment
     * see page 171 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_diagnostic_investigations()
    {

        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
  <structuredBody>
    <!-- Begin DIAGNOSTIC INVESTIGATIONS -->
    <component typeCode="COMP">
      <section classCode="DOCSECT" moodCode="EVN">
        <!-- Diagnostic Investigations Identifier -->
        <id root="50846572-EFC7-11E0-8337-65094974019B" />
        <!-- Section Type -->
        <code code="101.20117" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Diagnostic Investigations" />
        <title>Diagnostic Investigations</title>
        <text />
         <!-- Begin PATHOLOGY TEST RESULT -->
        <component>
          <section />
        </component>
        <!-- End PATHOLOGY TEST RESULT -->
        <!-- Begin IMAGING EXAMINATION RESULT -->
        <component>
          <section />
        </component>
        <!-- End IMAGING EXAMINATION RESULT -->
        <!-- Begin REQUESTED SERVICE -->
        <component>
          <section />
        </component>
        <!-- End REQUESTED SERVICE -->
      </section>
    </component>
    <!-- End DIAGNOSTIC INVESTIGATIONS -->
  </structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section(
          new Id(new InstanceIdentifier('50846572-EFC7-11E0-8337-65094974019B')),
          Code::NCTIS('101.20117', 'Diagnostic Investigations'),
          new Title('Diagnostic Investigations'),
          new Text()
        ))
          ->addComponent((new SingleComponent((new Section())->setMoodCode('')->setClassCode('')))->setTypeCode(''))
          ->addComponent((new SingleComponent((new Section())->setMoodCode('')->setClassCode('')))->setTypeCode(''))
          ->addComponent((new SingleComponent((new Section())->setMoodCode('')->setClassCode('')))->setTypeCode(''));
        $tag      = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          )
          )->setClassCode('')
        );
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.15. PATHOLOGY TEST RESULT XML Fragment
     * see page 185 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_pathology_test_result()
    {

        $expected = <<<CDA
<!-- Begin CDA Header -->
<!-- End CDA Header -->
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin PATHOLOGY TEST RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<!-- Pathology Test Result Instance Identifier - used for system purposes such as matching -->
						<id root="CCF0D55C-EFD0-11DF-BEA2-AACCDFD72085" />
						<!-- Detailed Clinical Model Identifier -->
						<code code="102.16144" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Pathology Test Result" />
						<title>Pathology Test Result</title>
						<text>
							<table>
								<thead>
									<tr>
										<th>Test</th>
										<th>Value</th>
										<th>Units</th>
										<th>Reference Range</th>
										<th>Interpretation</th>
										<th>DateTime</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Serum Creatinine</td>
										<td>0.06</td>
										<td>mmol/L</td>
										<td>0.04-0.11</td>
										<td>N</td>
										<td>12/02/2013</td>
									</tr>
									<tr>
										<td>Serum Uric Acid</td>
										<td>0.41</td>
										<td>mmol/L</td>
										<td>0.14-0.35</td>
										<td>HH</td>
										<td>12/02/2013</td>
									</tr>
								</tbody>
							</table>
							<paragraph>
								<linkHtml href="pathresult.pdf">Attached Pathology Result</linkHtml>
							</paragraph>
						</text>
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Laboratory Test Result Identifier -->
								<id root="8FC201B4-F2FA-11E0-906B-E4D04824019B" />
								<!-- Test Result Name (Pathology Test Result Name) -->
								<code code="275711006" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Serum Chemistry Test" xsi:type="CD" />
								<!-- Begin Test Result Representation -->
								<value mediaType="application/pdf" xsi:type="ED">
									<reference value="pathresult.pdf" />
								</value>
								<!-- End Test Result Representation -->
								<!-- Begin Diagnostic Service -->
								<entryRelationship typeCode="COMP">
									<observation classCode="OBS" moodCode="EVN">
										<code code="310074003" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="pathology service" />
										<value code="CH" codeSystem="2.16.840.1.113883.12.74" codeSystemName="HL7 Diagnostic service section ID" displayName="Chemistry" xsi:type="CD" />
									</observation>
								</entryRelationship>
								<!-- End Diagnostic Service -->
								<!-- Begin Test Specimen Detail (SPECIMEN) -->
								<entryRelationship typeCode="SUBJ">
									<observation classCode="OBS" moodCode="EVN"></observation>
								</entryRelationship>
								<!-- End Test Specimen Detail (SPECIMEN) -->
								<!-- Begin Overall Pathology Test Result Status -->
								<entryRelationship typeCode="COMP">
									<observation classCode="OBS" moodCode="EVN">
										<!-- ID is used for system purposes such as matching -->
										<id root="7AA9BAAC-0CD0-11E0-9516-4350DFD72085" />
										<code code="308552006" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="report status" />
										<value code="3" codeSystem="1.2.36.1.2001.1001.101.104.16501" codeSystemName="NCTIS Result Status Values" displayName="Final" xsi:type="CD" />
									</observation>
								</entryRelationship>
								<!-- End Overall Pathology Test Result Status -->
								<!-- Begin Clinical Information Provided -->
								<entryRelationship typeCode="COMP">
									<act classCode="INFRM" moodCode="EVN">
										<code code="55752-0" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Clinical information" />
										<text>Bloods for evaluation.</text>
									</act>
								</entryRelationship>
								<!-- End Clinical Information Provided -->
								<!-- Begin Result Group (PATHOLOGY TEST RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN"></organizer>
								</entryRelationship>
								<!-- End Result Group (PATHOLOGY TEST RESULT GROUP) -->
								<!-- Begin Pathological Diagnosis -->
								<entryRelationship typeCode="REFR">
									<observation classCode="OBS" moodCode="EVN">
										<code code="88101002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="pathology diagnosis" />
										<value code="301011002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Escherichia coli urinary tract infection" xsi:type="CD" />
										<value code="197940006" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Microscopic haematuria" xsi:type="CD" />
									</observation>
								</entryRelationship>
								<!-- End Pathological Diagnosis -->
								<!-- Begin Pathology Test Conclusion -->
								<entryRelationship typeCode="REFR">
									<observation classCode="OBS" moodCode="EVN">
										<id root="060588DE-F2F9-11E0-ABE7-C7CE4824019B" />
										<code code="386344002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="laboratory findings data interpretation" />
										<value xsi:type="ST">Chronic problems.</value>
									</observation>
								</entryRelationship>
								<!-- End Pathology Test Conclusion -->
								<!-- Begin Test Comment -->
								<entryRelationship typeCode="COMP">
									<act classCode="INFRM" moodCode="EVN">
										<code code="103.16468" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Test Comment" />
										<text>Known PKD</text>
									</act>
								</entryRelationship>
								<!-- End Test Comment -->
								<!-- Begin TEST REQUEST DETAILS -->
								<entryRelationship inversionInd="true" typeCode="SUBJ">
									<act classCode="ACT" moodCode="EVN">
										<code code="102.16160" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Test Request Details" />
										<!-- Begin Test Requested Name -->
										<entryRelationship typeCode="COMP">
											<observation classCode="OBS" moodCode="RQO">
												<code code="103.16404" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Test Requested Name" />
												<value code="401324008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Urinary microscopy, culture and sensitivities" xsi:type="CD" />
											</observation>
										</entryRelationship>
										<!-- End Test Requested Name -->
									</act>
								</entryRelationship>
								<!-- End Test TEST REQUEST DETAILS -->
								<!-- Begin Observation DateTime -->
								<entryRelationship typeCode="COMP">
									<observation classCode="OBS" moodCode="EVN">
										<!-- ID is used for system purposes such as matching -->
										<id root="CCFFD55C-EFD0-11DF-BEA2-A6CCDFD72085" />
										<code code="103.16605" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Pathology Test Result DateTime" />
										<effectiveTime value="201310201235+1000" />
									</observation>
								</entryRelationship>
								<!-- End Observation DateTime -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End PATHOLOGY TEST RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;


        $section_component = new Section(
          new Id(new InstanceIdentifier('CCF0D55C-EFD0-11DF-BEA2-AACCDFD72085')),
          Code::NCTIS('102.16144', 'Pathology Test Result'),
          new Title('Pathology Test Result'),
          (new Text(
            (new Table())
              ->getThead()
              ->createRow()
              ->createCell('Test')->getRow()
              ->createCell('Value')->getRow()
              ->createCell('Units')->getRow()
              ->createCell('Reference Range')->getRow()
              ->createCell('Interpretation')->getRow()
              ->createCell('DateTime')->getRow()
              ->getSection()
              ->getTable()
              ->getTbody()
              ->createRow()
              ->createCell('Serum Creatinine')->getRow()
              ->createCell('0.06')->getRow()
              ->createCell('mmol/L')->getRow()
              ->createCell('0.04-0.11')->getRow()
              ->createCell('N')->getRow()
              ->createCell('12/02/2013')->getRow()
              ->getSection()
              ->createRow()
              ->createCell('Serum Uric Acid')->getRow()
              ->createCell('0.41')->getRow()
              ->createCell('mmol/L')->getRow()
              ->createCell('0.14-0.35')->getRow()
              ->createCell('HH')->getRow()
              ->createCell('12/02/2013')->getRow()
              ->getSection()
              ->getTable()))
            ->addTag(new Paragraph(new LinkHtml('Attached Pathology Result', 'pathresult.pdf')))
        );

        $observation = (new Observation())
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addValue((new Value('', XSITypeInterface::ENCAPSULATED_DATA))
            ->setValueType(new ValueType('application/pdf', 'mediaType'))
            ->setReferenceElement(new ReferenceElement('pathresult.pdf')))
          ->addId(Id::fromString('8FC201B4-F2FA-11E0-906B-E4D04824019B'))
          ->setCode(Code::SNOMED('275711006', 'Serum Chemistry Test')->setXSIType(XSITypeInterface::CONCEPT_DESCRIPTOR))
          ->returnObservation()
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::SNOMED('310074003', 'pathology service'),
                (new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                  ->setCode('CH')
                  ->setCodeSystem('2.16.840.1.113883.12.74')
                  ->setCodeSystemName('HL7 Diagnostic service section ID')
                  ->setDisplayName('Chemistry')
              ))->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode(TypeCodeInterface::COMPONENT)
          )
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation())
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode(TypeCodeInterface::HAS_SUBJECT))
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::SNOMED('308552006', 'report status'),
                (new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                  ->setCode('3')
                  ->setCodeSystem('1.2.36.1.2001.1001.101.104.16501')
                  ->setCodeSystemName('NCTIS Result Status Values')
                  ->setDisplayName('Final')
              ))
                ->addId(Id::fromString('7AA9BAAC-0CD0-11E0-9516-4350DFD72085'))
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode(TypeCodeInterface::COMPONENT))
          ->addEntryRelationship(
            new EntryRelationship(
              (new Act())
                ->setClassCode(ClassCodeInterface::INFORM)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->setCode(Code::LOINC('55752-0', 'Clinical information'))
                ->setText(new Text('Bloods for evaluation.')),
              TypeCodeInterface::COMPONENT))
          ->addEntryRelationship(
            new EntryRelationship(
              (new Organizer())
                ->setClassCode(ClassCodeInterface::BATTERY)
                ->setMoodCode(MoodCodeInterface::EVENT),
              TypeCodeInterface::COMPONENT))
          ->addEntryRelationship(
            new EntryRelationship(
              (new Observation(
                Code::SNOMED('88101002', 'pathology diagnosis'),
                Value::SNOMED('301011002', 'Escherichia coli urinary tract infection')))
                ->addValue(Value::SNOMED('197940006', 'Microscopic haematuria'))
                ->setMoodCode(MoodCodeInterface::EVENT),
              TypeCodeInterface::REFERS_TO))
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::SNOMED('386344002', 'laboratory findings data interpretation'),
                (new Value('', XSITypeInterface::CHARACTER_STRING))
                  ->setContent('Chronic Problems.')
              ))
                ->addId(Id::fromString('060588DE-F2F9-11E0-ABE7-C7CE4824019B'))
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode(TypeCodeInterface::REFERS_TO))
          ->addEntryRelationship(
            new EntryRelationship(
              (new Act())
                ->setClassCode(ClassCodeInterface::INFORM)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->setCode(Code::NCTIS('103.16468', 'Test Comment'))
                ->setText(new Text('Known PKD')),
              TypeCodeInterface::COMPONENT))
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Act())
                ->setClassCode(ClassCodeInterface::ACT)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->setCode(Code::NCTIS('102.16160', 'Test Request Details'))
                ->addEntryRelationship(
                  new EntryRelationship(
                    (new Observation(
                      Code::NCTIS('103.16404', 'Test Requested Name'),
                      Value::SNOMED('401324008', 'Urinary microscopy, culture and sensitivities')
                    ))
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::REQUEST)
                    , TypeCodeInterface::COMPONENT)),
              TypeCodeInterface::HAS_SUBJECT))
              ->setInversionInd(true)
          )
          ->addEntryRelationship(
            new EntryRelationship(
              (new Observation(
                Code::NCTIS('103.16605', 'Pathology Test Result DateTime'), null))
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('CCFFD55C-EFD0-11DF-BEA2-A6CCDFD72085'))
                ->setEffectiveTime(
                  (new TimeStamp(new \DateTime('2013-10-20 12:35', new \DateTimeZone('+1000'))))
                    ->setPrecision(TimeStamp::PRECISION_MINUTES)
                    ->setOffset(true)
                ),
              TypeCodeInterface::COMPONENT)
          );
        $section_component->addEntry((new Entry($observation))->setTypeCode(''));
        $section = (new Section())
          ->addComponent((new SingleComponent($section_component))->setTypeCode(''));

        $tag = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          ))->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.16. Test Specimen Detail (SPECIMEN) XML Fragment
     * see page 199 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_specimen_detail()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin PATHOLOGY TEST RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Begin Test Specimen Detail (SPECIMEN) -->
								<entryRelationship typeCode="SUBJ">
									<observation classCode="OBS" moodCode="EVN">
										<!-- ID is used for system purposes such as matching -->
										<id root="CCC0D55C-EFD0-11DF-BEA2-A6CCDFD72085" />
										<code code="102.16156.136.2.1" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Specimen" />
										<!-- Date and Time of Collection (Collection DateTime) -->
										<effectiveTime value="201310201235+1000" />
										<!-- Collection Procedure -->
										<methodCode code="48635004" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fine needle biopsy" />
										<!-- Anatomical Site (ANATOMICAL LOCATION) :: Examples provided of all three allowed variants. These variants are mutually exclusive -->
										<!-- Begin Example with complete SPECIFIC LOCATION -->
										<!-- Begin SPECIFIC LOCATION -->
										<!-- Name of Location (Anatomical Location Name) -->
										<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax">
											<!-- Begin Side -->
											<qualifier>
												<name code="272741003" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Laterality" />
												<value code="7771000" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="left" xsi:type="CD" />
											</qualifier>
											<!-- End Side -->
										</targetSiteCode>
										<!-- End SPECIFIC LOCATION -->
										<!-- End Example with complete SPECIFIC LOCATION -->
										<!-- Begin Example with partial SPECIFIC LOCATION -->
										<!-- Begin SPECIFIC LOCATION -->
										<!-- Name of Location (Anatomical Location Name) -->
										<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax" />
										<!-- End SPECIFIC LOCATION -->
										<!-- End Example with partial SPECIFIC LOCATION -->
										<!-- Begin Example with Description -->
										<targetSiteCode>
											<!-- Description (Anatomical Location Description) -->
											<originalText>Chest/Thorax</originalText>
										</targetSiteCode>
										<!-- End SPECIFIC LOCATION -->
										<!-- End Example with Description -->
										<!-- End Anatomical Site (ANATOMICAL LOCATION) -->
										<!-- Begin Physical Details -->
										<specimen>
											<specimenRole>
												<!-- Specimen Identifier -->
												<id root="1538103e-845b-4f86-95ed-33b62e7589d0" />
												<!-- Begin Physical Details (PHYSICAL PROPERTIES OF AN OBJECT) -->
												<specimenPlayingEntity>
													<!-- Specimen Tissue Type -->
													<code code="258442002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fluid sample" />
													<!-- Begin Weight/Volume -->
													<quantity unit="mL" value="5" />
													<!-- End Weight/Volume -->
													<!-- Begin Description (Object Description) -->
													<desc xsi:type="ST">5 mL</desc>
													<!-- End Description (Object Description) -->
													<!-- Begin Container Identifier -->
													<ext:asSpecimenInContainer classCode="CONT">
														<ext:container>
															<ext:id extension="CNH45218964" root="CA54FD22-76B8-11E0-AC87-0EE34824019B" />
														</ext:container>
													</ext:asSpecimenInContainer>
													<!-- End Container Identifier -->
												</specimenPlayingEntity>
												<!-- End Physical Details (PHYSICAL PROPERTIES OF AN OBJECT) -->
											</specimenRole>
										</specimen>
										<!-- End Physical Details -->
										<!-- Begin Anatomical Location Image -->
										<entryRelationship typeCode="SPRT">
											<observationMedia classCode="OBS" moodCode="EVN">
												<id root="3953A078-0365-11E1-B90D-41D04724019B" />
												<value mediaType="image/jpeg" >
													<reference value="location.jpeg" />
												</value>
											</observationMedia>
										</entryRelationship>
										<!-- End Anatomical Location Image -->
										<!-- Begin Image -->
										<entryRelationship typeCode="SPRT">
											<observationMedia classCode="OBS" moodCode="EVN">
												<id root="1d64bb51-c5b3-4048-9a9f-e753f4e3c203" />
												<value mediaType="image/jpeg" >
													<reference value="specimen.jpeg" />
												</value>
											</observationMedia>
										</entryRelationship>
										<!-- End Image -->
										<!-- Begin Sampling Preconditions -->
										<entryRelationship typeCode="COMP">
											<observation classCode="OBS" moodCode="EVN">
												<code code="103.16171" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Sampling Preconditions" />
												<value code="16985007" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fasting" xsi:type="CD" />
											</observation>
										</entryRelationship>
										<!-- End Sampling Preconditions -->
										<!-- Begin Collection Setting -->
										<entryRelationship typeCode="COMP">
											<observation classCode="OBS" moodCode="EVN">
												<code code="103.16529" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Collection Setting" />
												<value xsi:type="ST">Pathology Clinic</value>
											</observation>
										</entryRelationship>
										<!-- End Collection Setting -->
										<!-- Begin Date and Time of Receipt (DateTime Received) -->
										<entryRelationship typeCode="COMP">
											<observation classCode="OBS" moodCode="EVN">
												<code code="103.11014" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="DateTime Received" />
												<value value="201112141120+1000" xsi:type="TS" />
											</observation>
										</entryRelationship>
										<!-- End Date and Time of Receipt (DateTime Received) -->
										<!-- Begin Parent Specimen Identifier -->
										<entryRelationship typeCode="COMP">
											<observation classCode="OBS" moodCode="EVN">
												<code code="103.16187" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Parent Specimen Identifier" />
												<specimen>
													<specimenRole>
														<id root="7013b12a-f9d0-4197-9726-88a6803d4d13" />
													</specimenRole>
												</specimen>
											</observation>
										</entryRelationship>
										<!-- End Parent Specimen Identifier -->
									</observation>
								</entryRelationship>
								<!-- End Test Specimen Detail (SPECIMEN) -->
								<!-- Begin Result Group (PATHOLOGY TEST RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN" />
								</entryRelationship>
								<!-- End Result Group (PATHOLOGY TEST RESULT GROUP) -->
								<!-- Begin TEST REQUEST DETAILS -->
								<entryRelationship inversionInd="true" typeCode="SUBJ">
									<act classCode="ACT" moodCode="EVN" />
								</entryRelationship>
								<!-- End Test TEST REQUEST DETAILS -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End PATHOLOGY TEST RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->   
CDA;
        $ob       = (new Observation())
          ->setClassCode(ClassCodeInterface::OBSERVATION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addId(Id::fromString('CCC0D55C-EFD0-11DF-BEA2-A6CCDFD72085'))
          ->setCode(Code::NCTIS('102.16156.136.2.1', 'Specimen'))
          ->setEffectiveTime(TimeStamp::fromString('2013-10-20 12:35', '+1000'))
          ->addMethodCode(MethodCode::SNOMED('48635004', 'Fine needle biopsy'))
          ->addTargetSiteCode(
            TargetSiteCode::SNOMED('51185008', 'thorax')
              ->setQualifier(new Qualifier(
                Name::SNOMED('272741003', 'Laterality'),
                Value::SNOMED('7771000', 'left')
              ))
          )
          ->addTargetSiteCode(
            TargetSiteCode::SNOMED('51185008', 'thorax')
          )
          ->addTargetSiteCode(
            (new TargetSiteCode())
              ->setOriginalText(new OriginalText('Chest/Thorax'))
          )
          ->addSpecimen(new Specimen(
            (new SpecimenRole(
              (new SpecimenPlayingEntity())
                ->setClassCode('')
                ->setCode(Code::SNOMED('258442002', 'Fluid sample'))
                ->addQuantity(Quantity::fromString('mL', '5'))
                ->setDesc(Desc::fromString('5 mL', XSITypeInterface::CHARACTER_STRING))
                ->setExtAsSpecimenInContainer(
                  new ExtAsSpecimenInContainer(
                    new ExtContainer(
                      new ExtId(null, 'CA54FD22-76B8-11E0-AC87-0EE34824019B', 'CNH45218964')
                    )
                  )
                )
            ))->addId(Id::fromString('1538103e-845b-4f86-95ed-33b62e7589d0'))
          ))
          ->addEntryRelationship(
            (new EntryRelationship(
              (new ObservationMedia())
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('3953A078-0365-11E1-B90D-41D04724019B'))
                ->setValue((new Value())
                  ->setMediaType('image/jpeg')
                  ->setReferenceElement(new ReferenceElement('location.jpeg')))
            ))
              ->setTypeCode(TypeCodeInterface::HAS_SUPPORT)
          )
          ->addEntryRelationship(
            (new EntryRelationship(
              (new ObservationMedia())
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('1d64bb51-c5b3-4048-9a9f-e753f4e3c203'))
                ->setValue((new Value())
                  ->setMediaType('image/jpeg')
                  ->setReferenceElement(new ReferenceElement('specimen.jpeg')))
            ))
              ->setTypeCode(TypeCodeInterface::HAS_SUPPORT)
          )
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::NCTIS('103.16171', 'Sampling Preconditions'),
                Value::SNOMED('16985007', 'Fasting', XSITypeInterface::CONCEPT_DESCRIPTOR)
              ))
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))
              ->setTypeCode(TypeCodeInterface::COMPONENT)
          )
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::NCTIS('103.16529', 'Collection Setting'),
                (new Value('', XSITypeInterface::CHARACTER_STRING))
                  ->setContent('Pathology Clinic')
              ))
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))
              ->setTypeCode(TypeCodeInterface::COMPONENT)
          )
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::NCTIS('103.11014', 'DateTime Received'),
                new Value('201112141120+1000', XSITypeInterface::TIMESTAMP)
              ))
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))
              ->setTypeCode(TypeCodeInterface::COMPONENT)
          )
          ->addEntryRelationship(
            (new EntryRelationship(
              (new Observation(
                Code::NCTIS('103.16187', 'Parent Specimen Identifier')
              ))
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addSpecimen(
                  new Specimen(
                    (new SpecimenRole())
                      ->addId(Id::fromString('7013b12a-f9d0-4197-9726-88a6803d4d13'))
                  )
                )
            ))
              ->setTypeCode(TypeCodeInterface::COMPONENT)
          );
        $section  = (new Section())
          ->addComponent(
            (new SingleComponent(
              (new Section())
                ->addEntry((new Entry())
                  ->setTypeCode('')
                  ->setObservation(
                    (new Observation())
                      ->addEntryRelationship(
                        (new EntryRelationship($ob))
                          ->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                      )
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Organizer())
                            ->setClassCode(ClassCodeInterface::BATTERY)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                        ))
                          ->setTypeCode(TypeCodeInterface::COMPONENT)
                      )
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Act())
                            ->setClassCode(ClassCodeInterface::ACT)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                        ))
                          ->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                          ->setInversionInd(true)
                      )
                      ->setMoodCode(MoodCodeInterface::EVENT)
                  )
                )// addEntry
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode('')
          );
        $tag      = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          )
          )->setClassCode('')
        );
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.17 Result Group (PATHOLOGY TEST RESULT GROUP) XML Fragment
     * see page 211 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_pathology_test_result_group()
    {
        $expected  = <<<CDA
	<!-- Begin CDA Body -->
	<component>
		<structuredBody>
			<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
			<component typeCode="COMP">
				<section classCode="DOCSECT" moodCode="EVN">
					<!-- Begin PATHOLOGY TEST RESULT -->
					<component>
						<section classCode="DOCSECT" moodCode="EVN">
							<entry>
								<observation classCode="OBS" moodCode="EVN">
									<!-- Begin Test Specimen Detail (SPECIMEN) -->
									<entryRelationship typeCode="SUBJ">
										<observation classCode="OBS" moodCode="EVN" />
									</entryRelationship>
									<!-- End Test Specimen Detail (SPECIMEN) -->
									<!-- Begin Result Group (PATHOLOGY TEST RESULT GROUP) -->
									<entryRelationship typeCode="COMP">
										<organizer classCode="BATTERY" moodCode="EVN">
											<id root="9BE931D2-F085-11E0-9831-1E7C4824019B" />
											<!-- Pathology Test Result Group Name -->
											<code code="18719-5" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Chemistry studies (set)" />
											<statusCode code="completed" />
											<!-- Begin Result (INDIVIDUAL PATHOLOGY TEST RESULT) -->
											<component>
												<observation classCode="OBS" moodCode="EVN">
													<id root="3802BA7A-F086-11E0-8A74-147D4824019B" />
													<!-- Individual Pathology Test Result Name -->
													<code code="14682-9" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Serum Creatinine" />
													<!-- Individual Pathology Test Result Value -->
													<value unit="mmol/L" value="0.06" xsi:type="PQ" />
													<!-- Begin Individual Pathology Test Result Comment -->
													<entryRelationship typeCode="COMP">
														<act classCode="INFRM" moodCode="EVN">
															<code code="281296001" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="result comments" />
															<text>Within normal range.</text>
														</act>
													</entryRelationship>
													<!-- End Individual Pathology Test Result Comment -->
													<!-- Begin Individual Pathology Test Result Reference Range Guidance -->
													<entryRelationship typeCode="COMP">
														<act classCode="INFRM" moodCode="EVN">
															<code code="281298000" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="reference range comments" />
															<text xsi:type="ST">Within normal range +/- 5%.</text>
														</act>
													</entryRelationship>
													<!-- End Individual Pathology Test Result Reference Range Guidance -->
													<!-- Begin Individual Pathology Test Result Status -->
													<entryRelationship typeCode="COMP">
														<observation classCode="OBS" moodCode="EVN">
															<code code="308552006" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="report status" />
															<value code="3" codeSystem="1.2.36.1.2001.1001.101.104.16501" codeSystemName="NCTIS Result Status Values" displayName="Final" xsi:type="CD" />
														</observation>
													</entryRelationship>
													<!-- End Individual Pathology Test Result Status -->
													<!-- Begin REFERENCE RANGE DETAILS -->
													<referenceRange typeCode="REFV">
														<!-- Begin REFERENCE RANGE -->
														<observationRange classCode="OBS" moodCode="EVN.CRT" />
														<!-- End REFERENCE RANGE -->
													</referenceRange>
													<!-- End REFERENCE RANGE DETAILS -->
												</observation>
											</component>
											<!-- Begin Result (INDIVIDUAL PATHOLOGY TEST RESULT) -->
											<!-- Begin Result Group Specimen Detail (SPECIMEN) -->
											<component>
												<observation classCode="OBS" moodCode="EVN"></observation>
											</component>
											<!-- End Result Group Specimen Detail (SPECIMEN) -->
										</organizer>
									</entryRelationship>
									<!-- End Result Group (PATHOLOGY TEST RESULT GROUP) -->
									<!-- Begin TEST REQUEST DETAILS -->
									<entryRelationship inversionInd="true" typeCode="SUBJ">
										<act classCode="ACT" moodCode="EVN" />
									</entryRelationship>
									<!-- End Test TEST REQUEST DETAILS -->
								</observation>
							</entry>
						</section>
					</component>
					<!-- End PATHOLOGY TEST RESULT -->
				</section>
			</component>
			<!-- End DIAGNOSTIC INVESTIGATIONS -->
		</structuredBody>
	</component>
	<!-- End CDA Body -->
CDA;
        $organizer = (new Organizer())
          ->addId(Id::fromString('9BE931D2-F085-11E0-9831-1E7C4824019B'))
          ->setCode(Code::LOINC('18719-5', 'Chemistry studies (set)'))
          ->setStatusCode(StatusCodeElement::Completed())
          ->addComponent(new OrganizerComponent(
            (new Observation(
              Code::LOINC('14682-9', 'Serum Creatinine'),
              (new Value('0.06', XSITypeInterface::PHYSICAL_QUANTITY))
                ->setUnits('mmol/L')
            ))
              ->setClassCode(ClassCodeInterface::OBSERVATION)
              ->setMoodCode(MoodCodeInterface::EVENT)
              ->addId(Id::fromString('3802BA7A-F086-11E0-8A74-147D4824019B'))
              ->addEntryRelationship(new EntryRelationship(
                (new Act())
                  ->setClassCode(ClassCodeInterface::INFORM)
                  ->setMoodCode(MoodCodeInterface::EVENT)
                  ->setCode(Code::SNOMED('281296001', 'result comments'))
                  ->setText(new Text('Within normal range.'))
                , TypeCodeInterface::COMPONENT))
              ->addEntryRelationship((new EntryRelationship(
                (new Act())
                  ->setClassCode(ClassCodeInterface::INFORM)
                  ->setMoodCode(MoodCodeInterface::EVENT)
                  ->setCode(Code::SNOMED('281298000', 'reference range comments'))
                  ->setText((new Text('Within normal range +/- 5%.'))
                    ->setXSIType(XSITypeInterface::CHARACTER_STRING))))
                ->setTypeCode(TypeCodeInterface::COMPONENT))
              ->addEntryRelationship((new EntryRelationship(
                (new Observation(
                  Code::SNOMED('308552006', 'report status'),
                  (new Value('', XSITypeInterface::CONCEPT_DESCRIPTOR))
                    ->setCode('3')
                    ->setCodeSystem('1.2.36.1.2001.1001.101.104.16501')
                    ->setCodeSystemName('NCTIS Result Status Values')
                    ->setDisplayName('Final')
                ))
                  ->setClassCode(ClassCodeInterface::OBSERVATION)
                  ->setMoodCode(MoodCodeInterface::EVENT)
              ))->setTypeCode(TypeCodeInterface::COMPONENT))
              ->returnObservation()
              ->addReferenceRange((new ReferenceRange(
                (new ObservationRange())
                  ->setClassCode(ClassCodeInterface::OBSERVATION)
                  ->setMoodCode(MoodCodeInterface::EVENT_CRITERION)
              ))->setTypeCode(TypeCodeInterface::HAS_REFERENCE_VALUES)
              )
          ))
          ->addComponent(new OrganizerComponent(
            (new Observation())
              ->setMoodCode(MoodCodeInterface::EVENT)
              ->setClassCode(ClassCodeInterface::OBSERVATION)
          ));
        $section   = (new Section())
          ->addComponent(
            (new SingleComponent(
              (new Section())
                ->addEntry((new Entry())
                  ->setTypeCode('')
                  ->setObservation(
                    (new Observation())
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Observation())
                            ->setClassCode(ClassCodeInterface::OBSERVATION)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                        ))
                          ->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                      )
                      ->addEntryRelationship((new EntryRelationship($organizer))
                        ->setTypeCode(TypeCodeInterface::COMPONENT))
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Act())
                            ->setClassCode(ClassCodeInterface::ACT)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                        ))
                          ->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                          ->setInversionInd(true)
                      )
                      ->returnObservation()
                      ->setMoodCode(MoodCodeInterface::EVENT)
                  )
                )// addEntry
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode('')
          );
        $tag       = new RootBodyComponent(
          (new XMLBodyComponent(
            new SingleComponent($section)
          )
          )->setClassCode('')
        );
        $dom       = new \DOMDocument('1.0', 'UTF-8');
        $doc       = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     *
     * Example 7.18. Individual Pathology Test Result Value Reference Ranges (REFERENCE RANGE DETAILS) XML Fragment
     * see page 217 EventSummary_CDAImplementationGuide_v1.3.pdf
     *
     */

    public function test_individual_pathology_test_result()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin PATHOLOGY TEST RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Begin Result Group (PATHOLOGY TEST RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN">
										<!-- Begin Result (INDIVIDUAL PATHOLOGY TEST RESULT) -->
										<component>
											<observation classCode="OBS" moodCode="EVN">
												<!-- Normal Status -->
												<interpretationCode code="N" codeSystemName="HL7 ObservationInterpretationNormality" codeSystem="2.16.840.1.113883.5.83" displayName="Normal" />
												<!-- Begin Individual Pathology Test Result Value Reference Ranges (REFERENCE RANGE DETAILS) -->
												<referenceRange typeCode="REFV">
													<!-- Begin REFERENCE RANGE -->
													<observationRange classCode="OBS" moodCode="EVN.CRT">
														<!-- Reference Range Meaning -->
														<code code="260395002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="normal range" />
														<!-- Begin Reference Range -->
														<value xsi:type="IVL_PQ">
															<low value="0.04" />
															<high value="0.11" />
														</value>
														<!-- End Reference Range -->
													</observationRange>
													<!-- End REFERENCE RANGE -->
												</referenceRange>
												<!-- End Individual Pathology Test Result Value Reference Ranges (REFERENCE RANGE DETAILS) -->
											</observation>
										</component>
										<!-- Begin Result (INDIVIDUAL PATHOLOGY TEST RESULT) -->
									</organizer>
								</entryRelationship>
								<!-- End Result Group (PATHOLOGY TEST RESULT GROUP) -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End PATHOLOGY TEST RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addComponent(
            (new SingleComponent(
              (new Section())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->addEntry((new Entry(
                  (new Observation())
                    ->setClassCode(ClassCodeInterface::OBSERVATION)
                    ->setMoodCode(MoodCodeInterface::EVENT)
                    ->addEntryRelationship(
                      (new EntryRelationship())
                        ->setTypeCode(TypeCodeInterface::COMPONENT)
                        ->setOrganizer(
                          (new Organizer())
                            ->setClassCode(ClassCodeInterface::BATTERY)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                            ->addComponent(
                              new OrganizerComponent(
                                (new Observation())
                                  ->setMoodCode(MoodCodeInterface::EVENT)
                                  ->setClassCode(ClassCodeInterface::OBSERVATION)
                                  ->addInterpretationCode(
                                    new InterpretationCode(
                                      new CodedValue('N', 'Normal',
                                        '2.16.840.1.113883.5.83', 'HL7 ObservationInterpretationNormality'))
                                  )
                                  ->addReferenceRange(
                                    (new ReferenceRange(
                                      (new ObservationRange())
                                        ->setMoodCode(MoodCodeInterface::EVENT_CRITERION)
                                        ->setClassCode(ClassCodeInterface::OBSERVATION)
                                        ->setCode(Code::SNOMED('260395002', 'normal range'))
                                        ->setValue((new Value())
                                          ->setXSIType(XSITypeInterface::INTERVAL_PHYSICAL_QUANTITY)
                                          ->setLow(new Low('0.04'))
                                          ->setHigh(new High('0.11'))
                                        )
                                    ))->setTypeCode(TypeCodeInterface::HAS_REFERENCE_VALUES)
                                  )
                              ))
                        )
                    )))->setTypeCode('')
                )))->setTypeCode(''));

        $tag = new RootBodyComponent( //component
          (new XMLBodyComponent(          // structured body
            new SingleComponent($section) // component
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.19. Result Group Specimen Detail (SPECIMEN) XML Fragment
     * see page 229 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_result_group_specimen_detail()
    {
        $expected  = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin PATHOLOGY TEST RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Begin Result Group (PATHOLOGY TEST RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN">
										<!-- Begin Result (INDIVIDUAL PATHOLOGY TEST RESULT) -->
										<component>
											<observation classCode="OBS" moodCode="EVN"></observation>
										</component>
										<!-- Begin Result (INDIVIDUAL PATHOLOGY TEST RESULT) -->
										<!-- Begin Test Specimen Detail (SPECIMEN) -->
										<component>
											<observation classCode="OBS" moodCode="EVN">
												<!-- ID is used for system purposes such as matching -->
												<id root="CCC0D55C-EFD0-11DF-BEA2-A6CCDFD72085" />
												<code code="102.16156.136.2.2" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Specimen" />
												<!-- Date and Time of Collection (Collection DateTime) -->
												<effectiveTime value="201310201235+1000" />
												<!-- Collection Procedure -->
												<methodCode code="48635004" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fine needle biopsy" />
												<!-- Anatomical Site (ANATOMICAL LOCATION) :: Examples provided of all three allowed variants. These variants are mutually exclusive -->
												<!-- Begin Example with complete SPECIFIC LOCATION -->
												<!-- Begin SPECIFIC LOCATION -->
												<!-- Name of Location (Anatomical Location Name) -->
												<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax">
													<!-- Begin Side -->
													<qualifier>
														<name code="272741003" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Laterality" />
														<value code="7771000" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="left" xsi:type="CD" />
													</qualifier>
													<!-- End Side -->
												</targetSiteCode>
												<!-- End SPECIFIC LOCATION -->
												<!-- End Example with complete SPECIFIC LOCATION -->
												<!-- Begin Example with partial SPECIFIC LOCATION -->
												<!-- Begin SPECIFIC LOCATION -->
												<!-- Name of Location (Anatomical Location Name) -->
												<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax" />
												<!-- End SPECIFIC LOCATION -->
												<!-- End Example with partial SPECIFIC LOCATION -->
												<!-- Begin Example with Description -->
												<targetSiteCode>
													<!-- Description (Anatomical Location Description) -->
													<originalText>Chest/Thorax</originalText>
												</targetSiteCode>
												<!-- End SPECIFIC LOCATION -->
												<!-- End Example with Description -->
												<!-- End Anatomical Site (ANATOMICAL LOCATION) -->
												<!-- Begin Physical Details -->
												<specimen>
													<specimenRole>
														<!-- Specimen Identifier -->
														<id root="1538103e-845b-4f86-95ed-33b62e7589d0" />
														<!-- Begin Physical Details (PHYSICAL PROPERTIES OF AN OBJECT) -->
														<specimenPlayingEntity>
															<!-- Specimen Tissue Type -->
															<code code="258442002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fluid sample" />
															<!-- Begin Weight/Volume -->
															<quantity unit="mL" value="5" />
															<!-- End Weight/Volume -->
															<!-- Begin Description (Object Description) -->
															<desc xsi:type="ST">5 mL</desc>
															<!-- End Description (Object Description) -->
															<!-- Begin Container Identifier -->
															<ext:asSpecimenInContainer classCode="CONT">
																<ext:container>
																	<ext:id extension="CNH45218964" root="CA54FD22-76B8-11E0-AC87-0EE34824019B" />
																</ext:container>
															</ext:asSpecimenInContainer>
															<!-- End Container Identifier -->
														</specimenPlayingEntity>
														<!-- End Physical Details (PHYSICAL PROPERTIES OF AN OBJECT) -->
													</specimenRole>
												</specimen>
												<!-- End Physical Details -->
												<!-- Begin Anatomical Location Image -->
												<entryRelationship typeCode="SPRT">
													<observationMedia classCode="OBS" moodCode="EVN">
														<id root="3953A078-0365-11E1-B90D-41D04724019B" />
														<value mediaType="image/jpeg" >
															<reference value="location.jpeg" />
														</value>
													</observationMedia>
												</entryRelationship>
												<!-- End Anatomical Location Image -->
												<!-- Begin Image -->
												<entryRelationship typeCode="SPRT">
													<observationMedia classCode="OBS" moodCode="EVN">
														<id root="1d64bb51-c5b3-4048-9a9f-e753f4e3c203" />
														<value mediaType="image/jpeg" >
															<reference value="specimen.jpeg" />
														</value>
													</observationMedia>
												</entryRelationship>
												<!-- End Image -->
												<!-- Begin Sampling Preconditions -->
												<entryRelationship typeCode="COMP">
													<observation classCode="OBS" moodCode="EVN">
														<code code="103.16171" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Sampling Preconditions" />
														<value code="16985007" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Fasting" xsi:type="CD" />
													</observation>
												</entryRelationship>
												<!-- End Sampling Preconditions -->
												<!-- Begin Collection Setting -->
												<entryRelationship typeCode="COMP">
													<observation classCode="OBS" moodCode="EVN">
														<code code="103.16529" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Collection Setting" />
														<value xsi:type="ST">Pathology Clinic</value>
													</observation>
												</entryRelationship>
												<!-- End Collection Setting -->
												<!-- Begin Date and Time of Receipt (DateTime Received) -->
												<entryRelationship typeCode="COMP">
													<observation classCode="OBS" moodCode="EVN">
														<code code="103.11014" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="DateTime Received" />
														<value value="201112141120+1000" xsi:type="TS" />
													</observation>
												</entryRelationship>
												<!-- End Date and Time of Receipt (DateTime Received) -->
												<!-- Begin Parent Specimen Identifier -->
												<entryRelationship typeCode="COMP">
													<observation classCode="OBS" moodCode="EVN">
                            <code code="103.16187" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Parent Specimen Identifier" />
													<specimen>
														<specimenRole>
															<id root="7013b12a-f9d0-4197-9726-88a6803d4d13" />
														</specimenRole>
													</specimen>
												</observation>
											</entryRelationship>
											<!-- End Parent Specimen Identifier -->
										</observation>
									</component>
									<!-- End Test Specimen Detail (SPECIMEN) -->
								</organizer>
							</entryRelationship>
							<!-- End Result Group (PATHOLOGY TEST RESULT GROUP) -->
						</observation>
					</entry>
				</section>
			</component>
			<!-- End PATHOLOGY TEST RESULT -->
		</section>
	</component>
	<!-- End DIAGNOSTIC INVESTIGATIONS -->
</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $organizer = (new Organizer())
          ->addComponent(new OrganizerComponent(
            (new Observation())
              ->setClassCode(ClassCodeInterface::OBSERVATION)
              ->setMoodCode(MoodCodeInterface::EVENT)
          ))
          ->addComponent(new OrganizerComponent(
              (new Observation(Code::NCTIS('102.16156.136.2.2', 'Specimen')))
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addId(Id::fromString('CCC0D55C-EFD0-11DF-BEA2-A6CCDFD72085'))
                ->setEffectiveTime(TimeStamp::fromString('2013-10-20 12:35', '+1000'))
                ->returnObservation()
                ->addMethodCode(MethodCode::SNOMED('48635004', 'Fine needle biopsy'))
                ->addTargetSiteCode(
                  TargetSiteCode::SNOMED('51185008', 'thorax')
                    ->setQualifier(new Qualifier(
                      Name::SNOMED('272741003', 'Laterality'),
                      Value::SNOMED('7771000', 'left', XSITypeInterface::CONCEPT_DESCRIPTOR)
                    ))
                )
                ->addTargetSiteCode(TargetSiteCode::SNOMED('51185008', 'thorax'))
                ->addTargetSiteCode(
                  (new TargetSiteCode())
                    ->setOriginalText(OriginalText::fromString('Chest/Thorax'))
                    ->returnTargetSiteCode()
                )
                ->addSpecimen(new Specimen(
                  (new SpecimenRole(
                    (new SpecimenPlayingEntity())
                      ->setClassCode('')
                      ->setCode(Code::SNOMED('258442002', 'Fluid sample'))
                      ->addQuantity(Quantity::fromString('mL', '5'))
                      ->setDesc(Desc::fromString('5 mL', XSITypeInterface::CHARACTER_STRING))
                      ->returnSpecimenPlayingEntity()
                      ->setExtAsSpecimenInContainer(
                        (new ExtAsSpecimenInContainer(
                          new ExtContainer(
                            ExtId::fromString('CA54FD22-76B8-11E0-AC87-0EE34824019B', 'CNH45218964')
                          )
                        ))
                          ->setClassCode(ClassCodeInterface::CONTAINER)
                      )
                  ))->addId(Id::fromString('1538103e-845b-4f86-95ed-33b62e7589d0'))
                    ->returnSpecimenRole()

                ))
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new ObservationMedia())
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                      ->addId(Id::fromString('3953A078-0365-11E1-B90D-41D04724019B'))
                      ->setValue((new Value())
                        ->setMediaType(MediaTypeInterface::IMAGE_JPEG)
                        ->setReferenceElement(new ReferenceElement('location.jpeg'))
                      )
                  ))->setTypeCode(TypeCodeInterface::HAS_SUPPORT)
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new ObservationMedia())
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                      ->addId(Id::fromString('1d64bb51-c5b3-4048-9a9f-e753f4e3c203'))
                      ->setValue((new Value())
                        ->setMediaType(MediaTypeInterface::IMAGE_JPEG)
                        ->setReferenceElement(new ReferenceElement('specimen.jpeg'))
                      )
                  ))->setTypeCode(TypeCodeInterface::HAS_SUPPORT)
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Observation(
                      Code::NCTIS('103.16171', 'Sampling Preconditions'),
                      Value::SNOMED('16985007', 'Fasting', true)
                    ))
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::EVENT)

                  ))->setTypeCode(TypeCodeInterface::COMPONENT)
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Observation(
                      Code::NCTIS('103.16529', 'Collection Setting'),
                      (new Value())
                        ->setXSIType(XSITypeInterface::CHARACTER_STRING)
                        ->setContent('Pathology Clinic')
                    ))
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::EVENT)

                  ))->setTypeCode(TypeCodeInterface::COMPONENT)
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Observation(
                      Code::NCTIS('103.11014', 'DateTime Received'),
                      new Value('201112141120+1000', XSITypeInterface::TIMESTAMP)
                    ))
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::EVENT)

                  ))->setTypeCode(TypeCodeInterface::COMPONENT)
                )
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Observation(
                      Code::NCTIS('103.16187', 'Parent Specimen Identifier')
                    ))
                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                      ->addSpecimen(
                        new Specimen(
                          (new SpecimenRole())
                            ->addId(Id::fromString('7013b12a-f9d0-4197-9726-88a6803d4d13'))
                            ->returnSpecimenRole()
                        ))
                  ))->setTypeCode(TypeCodeInterface::COMPONENT)
                )

            )
          );

        $section = (new Section())
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addComponent(
            (new SingleComponent(
              (new Section())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->addEntry((new Entry(
                  (new Observation())
                    ->setClassCode(ClassCodeInterface::OBSERVATION)
                    ->setMoodCode(MoodCodeInterface::EVENT)
                    ->addEntryRelationship(
                      (new EntryRelationship())
                        ->setTypeCode(TypeCodeInterface::COMPONENT)
                        ->setOrganizer($organizer)
                    )
                ))->setTypeCode(''))
            ))->setTypeCode(''));
        $tag     = new RootBodyComponent( //component
          (new XMLBodyComponent(          // structured body
            new SingleComponent($section) // component
          )
          )->setClassCode('')
        );
        $dom     = new \DOMDocument('1.0', 'UTF-8');
        $doc     = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.20. IMAGING EXAMINATION RESULT XML Fragment
     * see page 242 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_imaging_examination_result()
    {
        $expected = <<< CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin IMAGING EXAMINATION RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<!-- Imaging Examination Result Instance Identifier -->
						<id root="50006572-EFC7-11E0-8337-65094924019B" />
						<!-- Detailed Clinical Model Identifier -->
						<code code="102.16145" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Imaging Examination Result" />
						<title>Imaging Examination Result</title>
						<!-- Begin Narrative Text -->
						<text>
							<table>
								<thead>
									<tr>
										<th>Imaging Examination</th>
										<th>Modality</th>
										<th>Status</th>
										<th>Anatomical Location</th>
										<th>Examination Procedure</th>
										<th>Date of Image</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Chest X-ray</td>
										<td>x-ray</td>
										<td>Left, Chest</td>
										<td>Final results; results stored and verified. Can only be changed with a corrected result.</td>
										<td>The examination was carried out using the particular procedure.</td>
										<td>20th October 2013</td>
									</tr>
								</tbody>
							</table>
							<paragraph>
								<linkHtml href="imagingresult.pdf">Attached Imaging Result</linkHtml>
							</paragraph>
						</text>
						<!-- End Narrative Text -->
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- ID is used for system purposes such as matching -->
								<id root="CCF0D55C-EFD0-10DF-BEA2-A6CCDFD72085" />
								<!-- Examination Result Name (Imaging Examination Result Name) -->
								<code code="399208008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="chest x-ray" />
								<!-- Begin Examination Result Representation -->
								<text mediaType="application/pdf">
									<reference value="imagingresult.pdf" />
								</text>
								<!-- End Examination Result Representation -->
								<!-- Imaging Modality -->
								<methodCode code="363680008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="x-ray" />
								<!-- NOTE: The instance of Anatomical Site (ANATOMICAL LOCATION) has been duplicated at the Examination Group level for illustrative purposes only. -->
								<!-- Anatomical Site (ANATOMICAL LOCATION) :: Examples provided of all three allowed variants. These variants are mutually exclusive -->
								<!-- Begin Example with complete SPECIFIC LOCATION -->
								<!-- Begin SPECIFIC LOCATION -->
								<!-- Name of Location (Anatomical Location Name) -->
								<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax">
									<!-- Begin Side -->
									<qualifier>
										<name code="272741003" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Laterality" />
										<value code="7771000" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="left" xsi:type="CD" />
									</qualifier>
									<!-- End Side -->
								</targetSiteCode>
								<!-- End SPECIFIC LOCATION -->
								<!-- End Example with complete SPECIFIC LOCATION -->
								<!-- Begin Example with partial SPECIFIC LOCATION -->
								<!-- Begin SPECIFIC LOCATION -->
								<!-- Name of Location (Anatomical Location Name) -->
								<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax" />
								<!-- End SPECIFIC LOCATION -->
								<!-- End Example with partial SPECIFIC LOCATION -->
								<!-- Begin Example with Description -->
								<targetSiteCode>
									<!-- Description (Anatomical Location Description) -->
									<originalText>Chest/Thorax</originalText>
								</targetSiteCode>
								<!-- End SPECIFIC LOCATION -->
								<!-- End Example with Description -->
								<!-- End Anatomical Site (ANATOMICAL LOCATION) -->
								<!-- Begin Anatomical Location Image -->
								<entryRelationship typeCode="REFR">
									<observationMedia classCode="OBS" moodCode="EVN">
										<id root="e66fef7e-0d84-45d7-bb38-f12adb16d9cb" />
										<value mediaType="image/jpeg" xsi:type="ED">
											<reference value="location.jpeg" />
										</value>
									</observationMedia>
								</entryRelationship>
								<!-- End Anatomical Location Image -->
								<!-- Begin Imaging Examination Result Status -->
								<entryRelationship typeCode="COMP">
									<observation classCode="OBS" moodCode="EVN">
										<!-- ID is used for system purposes such as matching -->
										<id root="e4691ff9-acee-4d6a-9db6-0318a400bd72" />
										<code code="308552006" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="report status" />
										<value code="F" codeSystem="2.16.840.1.113883.12.123" codeSystemName="HL7 Result Status" displayName="Final results; results stored and verified. Can only be changed with a corrected result." xsi:type="CD" />
									</observation>
								</entryRelationship>
								<!-- End Imaging Examination Result Status -->
								<!-- Begin Clinical Information Provided -->
								<entryRelationship typeCode="COMP">
									<act classCode="INFRM" moodCode="EVN">
										<code code="55752-0" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Clinical information" />
										<text xsi:type="ST">Fluid Retention.</text>
									</act>
								</entryRelationship>
								<!-- End Clinical Information Provided -->
								<!-- Begin Findings -->
								<entryRelationship typeCode="REFR">
									<observation classCode="OBS" moodCode="EVN">
										<id root="D1ECC286-F093-11E0-9BC8-508D4824019B" />
										<code code="103.16503" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Findings" />
										<text xsi:type="ST">The lungs and pleura appear clear. Cardiac and mediastinal contours are within normal limits.</text>
									</observation>
								</entryRelationship>
								<!-- End Findings -->
								<!-- Begin Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN" />
								</entryRelationship>
								<!-- End Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<!-- Begin EXAMINATION REQUEST DETAILS -->
								<entryRelationship inversionInd="true" typeCode="SUBJ">
									<act classCode="ACT" moodCode="EVN" />
								</entryRelationship>
								<!-- End EXAMINATION REQUEST DETAILS -->
								<!-- Begin Observation DateTime -->
								<entryRelationship typeCode="COMP">
									<observation classCode="OBS" moodCode="EVN">
										<code code="103.16589" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Imaging Examination Result DateTime" />
										<effectiveTime value="201310201235+1000" />
									</observation>
								</entryRelationship>
								<!-- End Observation DateTime -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End IMAGING EXAMINATION RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;

        $section = (new Section())
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addComponent(
            (new SingleComponent(
              (new Section())
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setId(id::fromString('50006572-EFC7-11E0-8337-65094924019B'))
                ->setCode(Code::NCTIS('102.16145', 'Imaging Examination Result'))
                ->setTitle(Title::fromString('Imaging Examination Result'))
                ->setText((new Text(
                  (new Table())
                    ->getThead()
                    ->createRow()
                    ->createCell('Imaging Examination')->getRow()
                    ->createCell('Modality')->getRow()
                    ->createCell('Status')->getRow()
                    ->createCell('Anatomical Location')->getRow()
                    ->createCell('Examination Procedure')->getRow()
                    ->createCell('Date of Image')->getRow()
                    ->getSection()
                    ->getTable()
                    ->getTbody()
                    ->createRow()
                    ->createCell('Chest X-ray')->getRow()
                    ->createCell('x-ray')->getRow()
                    ->createCell('Left, Chest')->getRow()
                    ->createCell('Final results; results stored and verified. Can only be changed with a corrected result.')->getRow()
                    ->createCell('The examination was carried out using the particular procedure.')->getRow()
                    ->createCell('20th October 2013')->getRow()
                    ->getSection()
                    ->getTable()
                ))
                  ->addTag(
                    new Paragraph(
                      new LinkHtml('Attached Imaging Result', 'imagingresult.pdf')))
                  ->returnText()
                )
                ->addEntry((new Entry(
                  (new Observation(Code::SNOMED('399208008', 'chest x-ray')))
                    ->setMoodCode(MoodCodeInterface::EVENT)
                    ->addId(Id::fromString('CCF0D55C-EFD0-10DF-BEA2-A6CCDFD72085'))
                    ->setText(
                      (new Text(
                        (new ReferenceElement())
                          ->setValue('imagingresult.pdf')
                      ))->setMediaType(MediaTypeInterface::APPLICATION_PDF)
                    )
                    ->returnObservation()
                    ->addMethodCode(MethodCode::SNOMED('363680008', 'x-ray'))
                    ->addTargetSiteCode(
                      TargetSiteCode::SNOMED('51185008', 'thorax')
                        ->setQualifier(new Qualifier(
                          Name::SNOMED('272741003', 'Laterality'),
                          Value::SNOMED('7771000', 'left', XSITypeInterface::CONCEPT_DESCRIPTOR)
                        ))
                    )
                    ->addTargetSiteCode(TargetSiteCode::SNOMED('51185008', 'thorax'))
                    ->addTargetSiteCode(
                      (new TargetSiteCode())
                        ->setOriginalText(new OriginalText('Chest/Thorax'))
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        (new ObservationMedia())
                          ->setClassCode(ClassCodeInterface::OBSERVATION)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->addId(Id::fromString('e66fef7e-0d84-45d7-bb38-f12adb16d9cb'))
                          ->setValue(
                            (new Value())
                              ->setMediaType(MediaTypeInterface::IMAGE_JPEG)
                              ->setXSIType(XSITypeInterface::ENCAPSULATED_DATA)
                              ->setReferenceElement(new ReferenceElement('location.jpeg'))
                          )
                      ))
                        ->setTypeCode(TypeCodeInterface::REFERS_TO)
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        (new Observation(
                          Code::SNOMED('308552006', 'report status'),
                          Value::HL7ResultStatus('F', 'Final results; results stored and verified. Can only be changed with a corrected result.')
                        ))
                          ->setClassCode(ClassCodeInterface::OBSERVATION)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->addId(Id::fromString('e4691ff9-acee-4d6a-9db6-0318a400bd72'))
                      ))->setTypeCode(TypeCodeInterface::COMPONENT)
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        (new Act())
                          ->setClassCode(ClassCodeInterface::INFORM)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->setCode(Code::LOINC('55752-0', 'Clinical information'))
                          ->setText((new Text('Fluid Retention.'))->setXSIType(XSITypeInterface::CHARACTER_STRING))
                      ))->setTypeCode(TypeCodeInterface::COMPONENT)
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        (new Observation())
                          ->setClassCode(ClassCodeInterface::OBSERVATION)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->addId(Id::fromString('D1ECC286-F093-11E0-9BC8-508D4824019B'))
                          ->setCode(Code::NCTIS('103.16503', 'Findings'))
                          ->setText((new Text('The lungs and pleura appear clear. Cardiac and mediastinal contours are within normal limits.'))->setXSIType(XSITypeInterface::CHARACTER_STRING))
                      ))->setTypeCode(TypeCodeInterface::REFERS_TO)
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        new Organizer()
                      ))->setTypeCode(TypeCodeInterface::COMPONENT)
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        (new Act())
                          ->setClassCode(ClassCodeInterface::ACT)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                      ))->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                        ->setInversionInd(true)
                    )
                    ->addEntryRelationship(
                      (new EntryRelationship(
                        (new Observation())
                          ->setClassCode(ClassCodeInterface::OBSERVATION)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->setCode(Code::NCTIS('103.16589', 'Imaging Examination Result DateTime'))
                          ->setEffectiveTime(TimeStamp::fromString('2013-10-20 12:35', '+1000'))
                      ))->setTypeCode(TypeCodeInterface::COMPONENT)
                    )


                ))->setTypeCode(''))

            ))->setTypeCode(''));
        $tag     = new RootBodyComponent(     //component
          (new XMLBodyComponent(          // structured body
            new SingleComponent($section) // component
          )
          )->setClassCode('')
        );
        $dom     = new \DOMDocument('1.0', 'UTF-8');
        $doc     = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.21. Result Group (IMAGING EXAMINATION RESULT GROUP) XML Fragment
     * see page 254 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_result_group_imaging_examination_result_group()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin IMAGING EXAMINATION RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Begin Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN">
										<id root="061116F4-F097-11E0-BF4C-10914824019B" />
										<!-- Imaging Examination Result Group Name -->
										<code code="399208008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="chest x-ray" />
										<statusCode code="completed" />
										<!-- Begin Result (INDIVIDUAL IMAGING EXAMINATION RESULT) -->
										<component>
											<observation classCode="OBS" moodCode="EVN">
												<id root="2C600DDA-F09A-11E0-9BDE-8D944824019B" />
												<!-- Individual Imaging Examination Result Name -->
												<code nullFlavor="UNK">
													<originalText>Cardiothoricic Ratio</originalText>
												</code>
												<!-- Result Value (IMAGING EXAMINATION RESULT VALUE))-->
												<value value="0.45" xsi:type="PQ" />
												<!-- Anatomical Site (ANATOMICAL LOCATION) :: Examples provided of all three allowed variants. These variants are mutually exclusive -->
												<!-- Begin Example with complete SPECIFIC LOCATION -->
												<!-- Begin SPECIFIC LOCATION -->
												<!-- Name of Location (Anatomical Location Name) -->
												<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax">
													<!-- Begin Side -->
													<qualifier>
														<name code="272741003" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Laterality" />
														<value code="7771000" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="left" xsi:type="CD" />
													</qualifier>
													<!-- End Side -->
												</targetSiteCode>
												<!-- End SPECIFIC LOCATION -->
												<!-- End Example with complete SPECIFIC LOCATION -->
												<!-- Begin Example with partial SPECIFIC LOCATION -->
												<!-- Begin SPECIFIC LOCATION -->
												<!-- Name of Location (Anatomical Location Name) -->
												<targetSiteCode code="51185008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="thorax" />
												<!-- End SPECIFIC LOCATION -->
												<!-- End Example with partial SPECIFIC LOCATION -->
												<!-- Begin Example with Description -->
												<targetSiteCode>
													<!-- Description (Anatomical Location Description) -->
													<originalText>Chest/Thorax</originalText>
												</targetSiteCode>
												<!-- End SPECIFIC LOCATION -->
												<!-- End Example with Description -->
												<!-- End Anatomical Site (ANATOMICAL LOCATION) -->
												<!-- Begin Anatomical Location Image -->
												<entryRelationship typeCode="REFR">
													<observationMedia classCode="OBS" moodCode="EVN">
														<id root="218F125E-F304-11E0-99C9-46DC4824019B" />
														<value mediaType="image/jpeg" xsi:type="ED">
															<reference value="location.jpeg" />
														</value>
													</observationMedia>
												</entryRelationship>
												<!-- End Anatomical Location Image -->
												<!-- Begin Result Comment -->
												<entryRelationship typeCode="COMP">
													<act classCode="INFRM" moodCode="EVN">
														<code code="281296001" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="result comments" />
														<text>CTR within normal limits.</text>
													</act>
												</entryRelationship>
												<!-- End Result Comment -->
												<!-- Begin Imaging Examination Result Value Reference Ranges (REFERENCE RANGE DETAILS) -->
												<referenceRange typeCode="REFV">
													<!-- Begin REFERENCE RANGE -->
													<observationRange classCode="OBS" moodCode="EVN.CRT" />
													<!-- End REFERENCE RANGE -->
												</referenceRange>
												<!-- End Imaging Examination Result Value Reference Ranges (REFERENCE RANGE DETAILS) -->
											</observation>
										</component>
										<!-- End Result (INDIVIDUAL IMAGING EXAMINATION RESULT) -->
									</organizer>
								</entryRelationship>
								<!-- End Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<!-- Begin EXAMINATION REQUEST DETAILS -->
								<entryRelationship inversionInd="true" typeCode="SUBJ">
									<act classCode="ACT" moodCode="EVN" />
								</entryRelationship>
								<!-- End EXAMINATION REQUEST DETAILS -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End IMAGING EXAMINATION RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry(
            (new Entry(
              (new Observation())
                ->setClassCode(ClassCodeInterface::OBSERVATION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addEntryRelationship(
                  (new EntryRelationship())
                    ->setTypeCode(TypeCodeInterface::COMPONENT)
                    ->setOrganizer(
                      (new Organizer())
                        ->addId(Id::fromString('061116F4-F097-11E0-BF4C-10914824019B'))
                        ->setCode(Code::SNOMED('399208008', 'chest x-ray'))
                        ->setStatusCode(StatusCodeElement::Completed())
                        ->addComponent(
                          new OrganizerComponent(
                            (new Observation(
                              (new Code())
                                ->setNullFlavour(NullFlavourInterface::Unknown)
                                ->setOriginalText(new OriginalText('Cardiothoricic Ratio')),
                              new Value('0.45', XSITypeInterface::PHYSICAL_QUANTITY)
                            ))
                              ->setMoodCode(MoodCodeInterface::EVENT)
                              ->addId(Id::fromString('2C600DDA-F09A-11E0-9BDE-8D944824019B'))
                              ->returnObservation()
                              ->addTargetSiteCode(
                                TargetSiteCode::SNOMED('51185008', 'thorax')
                                  ->setQualifier(new Qualifier(
                                    Name::SNOMED('272741003', 'Laterality'),
                                    Value::SNOMED('7771000', 'left')
                                  ))
                              )
                              ->addTargetSiteCode(TargetSiteCode::SNOMED('51185008', 'thorax'))
                              ->addTargetSiteCode(
                                (new TargetSiteCode())->setOriginalText(new OriginalText('Chest/Thorax'))
                                  ->returnTargetSiteCode()
                              )
                              ->addEntryRelationship(
                                (new EntryRelationship(
                                  (new ObservationMedia())
                                    ->setClassCode(ClassCodeInterface::OBSERVATION)
                                    ->setMoodCode(MoodCodeInterface::EVENT)
                                    ->addId(Id::fromString('218F125E-F304-11E0-99C9-46DC4824019B'))
                                    ->setValue(
                                      (new Value())
                                        ->setMediaType(MediaTypeInterface::IMAGE_JPEG)
                                        ->setXSIType(XSITypeInterface::ENCAPSULATED_DATA)
                                        ->setReferenceElement(new ReferenceElement('location.jpeg'))
                                    )
                                ))->setTypeCode(TypeCodeInterface::REFERS_TO)
                              )
                              ->addEntryRelationship(
                                (new EntryRelationship(
                                  (new Act())
                                    ->setClassCode(ClassCodeInterface::INFORM)
                                    ->setMoodCode(MoodCodeInterface::EVENT)
                                    ->setCode(Code::SNOMED('281296001', 'result comments'))
                                    ->setText(new Text('CTR within normal limits.'))
                                ))
                                  ->setTypeCode(TypeCodeInterface::COMPONENT)
                              )
                              ->returnObservation()
                              ->addReferenceRange(
                                (new ReferenceRange(
                                  (new ObservationRange())
                                    ->setClassCode(ClassCodeInterface::OBSERVATION)
                                    ->setMoodCode(MoodCodeInterface::EVENT_CRITERION)
                                ))
                                  ->setTypeCode(TypeCodeInterface::HAS_REFERENCE_VALUES)
                              )
                          )) // component
                    ) // organizer
                )// entry relationship
                ->addEntryRelationship(
                  (new EntryRelationship(
                    (new Act())
                      ->setClassCode(ClassCodeInterface::ACT)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                  ))
                    ->setInversionInd(true)
                    ->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                )
            ))
              ->setTypeCode(''));

        $tag = new RootBodyComponent(     // component
          (new XMLBodyComponent(              // structured body
            (new SingleComponent())// component
            ->addSection(
              (new Section())
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addComponent(
                  (new SingleComponent())
                    ->setTypeCode('')
                    ->addSection($section)
                )
            )
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }


    /**
     * Example 7.22. Imaging Examination Result Value Reference Ranges (REFERENCE RANGE DETAILS) XML Fragment
     * see page 260 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_imaging_examination_result_value_reference_ranges()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin IMAGING EXAMINATION RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Begin Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN">
										<!-- Begin Result (INDIVIDUAL IMAGING EXAMINATION RESULT) -->
										<component>
											<observation classCode="OBS" moodCode="EVN">
												<!-- Normal Status -->
												<interpretationCode code="N" codeSystemName="HL7 ObservationInterpretationNormality" codeSystem="2.16.840.1.113883.5.83"
displayName="Normal" />
												<!-- Begin Imaging Examination Result Value Reference Ranges (REFERENCE RANGE DETAILS) -->
												<referenceRange typeCode="REFV">
													<!-- Begin REFERENCE RANGE -->
													<observationRange classCode="OBS" moodCode="EVN.CRT">
														<!-- Begin Reference Range Meaning -->
														<code code="260395002" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="normal range" />
														<!-- End Reference Range Meaning -->
														<!-- Begin Reference Range -->
														<value xsi:type="IVL_PQ">
															<low value="0.25" />
															<high value="0.50" />
														</value>
														<!-- End Reference Range -->
													</observationRange>
													<!-- End REFERENCE RANGE -->
												</referenceRange>
												<!-- End Imaging Examination Result Value Reference Ranges (REFERENCE RANGE DETAILS) -->
											</observation>
										</component>
										<!-- End Result (INDIVIDUAL IMAGING EXAMINATION RESULT) -->
									</organizer>
								</entryRelationship>
								<!-- End Result Group (IMAGING EXAMINATION RESULT GROUP) -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End IMAGING EXAMINATION RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT)
          ->addEntry(
            (new Entry())
              ->setTypeCode('')
              ->setObservation(
                (new Observation())
                  ->setClassCode(ClassCodeInterface::OBSERVATION)
                  ->setMoodCode(MoodCodeInterface::EVENT)
                  ->addEntryRelationship(
                    (new EntryRelationship())
                      ->setTypeCode(TypeCodeInterface::COMPONENT)
                      ->setOrganizer(
                        (new Organizer())
                          ->addComponent(
                            (new OrganizerComponent(
                              (new Observation())
                                ->setClassCode(ClassCodeInterface::OBSERVATION)
                                ->setMoodCode(MoodCodeInterface::EVENT)
                                ->addInterpretationCode(
                                  new InterpretationCode(
                                    new CodedValue('N', 'Normal', '2.16.840.1.113883.5.83', 'HL7 ObservationInterpretationNormality')
                                  )
                                )
                                ->addReferenceRange(
                                  (new ReferenceRange(
                                    (new ObservationRange())
                                      ->setClassCode(ClassCodeInterface::OBSERVATION)
                                      ->setMoodCode(MoodCodeInterface::EVENT_CRITERION)
                                      ->setCode(Code::SNOMED('260395002', 'normal range'))
                                      ->setValue(
                                        (new Value())
                                          ->setXSIType(XSITypeInterface::INTERVAL_PHYSICAL_QUANTITY)
                                          ->setLow(new Low('0.25'))
                                          ->setHigh(new High('0.50'))
                                      )
                                  ))
                                    ->setTypeCode(TypeCodeInterface::HAS_REFERENCE_VALUES)
                                )
                            ))->setTypeCode('')
                          )
                      )
                  )
                  ->returnObservation()
              )
          );
        $tag      = new RootBodyComponent(     // component
          (new XMLBodyComponent(              // structured body
            (new SingleComponent())// component
            ->addSection(
              (new Section())
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addComponent(
                  (new SingleComponent())
                    ->setTypeCode('')
                    ->addSection($section)
                )
            )
          )
          )->setClassCode('')
        );
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.23. EXAMINATION REQUEST DETAILS XML Fragment
     * see page 271 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_examination_request_details()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin IMAGING EXAMINATION RESULT -->
				<component>
					<section classCode="DOCSECT" moodCode="EVN">
						<entry>
							<observation classCode="OBS" moodCode="EVN">
								<!-- Begin Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<entryRelationship typeCode="COMP">
									<organizer classCode="BATTERY" moodCode="EVN" />
								</entryRelationship>
								<!-- End Result Group (IMAGING EXAMINATION RESULT GROUP) -->
								<!-- Begin EXAMINATION REQUEST DETAILS -->
								<entryRelationship inversionInd="true" typeCode="SUBJ">
									<act classCode="ACT" moodCode="EVN">
										<code code="102.16511" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Examination Request Details" />
										<!-- Begin Examination Requested Name -->
										<entryRelationship typeCode="REFR">
											<observation classCode="OBS" moodCode="EVN">
												<code code="103.16512" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Examination Requested Name" />
												<text xsi:type="ST">Chest X-ray</text>
											</observation>
										</entryRelationship>
										<!-- End Examination Requested Name -->
										<!-- Begin DICOM Study Identifier -->
										<entryRelationship typeCode="SUBJ">
											<act classCode="ACT" moodCode="EVN">
												<id root="1.2.312.1264.124654654.12456456301" />
												<code code="103.16513" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="DICOM Study Identifier" />
												<!-- Begin IMAGE DETAILS -->
												<entryRelationship typeCode="COMP">
													<observation classCode="OBS" moodCode="EVN">
														<!-- Image Identifier -->
														<id root="1.2.3.4.5.123654789654" />
														<code code="102.16515" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Image Details" />
														<!-- Image DateTime -->
														<effectiveTime value="201012141120+1000" />
														<!-- Image View Name -->
														<value code="67632007" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="diagnostic radiography of chest, PA" xsi:type="CD" />
														<!-- Begin DICOM Series Identifier -->
														<entryRelationship typeCode="REFR">
															<act classCode="ACT" moodCode="EVN">
																<id root="1.2.3.1.2.2654654654654564" />
																<code code="103.16517" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="DICOM Series Identifier" />
															</act>
														</entryRelationship>
														<!-- End DICOM Series Identifier -->
														<!-- Begin Subject Position -->
														<entryRelationship typeCode="REFR">
															<observation classCode="OBS" moodCode="EVN">
																<code code="103.16519" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Subject Position" />
																<value xsi:type="ST">PA Erect</value>
															</observation>
														</entryRelationship>
														<!-- End Subject Position -->
														<!-- Begin Image -->
														<entryRelationship typeCode="SPRT">
															<observationMedia classCode="OBS" moodCode="EVN">
																<id root="CD85BBA8-F2E6-11E0-B5BD-9FB84824019B" />
																<value mediaType="image/jpeg" xsi:type="ED">
																	<reference value="xray.jpeg" />
																</value>
															</observationMedia>
														</entryRelationship>
														<!-- End Image -->
													</observation>
												</entryRelationship>
												<!-- End IMAGE DETAILS -->
											</act>
										</entryRelationship>
										<!-- End DICOM Study Identifier -->
										<!-- Begin Report Identifier -->
										<entryRelationship typeCode="COMP">
											<observation classCode="OBS" moodCode="EVN">
												<id root="DDB50F06-F304-11E0-A7F3-5ADD4824019B" />
												<code code="103.16514" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Report Identifier" />
											</observation>
										</entryRelationship>
										<!-- End Report Identifier -->
									</act>
								</entryRelationship>
								<!-- End EXAMINATION REQUEST DETAILS -->
							</observation>
						</entry>
					</section>
				</component>
				<!-- End IMAGING EXAMINATION RESULT -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->

CDA;

        $section = (new Section())
          ->addEntry((new Entry(
            (new Observation())
              ->setClassCode(ClassCodeInterface::OBSERVATION)
              ->setMoodCode(MoodCodeInterface::EVENT)
              ->addEntryRelationship(
                (new EntryRelationship())
                  ->setTypeCode(TypeCodeInterface::COMPONENT)
                  ->setOrganizer(new Organizer())
              )
              ->addEntryRelationship(
                (new EntryRelationship())
                  ->setInversionInd(true)
                  ->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                  ->setAct(
                    (new Act())
                      ->setClassCode(ClassCodeInterface::ACT)
                      ->setMoodCode(MoodCodeInterface::EVENT)
                      ->setCode(Code::NCTIS('102.16511', 'Examination Request Details'))
                      ->addEntryRelationship(
                        (new EntryRelationship())
                          ->setTypeCode(TypeCodeInterface::REFERS_TO)
                          ->setObservation(
                            (new Observation(
                              Code::NCTIS('103.16512', 'Examination Requested Name')
                            ))
                              ->setClassCode(ClassCodeInterface::OBSERVATION)
                              ->setMoodCode(MoodCodeInterface::EVENT)
                              ->setText(
                                (new Text('Chest X-ray'))
                                  ->setXSIType(XSITypeInterface::CHARACTER_STRING)
                              )
                          )
                      )
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Act())
                            ->setClassCode(ClassCodeInterface::ACT)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                            ->addId(Id::fromString('1.2.312.1264.124654654.12456456301'))
                            ->setCode(Code::NCTIS('103.16513', 'DICOM Study Identifier'))
                            ->addEntryRelationship(
                              (new EntryRelationship())
                                ->setTypeCode(TypeCodeInterface::COMPONENT)
                                ->setObservation(
                                  (new Observation(
                                    Code::NCTIS('102.16515', 'Image Details'),
                                    Value::SNOMED('67632007', 'diagnostic radiography of chest, PA')
                                  ))
                                    ->setClassCode(ClassCodeInterface::OBSERVATION)
                                    ->setMoodCode(MoodCodeInterface::EVENT)
                                    ->addId(Id::fromString('1.2.3.4.5.123654789654'))
                                    ->setEffectiveTime(TimeStamp::fromString('2010-12-14 11:20', '+1000'))
                                    ->addEntryRelationship(
                                      (new EntryRelationship())
                                        ->setTypeCode(TypeCodeInterface::REFERS_TO)
                                        ->setAct(
                                          (new Act())
                                            ->setClassCode(ClassCodeInterface::ACT)
                                            ->setMoodCode(MoodCodeInterface::EVENT)
                                            ->addId(Id::fromString('1.2.3.1.2.2654654654654564'))
                                            ->setCode(Code::NCTIS('103.16517', 'DICOM Series Identifier'))
                                        )
                                    )
                                    ->addEntryRelationship(
                                      (new EntryRelationship())
                                        ->setTypeCode(TypeCodeInterface::REFERS_TO)
                                        ->setObservation(
                                          (new Observation(
                                            Code::NCTIS('103.16519', 'Subject Position'),
                                            (new Value())
                                              ->setContent('PA Erect')
                                              ->setXSIType(XSITypeInterface::CHARACTER_STRING)
                                          ))
                                            ->setClassCode(ClassCodeInterface::OBSERVATION)
                                            ->setMoodCode(MoodCodeInterface::EVENT)
                                        )
                                    )
                                    ->addEntryRelationship(
                                      (new EntryRelationship())
                                        ->setTypeCode(TypeCodeInterface::HAS_SUPPORT)
                                        ->setObservationMedia(
                                          (new ObservationMedia())
                                            ->setClassCode(ClassCodeInterface::OBSERVATION)
                                            ->setMoodCode(MoodCodeInterface::EVENT)
                                            ->addId(Id::fromString('CD85BBA8-F2E6-11E0-B5BD-9FB84824019B'))
                                            ->setValue(
                                              (new Value())
                                                ->setMediaType(MediaTypeInterface::IMAGE_JPEG)
                                                ->setXSIType(XSITypeInterface::ENCAPSULATED_DATA)
                                                ->setReferenceElement(
                                                  new ReferenceElement('xray.jpeg')
                                                )
                                            )
                                        )
                                    )
                                    ->returnObservation()
                                )
                            )
                        ))->setTypeCode(TypeCodeInterface::HAS_SUBJECT)
                      )
                      ->addEntryRelationship(
                        (new EntryRelationship(
                          (new Observation(
                            Code::NCTIS('103.16514', 'Report Identifier')
                          ))
                            ->setClassCode(ClassCodeInterface::OBSERVATION)
                            ->setMoodCode(MoodCodeInterface::EVENT)
                            ->addId(Id::fromString('DDB50F06-F304-11E0-A7F3-5ADD4824019B'))
                        ))->setTypeCode(TypeCodeInterface::COMPONENT)
                      )
                  )
              )
          ))->setTypeCode(''));


        $tag = new RootBodyComponent(     // component
          (new XMLBodyComponent(          // structured body
            (new SingleComponent())// component
            ->addSection(
              (new Section())
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addComponent(
                  (new SingleComponent())
                    ->setTypeCode('')
                    ->addSection($section)
                )
            )
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.24 REQUESTED SERVICE XML Fragment
     * see page 279 EventSummary_CDAImplementationGuide_v1.3.pdf
     * note that the period of time changed from unit=week value =2 to unit =d value=14
     */
    public function test_requested_service()
    {
        $expected = <<< CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin REQUESTED SERVICE -->
				<component>
					<section>
						<!-- Requested Service Instance Identifier - used for system purposes such as matching -->
						<id root="40dd5b94-9b84-4389-aad5-0bded41b12c2" />
						<!-- Detailed Clinical Model Identifier -->
						<code code="101.20158" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Requested Service" />
						<title>Requested Service</title>
						<text>
							<table>
								<thead>
									<tr>
										<th>Service</th>
										<th>Time</th>
										<th>Instructions</th>
										<th>Booking Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Xray Chest</td>
										<td>30 December 2010 10am</td>
										<td>No special instructions required.</td>
										<td>Appointment</td>
									</tr>
								</tbody>
							</table>
						</text>
						<!-- Begin Requested Service Description -->
						<entry>
							<!-- Service Booking Status (moodCode) -->
							<act classCode="ACT" moodCode="APT">
								<id root="57F6EC7E-F2E9-11E0-81A3-C1BB4824019B" />
								<code code="399208008" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="chest x-ray" />
								<!-- End Requested Service Description -->
								<!-- Begin DateTime Service Scheduled / Service Commencement Window -->
								<effectiveTime>
									<center value="201212301000+1000" />
									<width unit="d" value="14" />
								</effectiveTime>
								<!-- End DateTime Service Scheduled / Service Commencement Window -->
								<!-- Begin SERVICE PROVIDER - Examples provided below are the possible mutually exclusive 'SERVICE PROVIDER' instantiation choices.-->
								<!-- Begin Service Provider as a Healthcare Person -->
								<performer typeCode="PRF"></performer>
								<!-- End Service Provider as a Healthcare Person -->
								<!-- Begin Service Provider as an Organisation -->
								<performer typeCode="PRF"></performer>
								<!-- End Service Provider as an Organisation -->
								<!-- End SERVICE PROVIDER -->
								<!-- Begin Subject of Care Instruction Description -->
								<entryRelationship typeCode="COMP">
									<act classCode="INFRM" moodCode="EVN">
										<code code="103.10146" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Subject of Care Instruction Description" />
										<text>Drip dry.</text>
									</act>
								</entryRelationship>
								<!-- End Subject of Care Instruction Description -->
								<!-- Begin Requested Service DateTime -->
								<entryRelationship typeCode="COMP">
									<act classCode="ACT" moodCode="EVN">
										<code code="103.16635" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Requested Service DateTime" />
										<effectiveTime value="201012301000+1000" />
									</act>
								</entryRelationship>
								<!-- End Requested Service DateTime -->
							</act>
						</entry>
						<!-- End Requested Service Description -->
						<!-- Begin Service Provider as a Healthcare Person Entitlement -->
						<ext:coverage2 typeCode="COVBY">
							<ext:entitlement classCode="COV" moodCode="EVN" />
						</ext:coverage2>
						<!-- End Service Provider as a Healthcare Person Entitlement -->
					</section>
				</component>
				<!-- End REQUESTED SERVICE -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setClassCode('')
          ->setMoodCode('')
          ->setId(Id::fromString('40dd5b94-9b84-4389-aad5-0bded41b12c2'))
          ->setCode(Code::NCTIS('101.20158', 'Requested Service'))
          ->setTitle(new Title('Requested service'))
          ->setText(
            new Text(
              (new Table())
                ->getThead()
                ->createRow()
                ->createCell('Service', TableCell::TH)->getRow()
                ->createCell('Time', TableCell::TH)->getRow()
                ->createCell('Instructions', TableCell::TH)->getRow()
                ->createCell('Booking Status', TableCell::TH)->getRow()
                ->getSection()
                ->getTable()
                ->getTbody()
                ->createRow()
                ->createCell('Xray Chest', TableCell::TD)->getRow()
                ->createCell('30 December 2010 10am', TableCell::TD)->getRow()
                ->createCell('No special instructions required.', TableCell::TD)->getRow()
                ->createCell('Appointment', TableCell::TD)->getRow()
                ->getSection()
                ->getTable()
            ))
          ->addEntry(
            (new Entry())
              ->setTypeCode('')
              ->setAct(
                (new Act())
                  ->setClassCode(ClassCodeInterface::ACT)
                  ->setMoodCode(MoodCodeInterface::APPOINTMENT)
                  ->addId(Id::fromString('57F6EC7E-F2E9-11E0-81A3-C1BB4824019B'))
                  ->setCode(Code::SNOMED('399208008', 'chest x-ray'))
                  ->setEffectiveTime(
                    (new PeriodicIntervalOfTime(new \DateInterval('P14D')))
                      ->setCenter(TimeStamp::fromString('2012-12-30 10:00', '+1000'))
                      ->setTag('width')
                      ->setXSIType('')
                  )
                  ->addPerformer(new Performer())
                  ->addPerformer(new Performer())
                  ->addEntryRelationship(
                    (new EntryRelationship())
                      ->setTypeCode(TypeCodeInterface::COMPONENT)
                      ->setAct(
                        (new Act())
                          ->setClassCode(ClassCodeInterface::INFORM)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->setCode(Code::NCTIS('103.10146', 'Subject of Care Instruction Description'))
                          ->setText(new Text('Drip dry.'))
                      )
                  )
                  ->addEntryRelationship(
                    (new EntryRelationship())
                      ->setTypeCode(TypeCodeInterface::COMPONENT)
                      ->setAct(
                        (new Act())
                          ->setClassCode(ClassCodeInterface::ACT)
                          ->setMoodCode(MoodCodeInterface::EVENT)
                          ->setCode(Code::NCTIS('103.16635', 'Requested Service DateTime'))
                          ->setEffectiveTime(TimeStamp::fromString('2010-12-30 10:00', '+1000'))
                      )
                  )
              )
          )
          ->setExtCoverage2(
            (new ExtCoverage2(
              (new ExtEntitlement())
                ->setClassCode(ClassCodeInterface::COVERAGE)
                ->setMoodCode(MoodCodeInterface::EVENT)
            ))->setTypeCode(TypeCodeInterface::COVERED_BY)
          );

        $tag = new RootBodyComponent(     // component
          (new XMLBodyComponent(          // structured body
            (new SingleComponent())// component
            ->addSection(
              (new Section())
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addComponent(
                  (new SingleComponent())
                    ->setTypeCode('')
                    ->addSection($section)
                )
            )
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.25. SERVICE PROVIDER - Person XML Fragment
     * see page 290 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_service_provider()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin REQUESTED SERVICE -->
				<component>
					<section>
						<!-- Begin Narrative text -->
						<text>
							<table>
								<tbody>
									<tr>
										<td>049960CT</td>
									</tr>
								</tbody>
							</table>
						</text>
						<!-- End Narrative text -->
						<!-- Begin Requested Service Description -->
						<entry>
							<!-- Service Booking Status (moodCode) -->
							<act classCode="ACT" moodCode="APT">
								<!-- Begin Service Provider as a Healthcare Person -->
								<performer typeCode="PRF">
									<!-- Begin Participation Period -->
									<time>
										<low value="201212301000+1000" />
										<high value="201212301030+1000" />
									</time>
									<!-- End Participation Period -->
									<assignedEntity>
										<!-- ID is used for system purposes such as matching -->
										<id root="43c26c57-5cc0-4f43-b11c-44f917c152af" />
										<!-- Role -->
										<code code="253917" codeSystem="2.16.840.1.113883.13.62" codeSystemName="1220.0 - ANZSCO -- Australian and New Zealand Standard Classification of Occupations, 2013, Version 1.2" displayName="Diagnostic and Interventional Radiologist" />
										<!-- Begin Address -->
										<addr use="WP">
											<streetAddressLine>67 Radiology Drive</streetAddressLine>
											<city>Nehtaville</city>
											<state>QLD</state>
											<postalCode>5555</postalCode>
											<additionalLocator>32568931</additionalLocator>
											<country>Australia</country>
										</addr>
										<!-- End Address -->
										<!-- Electronic Communication Detail -->
										<telecom value="mailto:os@hospital.com.au" />
										<assignedPerson>
											<!-- Begin Person Name -->
											<name use="L">
												<prefix>Dr</prefix>
												<given>Bone</given>
												<family>Doctor</family>
											</name>
											<!-- End Person Name -->
											<!-- Begin Entity Identifier -->
											<ext:asEntityIdentifier classCode="IDENT">
												<ext:id assigningAuthorityName="HPI-I" root="1.2.36.1.2001.1003.0.8003619900015717" />
												<ext:assigningGeographicArea classCode="PLC">
													<ext:name>National Identifier</ext:name>
												</ext:assigningGeographicArea>
											</ext:asEntityIdentifier>
											<!-- End Entity Identifier -->
											<!-- Employment Details -->
											<ext:asEmployment classCode="EMP">
												<!-- Position In Organisation -->
												<ext:code>
													<originalText>Staff Radiologist</originalText>
												</ext:code>
												<!-- Occupation -->
												<ext:jobCode code="253917" codeSystem="2.16.840.1.113883.13.62" codeSystemName="1220.0 - ANZSCO -- Australian and New Zealand Standard Classification of Occupations, 2013, Version 1.2" displayName="Diagnostic and Interventional Radiologist" />
												<!-- Employment Type -->
												<ext:jobClassCode code="FT" codeSystem="2.16.840.1.113883.5.1059" codeSystemName="HL7:EmployeeJobClass" displayName="full-time" />
												<!-- Begin Employer Organisation -->
												<ext:employerOrganization>
													<!-- Department/Unit -->
													<name>Radiology Specialists</name>
													<asOrganizationPartOf>
														<wholeOrganization>
															<!-- Organisation Name -->
															<name use="ORGB">Radiology Clinics</name>
															<!-- Being Entity Identifier -->
															<ext:asEntityIdentifier classCode="IDENT">
																<ext:id assigningAuthorityName="HPI-O" root="1.2.36.1.2001.1003.0.8003621566684455" />
																<ext:assigningGeographicArea classCode="PLC">
																	<ext:name>National Identifier</ext:name>
																</ext:assigningGeographicArea>
															</ext:asEntityIdentifier>
															<!-- End Entity Identifier -->
														</wholeOrganization>
													</asOrganizationPartOf>
												</ext:employerOrganization>
												<!-- End Employer Organisation -->
											</ext:asEmployment>
											<!-- Begin Qualifications -->
											<ext:asQualifications classCode="QUAL">
												<ext:code>
													<originalText>M.B.B.S</originalText>
												</ext:code>
											</ext:asQualifications>
											<!-- End Qualifications -->
										</assignedPerson>
									</assignedEntity>
								</performer>
								<!-- End Service Provider as a Healthcare Person -->
							</act>
						</entry>
						<!-- End Requested Service Description -->
						<!-- Begin Service Provider as a Healthcare Person Entitlement -->
						<ext:coverage2 typeCode="COVBY">
							<ext:entitlement classCode="COV" moodCode="EVN">
								<ext:id assigningAuthorityName="Medicare Prescriber number" root="1.2.36.174030967.0.3" extension="049960CT" />
								<ext:code code="10" codeSystem="1.2.36.1.2001.1001.101.104.16047" codeSystemName="NCTIS Entitlement Type Values" displayName="Medicare Prescriber Number"/>
								<ext:effectiveTime>
									<low value="20050101"/>
									<high value="20250101"/>
								</ext:effectiveTime>
								<ext:participant typeCode="HLD">
									<ext:participantRole classCode="ASSIGNED">
										<!-- Same as the Service Provider (performer) id -->
										<ext:id root="43c26c57-5cc0-4f43-b11c-44f917c152af"/>
									</ext:participantRole>
								</ext:participant>
							</ext:entitlement>
						</ext:coverage2>
						<!-- End Service Provider as a Healthcare Person Entitlement -->
					</section>
				</component>
				<!-- End REQUESTED SERVICE -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;

        $section = (new Section())
          ->setClassCode('')
          ->setMoodCode('')
          ->setText(new Text(
            (new Table())
              ->getTbody()
              ->createRow()
              ->createCell('049960CT', TableCell::TD)->getRow()
              ->getSection()
              ->getTable()
          ))
          ->addEntry((new Entry())
            ->setTypeCode('')
            ->setAct(
              (new Act())
                ->setClassCode(ClassCodeInterface::ACT)
                ->setMoodCode(MoodCodeInterface::APPOINTMENT)
                ->addPerformer(
                  (new Performer())
                    ->setTypeCode(TypeCodeInterface::PERFORMER)
                    ->returnPerformer()
                    ->setTime(
                      (new IntervalOfTime(
                        TimeStamp::fromString('2012-12-30 10:00', '+1000'),
                        TimeStamp::fromString('2012-12-30 10:30', '+1000')
                      ))->setShowXSIType('')
                    )
                    ->setAssignedEntity(
                      (new AssignedEntity(Id::fromString('43c26c57-5cc0-4f43-b11c-44f917c152af')))
                        ->setCode(Code::Occupation(253917))
                        ->addAddr(
                          (new Addr('67 Radiology Drive',
                            'Nehtaville', 'QLD', '5555', '32568931'))
                            ->setCountry(new Country('Australia'))
                            ->setUseAttribute(UseAttributeInterface::WORKPLACE)
                        )
                        ->addTelecom(new Telecom(null, 'mailto:os@hospital.com.au'))
                        ->setAssignedPerson(
                          (new AssignedPerson(
                            (new Set(PersonName::class))
                              ->add((new PersonName())
                                ->setUseAttribute(UseAttributeInterface::LEGAL_NAME)
                                ->addPart(PersonName::HONORIFIC, 'Dr')
                                ->addPart(PersonName::FIRST_NAME, 'Bone')
                                ->addPart(PersonName::LAST_NAME, 'Doctor')
                              )))
                            ->setClassCode('')
                            ->setAsEntityIdentifier(
                              new AsEntityIdentifier(
                                new ExtId('HPI-I', '1.2.36.1.2001.1003.0.8003619900015717'),
                                new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
                              )
                            )->returnAssignedPerson()
                            ->setAsEmployment(new AsEmployment(
                              new ExtCode(new OriginalText('Staff Radiologist')),
                              ExtJobCode::Occupation(253917),
                              new JobClassCode(JobClassCode::CODE_FULL_TIME),
                              new ExtEmployerOrganization(
                                new EntityName('Radiology Specialists'),
                                new AsOrganizationPartOf(
                                  new WholeOrganisation(
                                    (new EntityName('Radiology Clinics'))->setUseAttribute('ORGB'),
                                    new AsEntityIdentifier(
                                      new ExtId('HPI-O', '1.2.36.1.2001.1003.0.8003621566684455'),
                                      new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
                                    )
                                  )
                                )
                              )
                            ))
                            ->setAsQualifications(new AsQualifications(new ExtCode(new OriginalText('M.B.B.S'))))
                        )
                    )
                )
            )
          )->setExtCoverage2(
            new ExtCoverage2(
              new ExtEntitlement(
                new ExtId('Medicare Prescriber number', '1.2.36.174030967.0.3', '049960CT'),
                new ExtCode(null, new CodedValue(
                  '10',
                  'Medicare Prescriber Number',
                  '1.2.36.1.2001.1001.101.104.16047',
                  'NCTIS Entitlement Type Values')),
                (new ExtEffectiveTime(new IntervalOfTime(
                  (new TimeStamp(
                    new \DateTime('2005-01-01')
                  ))->setPrecision(TimeStamp::PRECISION_DAY),
                  (new TimeStamp(
                    new \DateTime('2025-01-01')
                  ))->setPrecision(TimeStamp::PRECISION_DAY)
                )))->setXSIType(''),
                (new ExtParticipant(
                  (new ExtParticipantRole(
                    new ExtId('', '43c26c57-5cc0-4f43-b11c-44f917c152af')))
                    ->setClassCode(ClassCodeInterface::ASSIGNED)
                    ->returnExtParticipantRole()
                ))->setTypeCode(TypeCodeInterface::HOLDER))
            ));

        $tag = new RootBodyComponent(     // component
          (new XMLBodyComponent(          // structured body
            (new SingleComponent())// component
            ->addSection(
              (new Section())
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addComponent(
                  (new SingleComponent())
                    ->setTypeCode('')
                    ->addSection($section)
                )
            )
          )
          )->setClassCode('')
        );
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    /**
     * Example 7.26. SERVICE PROVIDER - Organisation XML Fragment
     * see page 297 EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_service_provider_organisation()
    {
        $expected = <<<CDA
<!-- Begin CDA Body -->
<component>
	<structuredBody>
		<!-- Begin DIAGNOSTIC INVESTIGATIONS -->
		<component typeCode="COMP">
			<section classCode="DOCSECT" moodCode="EVN">
				<!-- Begin REQUESTED SERVICE -->
				<component>
					<section>
						<!-- Begin Requested Service Description -->
						<entry>
							<!-- Service Booking Status (moodCode) -->
							<act classCode="ACT" moodCode="APT">
								<!-- Begin Service Provider as an Organisation -->
								<performer typeCode="PRF">
									<!-- Begin Participation Period -->
									<time>
										<low value="201212301000+1000" />
										<high value="201212301030+1000" />
									</time>
									<!-- End Participation Period -->
									<assignedEntity>
										<!-- ID is used for system purposes such as matching -->
										<id root="43c26c57-5cc0-4f43-b11c-44f917c152af" />
										<!-- Role -->
										<code code="309964003" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="radiology department" />
										<!-- Begin Address -->
										<addr use="WP">
											<streetAddressLine>115 Radiology Street</streetAddressLine>
											<city>Nehtaville</city>
											<state>QLD</state>
											<postalCode>5555</postalCode>
											<additionalLocator>32568931</additionalLocator>
											<country>Australia</country>
										</addr>
										<!-- End Address -->
										<!-- Electronic Communication Detail -->
										<telecom value="tel:0788324888" />
										<representedOrganization>
											<asOrganizationPartOf>
												<wholeOrganization>
													<!-- Organisation Name -->
													<name use="ORGB">Private Radiology Clinic</name>
													<!-- Begin Entity Identifier -->
													<ext:asEntityIdentifier classCode="IDENT">
														<ext:id assigningAuthorityName="HPI-O" root="1.2.36.1.2001.1003.0.8003621566684455" />
														<ext:assigningGeographicArea classCode="PLC">
															<ext:name>National Identifier</ext:name>
														</ext:assigningGeographicArea>
													</ext:asEntityIdentifier>
													<!-- End Entity Identifier -->
												</wholeOrganization>
											</asOrganizationPartOf>
										</representedOrganization>
									</assignedEntity>
								</performer>
								<!-- End Service Provider as an Organisation -->
							</act>
						</entry>
						<!-- End Requested Service Description -->
					</section>
				</component>
				<!-- End REQUESTED SERVICE -->
			</section>
		</component>
		<!-- End DIAGNOSTIC INVESTIGATIONS -->
	</structuredBody>
</component>
<!-- End CDA Body -->
CDA;
        $section  = (new Section())
          ->setClassCode('')
          ->setMoodCode('')
          ->addEntry(
            (new Entry(
              (new Act())
                ->setClassCode(ClassCodeInterface::ACT)
                ->setMoodCode(MoodCodeInterface::APPOINTMENT)
                ->addPerformer(
                  (new Performer())
                    ->setTypeCode(TypeCodeInterface::PERFORMER)
                    ->returnPerformer()
                    ->setTime(
                      (new IntervalOfTime(
                        TimeStamp::fromString('2012-12-30 10:00', '+1000'),
                        TimeStamp::fromString('2012-12-30 10:30', '+1000')
                      ))->setShowXSIType(false)
                    )
                    ->setAssignedEntity(
                      (new AssignedEntity(
                        Id::fromString('43c26c57-5cc0-4f43-b11c-44f917c152af'),
                        Code::SNOMED('309964003', 'radiology department'),
                        (new Addr(
                          '115 Radiology Street',
                          'Nehtaville',
                          'QLD',
                          '5555',
                          '32568931'
                        ))
                          ->setCountry(new Country('Australia'))
                          ->setUseAttribute(UseAttributeInterface::WORKPLACE),
                        new Telecom('', 'tel:0788324888')
                      ))
                        ->setClassCode('')
                        ->setRepresentedOrganization(
                          (new RepresentedOrganization())
                            ->setClassCode('')
                            ->setAsOrganizationPartOf(
                              new AsOrganizationPartOf(
                                new WholeOrganisation(
                                  (new EntityName('Private Radiology Clinic'))->setUseAttribute('ORGB'),
                                  new AsEntityIdentifier(
                                    new ExtId('HPI-O', '1.2.36.1.2001.1003.0.8003621566684455'),
                                    new AssigningGeographicArea(new ExtEntityName(new SimpleString('National Identifier')))
                                  )
                                )
                              )
                            )
                        )
                    )
                )
            ))->setTypeCode('')
          );
        $tag      = new RootBodyComponent(     // component
          (new XMLBodyComponent(          // structured body
            (new SingleComponent())// component
            ->addSection(
              (new Section())
                ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
                ->setMoodCode(MoodCodeInterface::EVENT)
                ->addComponent(
                  (new SingleComponent())
                    ->setTypeCode('')
                    ->addSection($section)
                )
            )
          )
          )->setClassCode('')
        );
        $dom      = new \DOMDocument('1.0', 'UTF-8');
        $doc      = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}