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

namespace PHPHealth\tests\classes\CDA\Tests\RIM\Role;

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Name\PersonName;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\RIM\Entity\Patient;
use PHPHealth\CDA\RIM\Role\PatientRole;
use PHPHealth\tests\MyTestCase;

/**
 * Test PatientRole
 *
 * @author     Julien Fastré <julien.fastre@champs-libres.coop>
 * @group      CDA
 * @group      CDA_PatientRole
 *
 * phpunit-debug  --no-coverage --group CDA_PatientRole
 *
 */
class PatientRole_test extends MyTestCase
{

    public function test_PatientRole()
    {
        $pr       = new PatientRole($this->getId(), $this->getPatient());
        $expected = <<<'CDA'
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
CDA;

        $expectedDoc = new \DOMDocument('1.0');
        $expectedDoc->loadXML($expected);
        $expectedPatientRole = $expectedDoc
          ->getElementsByTagName('patientRole')
          ->item(0);

        $this->assertEqualXMLStructure($expectedPatientRole,
          $pr->toDOMElement(new \DOMDocument()), true);
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
}
