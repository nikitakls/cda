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
 * @author     Julien Fastré <julien.fastre@champs-libres.coop>
 * @group      CDA
 * @group      CDA_ClinicalDocument
 *
 * phpunit-debug  --no-coverage --group CDA_ClinicalDocument
 *
 */

use PHPHealth\CDA\ClinicalDocument;
use PHPHealth\CDA\Component\NonXMLBodyComponent;
use PHPHealth\CDA\Component\SingleComponent;
use PHPHealth\CDA\Component\SingleComponent\Section;
use PHPHealth\CDA\Component\XMLBodyComponent;
use PHPHealth\CDA\DataType\Code\CodedSimple;
use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Code\ConfidentialityCode as ConfidentialityCodeType;
use PHPHealth\CDA\DataType\Code\LoincCode;
use PHPHealth\CDA\DataType\Code\SnomedCTCode;
use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Interval\PeriodicIntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\DataType\Name\PersonName;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;
use PHPHealth\CDA\DataType\TextAndMultimedia\CharacterString;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\ConfidentialityCode;
use PHPHealth\CDA\Elements\EffectiveTime;
use PHPHealth\CDA\Elements\Html\Table;
use PHPHealth\CDA\Elements\Html\Text;
use PHPHealth\CDA\Elements\Html\Title;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Elements\LanguageCode;
use PHPHealth\CDA\Elements\StatusCodeElement;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Act\Observation;
use PHPHealth\CDA\RIM\Act\SubstanceAdministration;
use PHPHealth\CDA\RIM\Entity\AssignedCustodian;
use PHPHealth\CDA\RIM\Entity\AssignedPerson;
use PHPHealth\CDA\RIM\Entity\InformationRecipientPerson;
use PHPHealth\CDA\RIM\Entity\ManufacturedLabeledDrug;
use PHPHealth\CDA\RIM\Entity\Organization;
use PHPHealth\CDA\RIM\Entity\Patient;
use PHPHealth\CDA\RIM\Entity\ReceivedOrganization;
use PHPHealth\CDA\RIM\Entity\RepresentedCustodianOrganization;
use PHPHealth\CDA\RIM\Participation\Author;
use PHPHealth\CDA\RIM\Participation\Consumable;
use PHPHealth\CDA\RIM\Participation\Custodian;
use PHPHealth\CDA\RIM\Participation\InformationRecipient;
use PHPHealth\CDA\RIM\Participation\RecordTarget;
use PHPHealth\CDA\RIM\Role\AssignedAuthor;
use PHPHealth\CDA\RIM\Role\IntendedRecipient;
use PHPHealth\CDA\RIM\Role\ManufacturedProduct;
use PHPHealth\CDA\RIM\Role\PatientRole;
use PHPHealth\tests\classes\CDA\Component\XMLBodyComponent_test;
use PHPHealth\tests\MyTestCase;

class ClinicalDocument_test extends MyTestCase
{
    const CLINICAL_DOCUMENT_AUSTRALIAN_EXTENSION = '<ClinicalDocument xmlns="urn:hl7-org:v3" xmlns:ext="http://ns.electronichealth.net.au/ci/cda/extensions/3.0" xmlns:xs="http://www.w3.org/2001/xmlschema" xmlns:xsi="http://www.w3.org/2001/xmlschema-instance" xsi:schemalocation="cda-es-v1_3.xsd">';
    const CLINICAL_DOCUMENT_REGULAR              = '<ClinicalDocument xmlns="urn:hl7-org:v3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:hl7-org:v3 CDA.xsd">';
    private $clinical_document_tag;

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        $_SESSION = array();
    }

    public function setUp()
    {
        $this->clinical_document_tag = self::CLINICAL_DOCUMENT_AUSTRALIAN_EXTENSION;
    }

    /*
     * Test that the ClinicalDocument class return a DOMDocument
     */

    public function test_ToDocument()
    {
        $doc = new ClinicalDocument();
        $dom = $doc->toDOMDocument();
        $this->assertInstanceOf(\DOMDocument::class, $dom);
    }

    public function test_SimplifiedDocument()
    {
        // create the initial document
        $doc = new ClinicalDocument();
        $doc->setTitle(
          new Title('Good Health Clinic Consultation Note')
        );

        $clinicalElements = $doc->toDOMDocument()
          ->getElementsByTagName('ClinicalDocument');
        $cda              = $doc->toDOMDocument()->saveXML();
        // create the expected document from XML string
        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
{$this->clinical_document_tag}
    <typeId root="2.16.840.1.113883.1.3" extension="POCD_HD000040"/>
	<title>Good Health Clinic Consultation Note</title>
</ClinicalDocument>
CDA;

        // tests
        $this->assertEquals(1, $clinicalElements->length,
          'test that there is only one clinical document');
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_DocumentWithNonXMLBody()
    {
        // create the expected document from XML string
        $expected = $this->DocumentWithNonXMLBodyExpected();
        // create the initial document
        $doc = new ClinicalDocument();
        $doc->setTitle(new Title('Good Health Clinic Consultation Note'));
        $doc->setEffectiveTime(new EffectiveTime(
          new TimeStamp(\DateTime::createFromFormat(\DateTime::ATOM, '2014-08-27T01:43:12+0200'))));
        $doc->setId(new Id(new InstanceIdentifier('1.2.3.4', 'https://mass.chill.pro')));
        $doc->setCode(Code::LOINC('42349-1', 'REASON FOR REFERRAL'));
        $doc->setConfidentialityCode(new ConfidentialityCode(ConfidentialityCodeType::create(ConfidentialityCodeType::RESTRICTED_KEY, ConfidentialityCodeType::RESTRICTED)));
        $doc->addRecordTarget($this->getRecordTarget());
        $time_stamp = new TimeStamp(\DateTime::createFromFormat('Y-m-d-H:i', '2000-04-07-14:00'));
        $time_stamp->setPrecision(TimeStamp::PRECISION_HOURS);
        $doc->addAuthor(new Author($time_stamp, $this->getAssignedAuthor()));
        $doc->setCustodian($this->getCustodian());

        $nonXMLBody = new NonXMLBodyComponent();
        $nonXMLBody->setContent(new CharacterString('This is a narrative text'));
        $doc->getRootComponent()->addComponent($nonXMLBody);

        $clinicalElements  = $doc->toDOMDocument()
          ->getElementsByTagName('ClinicalDocument');
        $DOM               = $doc->toDOMDocument();
        $DOM->formatOutput = true;
        $cda               = $DOM->saveXML();

        $this->assertEquals(1, $clinicalElements->length, 'test that there is only one clinical document');
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    private function DocumentWithNonXMLBodyExpected(): string
    {
        return <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
{$this->clinical_document_tag}
    <typeId root="2.16.840.1.113883.1.3" extension="POCD_HD000040"/>
    <id root="1.2.3.4" extension="https://mass.chill.pro" />
    <code code='42349-1' displayName='REASON FOR REFERRAL' codeSystem='2.16.840.1.113883.6.1' codeSystemName='LOINC'/>	
    <title>Good Health Clinic Consultation Note</title>
    <effectiveTime value="20140827014312"/>
    <confidentialityCode code="R" displayName="Restricted" codeSystem="2.16.840.1.113883.5.25" codeSystemName="Confidentiality"/>
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
    <custodian typeCode="CST">
 	    <assignedCustodian classCode="ASSIGNED">
 	      <representedCustodianOrganization classCode="ORG">
	        <id root="82112744-ea24-11e6-95be-17f96f76d55c"/>
 	        <name>ABRUMET asbl</name>
 	      </representedCustodianOrganization>
 	    </assignedCustodian>
 	</custodian>
    <component>
        <nonXMLBody>
            <text><![CDATA[This is a narrative text]]></text>
        </nonXMLBody>
    </component>
</ClinicalDocument>
CDA;
    }

    protected function getRecordTarget(): RecordTarget
    {
        $pr = new PatientRole($this->getPatientId(), $this->getPatient());

        return new RecordTarget($pr);
    }

    /**
     *
     * @return AssignedAuthor
     */
    protected function getAssignedAuthor(): AssignedAuthor
    {
        $names = new Set(PersonName::class);
        $names->add((new PersonName())
          ->addPart(PersonName::FIRST_NAME, 'Robert')
          ->addPart(PersonName::LAST_NAME, 'Dolin')
          ->addPart('suffix', 'MD')
        );

        $assignedAuthor = new AssignedAuthor(Id::fromString('2.16.840.1.113883.19.5', 'KP00017'));
        $assignedAuthor->setAssignedPerson(new AssignedPerson($names));
        return $assignedAuthor;
    }

    /**
     *
     * @return Custodian
     */
    protected function getCustodian(): Custodian
    {
        $names             = (new Set(EntityName::class))
          ->add(new EntityName('ABRUMET asbl'));
        $id                = Id::fromString('82112744-ea24-11e6-95be-17f96f76d55c');
        $reprCustodian     = new RepresentedCustodianOrganization($names, $id);
        $assignedCustodian = new AssignedCustodian($reprCustodian);
        return new Custodian($assignedCustodian);
    }

    protected function getPatientId(): Id
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
        $time_stamp = new TimeStamp(\DateTime::createFromFormat('Y-m-d', '1932-09-24'));
        $time_stamp->setPrecision(TimeStamp::PRECISION_DAY);
        $patient = new Patient(
          $names,
          $time_stamp,
          new CodedValue('M', '', '2.16.840.1.113883.5.1', '')
        );

        return $patient;
    }

    public function test_DocumentWithXMLStructuredBody()
    {
        // create the initial document
        $doc = new ClinicalDocument();
        $doc->setTitle(new Title('Good Health Clinic Consultation Note'));
        $effective_time_stamp = new TimeStamp(\DateTime::createFromFormat(\DateTime::ATOM, '2014-08-27T01:43:12+0200'));
        $effective_time_stamp->setPrecision(TimeStamp::PRECISION_MINUTES);
        $doc->setEffectiveTime(new EffectiveTime($effective_time_stamp));
        $doc->setId(new Id(new InstanceIdentifier('1.2.3.4', 'https://mass.chill.pro')));
        $doc->setCode(new Code(LoincCode::create('42349-1', 'REASON FOR REFERRAL')));
        $doc->setConfidentialityCode(new ConfidentialityCode(ConfidentialityCodeType::create(ConfidentialityCodeType::RESTRICTED_KEY, ConfidentialityCodeType::RESTRICTED)));
        $doc->addRecordTarget($this->getRecordTarget());
        $time_stamp = new TimeStamp(\DateTime::createFromFormat('Y-m-d-H:i', '2000-04-07-14:00'));
        $time_stamp->setPrecision(TimeStamp::PRECISION_HOURS);
        $doc->addAuthor(new Author($time_stamp, $this->getAssignedAuthor()));
        $doc->setCustodian($this->getCustodian());

        $body = XMLBodyComponent_test::getBody();
        $doc->getRootComponent()->addComponent($body);

        $DOM               = $doc->toDOMDocument();
        $DOM->formatOutput = true;
        $clinicalElements  = $DOM->getElementsByTagName('ClinicalDocument');
        $cda               = $DOM->saveXML();

        $expected = $this->DocumentWithXMLStructuredBodyExpected();

        // tests
        $this->assertEquals(1, $clinicalElements->length, 'test that there is only one clinical document');
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    private function DocumentWithXMLStructuredBodyExpected(): string
    {
        return <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
{$this->clinical_document_tag}
    <typeId root="2.16.840.1.113883.1.3" extension="POCD_HD000040"/>
    <id root="1.2.3.4" extension="https://mass.chill.pro" />
    <code code='42349-1' displayName='REASON FOR REFERRAL' codeSystem='2.16.840.1.113883.6.1' codeSystemName='LOINC'/>	
    <title>Good Health Clinic Consultation Note</title>
    <effectiveTime value="201408270143"/>
    <confidentialityCode code="R" displayName="Restricted" codeSystem="2.16.840.1.113883.5.25" codeSystemName="Confidentiality"/>
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
    <custodian typeCode="CST">
 	    <assignedCustodian classCode="ASSIGNED">
 	      <representedCustodianOrganization classCode="ORG">
	        <id root="82112744-ea24-11e6-95be-17f96f76d55c"/>
 	        <name>ABRUMET asbl</name>
 	      </representedCustodianOrganization>
 	    </assignedCustodian>
 	</custodian>
    <component>
    <structuredBody classCode="DOCBODY">
      <component typeCode="COMP">
        <section classCode="DOCSECT">
          <templateId root="1.3.6.1.4.1.19376.1.5.3.1.3.1"/>
          <id root="430ADCD7-4481-DC0F-181D-2398F930B220"/>
          <code code="42349-1" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="REASON FOR REFERRAL"/>
          <title>Reason for referral</title>
          <text>Robert Hunter is a patient.</text>
        </section>
      </component>
    </structuredBody>
    </component>
</ClinicalDocument>
CDA;
    }

    public function test_AbrumetReferralSummary()
    {
        $expected = $this->AbrumetReferralSummaryExpected();
        // create the initial document
        $doc = new ClinicalDocument();
        $doc->setTitle(new Title('Good Health Clinic Consultation Note'));
        $effective_time_stamp = new TimeStamp(\DateTime::createFromFormat(\DateTime::ATOM, '2014-08-27T01:43:12+0200'));
        $effective_time_stamp->setPrecision(TimeStamp::PRECISION_MINUTES);
        $doc->setEffectiveTime(new EffectiveTime($effective_time_stamp));
        $doc->setId(Id::fromString('1.2.3.4', 'https://mass.chill.pro'));
        // add templateId
        $doc->addTemplateId(new InstanceIdentifier('1.3.6.1.4.1.19376.1.5.3.1.1.3'));
        $doc->setCode(Code::LOINC('42349-1', 'REASON FOR REFERRAL'));
        $doc->setConfidentialityCode(
          new ConfidentialityCode(
            ConfidentialityCodeType::create(
              ConfidentialityCodeType::RESTRICTED_KEY,
              ConfidentialityCodeType::RESTRICTED
            )
          )
        );
        $doc->setLanguageCode(new LanguageCode(new CodedSimple('fr-FR')));
        $doc->addRecordTarget($this->getRecordTarget());
        $author_time_stamp = TimeStamp::fromString('2000-04-07 14:00', 'UTC', TimeStamp::PRECISION_HOURS);
        $doc->addAuthor(new Author($author_time_stamp, $this->getAssignedAuthor()));
        $doc->setCustodian($this->getCustodian());

        // create components
        $components = array(
          [
            '1.3.6.1.4.1.19376.1.5.3.1.3.1', // templateId of section
            'BF2FA954-F43B-11E6-9397-EBC69C88DB61', //id of section
            new LoincCode('42349-1', 'Reason for referral'), // code for section
            'Robert Hunter is a patient.', // text for section
            array() // no acts
          ],
          [
            '1.3.6.1.4.1.19376.1.5.3.1.3.4', // templateId of section
            'BF303018-F43B-11E6-BDFA-97E99F59C825', //id of section
            new LoincCode('10164-2', 'History of Present Illness Section'), // code for section
            'No statement.', // text for section
            array() // no acts
          ],
          [
            '1.3.6.1.4.1.19376.1.5.3.1.3.6', // templateId of section
            'BF3085A4-F43B-11E6-A16D-2FE01C50B8F', //id of section
            new LoincCode('11450-4', 'Active Problems Section'), // code for section
            'No statement.', // text for section
            array(Observation::nullObservation())
          ],
          [
            '1.3.6.1.4.1.19376.1.5.3.1.3.19', // templateId of section
            'BF30FAA2-F43B-11E6-83D6-8F2828CBBC0A', //id of section
            new LoincCode('10160-0', 'Medication Sections'), // code for section
            (new Table())
              ->getThead()
              ->createRow()
              ->createCell('Medication')->getRow()
              ->createCell('Instructions')->getRow()
              ->createCell('Dosage')->getRow()
              ->createCell('Effective Date')->getRow()
              ->createCell('Status')->getRow()
              ->getSection()
              ->getTable()
              ->getTbody()
              ->createRow()
              ->setReference(
                $doc
                  ->getReferenceManager()
                  ->getReferenceType('Medication_1')
              )
              ->createCell('Theophylline')
              ->setReference(
                $doc
                  ->getReferenceManager()
                  ->getReferenceType('MedicationName_1'))
              ->getRow()
              ->createCell('deux fois par jour')
              ->setReference(
                $doc
                  ->getReferenceManager()
                  ->getReferenceType('MedicationSig_1'))
              ->getRow()
              ->createCell('200 mg')
              ->setReference(
                $doc
                  ->getReferenceManager()
                  ->getReferenceType('MedicationDosage_1'))
              ->getRow()
              ->createCell('9 février 2017')->getRow()
              ->createCell('Completed')->getRow()
              ->getSection()
              ->getTable(), // text for section
            array(
              (new SubstanceAdministration)
                ->setTemplateIds(array(
                  new InstanceIdentifier('2.16.840.1.113883.10.20.1.24'),
                  new InstanceIdentifier('1.3.6.1.4.1.19376.1.5.3.1.4.7')
                ))
                ->addId(Id::fromString('1BEE9D0C-F43D-11E6-A1A8-23558EA5AEFC'))
                ->setText(new Text($doc->getReferenceManager()->getReferenceElement('#Medication_1')))
                ->setStatusCode(StatusCodeElement::Completed())
                ->returnSubstanceAdministration()
                ->addEffectiveTime(
                  new IntervalOfTime(
                    (new TimeStamp(
                      \DateTime::createFromFormat('Y-m-d', '2017-02-09')
                    ))->setPrecision(TimeStamp::PRECISION_DAY),
                    (new TimeStamp(
                      \DateTime::createFromFormat('Y-m-d', '2017-02-28')
                    ))->setPrecision(TimeStamp::PRECISION_DAY)
                  )
                )
                ->addEffectiveTime(
                  (new PeriodicIntervalOfTime(new \DateInterval('PT12H')))
                    ->setInstitutionSpecified(true)
                )
                ->setRouteCode(new SnomedCTCode('20053000', 'Oral Use'))
                ->setDoseQuantity(new PhysicalQuantity('mg', 200))
                ->setConsumable(
                  new Consumable(
                    new ManufacturedProduct(
                      new ManufacturedLabeledDrug(
                        new SnomedCTCode('66493003', 'Theophylline')
                      )
                    )
                  )
                )
            )
          ],
          [
            '1.3.6.1.4.1.19376.1.5.3.1.3.13', // templateId of section
            'BF31B4D8-F43B-11E6-B02B-B711B1E5184B', //id of section
            new LoincCode('48765-2', 'allergies and Other Adverse Reactions Section'), // code for section
            'No statement.', // text for section
            array(Observation::nullObservation())
          ],
        );

        /* @var $xmlBody XMLBodyComponent the root xml body */
        $xmlBody = new XMLBodyComponent();

        /* @var $loinc LoincCode */
        foreach ($components as list($templateId, $id, $loinc, $text, $acts)) {
            $section = (new Section())
              ->setMoodCode('')
              ->setTitle(new Title($loinc->getDisplayName()))
              ->setId(Id::fromString($id))
              ->setCode(new Code($loinc))
              ->setText(new Text($text))
              ->addTemplateId(new InstanceIdentifier($templateId));
            if (\count($acts) > 0) {
                $entry = $section->createEntry();
                $entry->setAct($acts[0]);
            }
            $component = (new SingleComponent())
              ->addSection($section);
            $xmlBody->addComponent($component);
        }

        $doc->getRootComponent()->addComponent($xmlBody);

        $DOM               = $doc->toDOMDocument();
        $DOM->formatOutput = true;
        $cda               = $DOM->saveXML();

        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    private function AbrumetReferralSummaryExpected(): string
    {
        return <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
{$this->clinical_document_tag}
    <typeId root="2.16.840.1.113883.1.3" extension="POCD_HD000040"/>
    <templateId root="1.3.6.1.4.1.19376.1.5.3.1.1.3" />
    <id root="1.2.3.4" extension="https://mass.chill.pro" />
    <code code='42349-1' displayName='REASON FOR REFERRAL' codeSystem='2.16.840.1.113883.6.1' codeSystemName='LOINC'/>	
    <title>Good Health Clinic Consultation Note</title>
    <effectiveTime value="201408270143"/>
    <confidentialityCode code="R" displayName="Restricted" codeSystem="2.16.840.1.113883.5.25" codeSystemName="Confidentiality"/>
    <languageCode code="fr-FR"/>
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
    <custodian typeCode="CST">
 	    <assignedCustodian classCode="ASSIGNED">
 	      <representedCustodianOrganization classCode="ORG">
	        <id root="82112744-ea24-11e6-95be-17f96f76d55c"/>
 	        <name>ABRUMET asbl</name>
 	      </representedCustodianOrganization>
 	    </assignedCustodian>
 	</custodian>
    <component>
    <structuredBody classCode="DOCBODY">
      <component typeCode="COMP">
        <section classCode="DOCSECT">
          <templateId root="1.3.6.1.4.1.19376.1.5.3.1.3.1"/>
          <id root="BF2FA954-F43B-11E6-9397-EBC69C88DB61"/>
          <code code="42349-1" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="REASON FOR REFERRAL"/>
          <title>Reason for referral</title>
          <text>Robert Hunter is a patient.</text>
        </section>
      </component>
      <component typeCode="COMP">
        <section classCode="DOCSECT">
          <templateId root="1.3.6.1.4.1.19376.1.5.3.1.3.4"/>
          <id root="BF303018-F43B-11E6-BDFA-97E99F59C825"/>
          <code code="10164-2" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="History of Present Illness Section"/>
          <title>History of Present Illness Section</title>
          <text>No statement.</text>
        </section>
      </component>
        <component typeCode="COMP">
        <section classCode="DOCSECT">
          <templateId root="1.3.6.1.4.1.19376.1.5.3.1.3.6"/>
          <id root="BF3085A4-F43B-11E6-A16D-2FE01C50B8F"/>
          <code code="11450-4" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Active Problems Section"/>
          <title>Active Problems Section</title>
          <text>No statement.</text>
          <entry typeCode="COMP">
            <observation classCode="OBS" moodCode="DEF">
            <code nullFlavor="NI" />
            </observation>
          </entry>
        </section>
      </component>
      <component typeCode="COMP">
        <section classCode="DOCSECT">
          <templateId root="1.3.6.1.4.1.19376.1.5.3.1.3.19"/>
          <id root="BF30FAA2-F43B-11E6-83D6-8F2828CBBC0A"/>
          <code code="10160-0" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Medication Sections"/>
          <title>Medication Sections</title>
          <text>
            <table>
                <thead>
                    <tr>
                        <th>Medication</th>
                        <th>Instructions</th>
                        <th>Dosage</th>
                        <th>Effective Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ID="Medication_1">
                        <td ID="MedicationName_1">Theophylline</td>
                        <td ID="MedicationSig_1">deux fois par jour</td>
                        <td ID="MedicationDosage_1">200 mg</td>
                        <td>9 février 2017</td>
                        <td>Completed</td>
                    </tr>
                </tbody>
            </table>
          </text>
          <entry typeCode="COMP">
            <substanceAdministration classCode="SBADM" moodCode="EVN">
                <templateId root='2.16.840.1.113883.10.20.1.24'/>
                <templateId root='1.3.6.1.4.1.19376.1.5.3.1.4.7'/>
                <id root="1BEE9D0C-F43D-11E6-A1A8-23558EA5AEFC" />
                <text><reference value="#Medication_1" /></text>
                <statusCode code="completed" />
                <effectiveTime xsi:type="IVL_TS">
                    <low value="20170209" />
                    <high value="20170228" />
                </effectiveTime>
                <effectiveTime xsi:type="PIVL_TS" institutionSpecified="true" operator="A">
                    <period value="12" unit="h"/>
                </effectiveTime>
                <routeCode code='20053000' codeSystem='2.16.840.1.113883.6.96' displayName='Oral Use' codeSystemName='SNOMED CT'/>
                <doseQuantity value="200" unit="mg"/>
                <consumable typeCode="CSM">
                    <manufacturedProduct classCode="MANU">
                        <manufacturedLabeledDrug classCode="MMAT">
                            <code code="66493003" 
                                codeSystem="2.16.840.1.113883.6.96" 
                                codeSystemName="SNOMED CT" 
                                displayName="Theophylline"/>
                        </manufacturedLabeledDrug>
                    </manufacturedProduct>
                </consumable>
                <!-- 
                    ici, les instructions pour le patient - à déterminer
                    
                <entryRelationship typeCode="SUBJ" inversionInd="true">
                    <act classCode="ACT" moodCode="INT">
                        
                        <templateId root="2.16.840.1.113883.10.20.22.4.20" extension="2014-06-09"/>
                        <templateId root="2.16.840.1.113883.10.20.22.4.20"/>
                        <text>
                            <reference value="#MedicationSig_1"/>
                        </text>
                        <statusCode code="completed"/>
                    </act>
                
                </entryRelationship>
                
                -->
            </substanceAdministration>
          </entry>
          </section>
      </component>
      <component typeCode="COMP">
        <section classCode="DOCSECT">
          <templateId root="1.3.6.1.4.1.19376.1.5.3.1.3.13"/>
          <id root="BF31B4D8-F43B-11E6-B02B-B711B1E5184B"/>
          <code code="48765-2" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" displayName="Allergies and Other Adverse Reactions Section"/>
          <title>Allergies and Other Adverse Reactions Section</title>
          <text>no statement.</text>
          <entry typeCode="COMP">
            <observation classCode="OBS" moodCode="DEF">
            <code nullFlavor="NI" />
            </observation>
          </entry>
        </section>
      </component>
    </structuredBody>
    </component>
</ClinicalDocument>
CDA;
    }

    public function test_InformationRecipients()
    {
        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
{$this->clinical_document_tag}
    <typeId root="2.16.840.1.113883.1.3" extension="POCD_HD000040"/>
    <templateId root="1.3.6.1.4.1.19376.1.5.3.1.1.3" />
    <id root="1.2.3.4" extension="https://mass.chill.pro" />
    <code code='42349-1' displayName='REASON FOR REFERRAL' codeSystem='2.16.840.1.113883.6.1' codeSystemName='LOINC'/>	
    <title>information recipient test</title>
    <effectiveTime value="201408270143+0200"/>
    <confidentialityCode code="R" displayName="Restricted" codeSystem="2.16.840.1.113883.5.25" codeSystemName="Confidentiality"/>
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
    <author typeCode="AUT">
     <time value="2000040714"/>
     <assignedAuthor classCode="ASSIGNED">
       <id extension="kp00017" root="2.16.840.1.113883.19.5"/>
       <assignedPerson classCode="PSN">
         <name>
           <given>Robert</given>
           <family>Dolin</family>
           <suffix>MD</suffix>
         </name>
       </assignedPerson>
     </assignedAuthor>
   </author>
    <custodian typeCode="CST">
 	    <assignedCustodian classCode="ASSIGNED">
 	      <representedCustodianOrganization classCode="ORG">
	        <id root="82112744-ea24-11e6-95be-17f96f76d55c"/>
 	        <name>ABRUMET asbl</name>
 	      </representedCustodianOrganization>
 	    </assignedCustodian>
 	  </custodian>
    <informationRecipient typeCode="PRCP">
      <intendedRecipient classCode="ASSIGNED">
        <id extension="123" root="abc"/>
        <informationRecipient classCode="PSN">
          <name>
            <given>Unit</given>
            <family>Tester</family>
          </name>
        </informationRecipient>
        <receivedOrganization classCode="ORG">
          <id root="qwerty"/>
        </receivedOrganization>
      </intendedRecipient>
    </informationRecipient>
    <component>
      <structuredbody classCode="DOCBODY"/>
    </component>
</ClinicalDocument>
CDA;
        $names    = new Set(PersonName::class);
        $names->add((new PersonName())
          ->addPart(PersonName::FIRST_NAME, 'Unit')
          ->addPart(PersonName::LAST_NAME, 'Tester')
        );

        $doc = new ClinicalDocument();
        $doc->setTitle(new Title('information recipient test'))
          ->setEffectiveTime(new EffectiveTime(TimeStamp::fromString('2014-08-27T01:43:12', '+0200')->setPrecision(TimeStamp::PRECISION_MINUTES)))
          ->setId(Id::fromString('1.2.3.4', 'https://mass.chill.pro'))
          ->addTemplateId(new InstanceIdentifier('1.3.6.1.4.1.19376.1.5.3.1.1.3'))
          ->setCode(Code::LOINC('42349-1', 'REASON FOR REFERRAL'))
          ->setConfidentialityCode(
            new ConfidentialityCode(
              ConfidentialityCodeType::create(
                ConfidentialityCodeType::RESTRICTED_KEY,
                ConfidentialityCodeType::RESTRICTED
              )
            )
          )
          ->addRecordTarget($this->getRecordTarget())
          ->addAuthor(new Author(
            TimeStamp::fromString('2000-04-07 14:00', 'UTC', TimeStamp::PRECISION_HOURS),
            $this->getAssignedAuthor()))
          ->setCustodian($this->getCustodian())
          ->addInformationRecipient(
            (new InformationRecipient())
              ->setTypeCode(TypeCodeInterface::PRIMARY_INFORMATION_RECIPIENT)
              ->setIntendedRecipient(
                (new IntendedRecipient())
                  ->setClassCode(ClassCodeInterface::ASSIGNED)
                  ->addId(Id::fromString('abc', '123'))
                  ->setInformationRecipientPerson(
                    (new InformationRecipientPerson())
                      ->setClassCode(ClassCodeInterface::PERSON)
                      ->setNames($names)
                  )
                  ->setReceivedOrganization(
                    new ReceivedOrganization(new Set(Organization::class), Id::fromString('qwerty'))
                  )
              )
          );
        $xmlBody = new XMLBodyComponent();
        $doc->getRootComponent()->addComponent($xmlBody);

        $DOM               = $doc->toDOMDocument();
        $DOM->formatOutput = true;
        $cda               = $DOM->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}
