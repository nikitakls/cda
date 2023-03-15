<?php

namespace PHPHealth\tests\classes\CDA\Component;

/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

use PHPHealth\CDA\Component\SingleComponent;
use PHPHealth\CDA\Component\SingleComponent\Section;
use PHPHealth\CDA\Component\XMLBodyComponent;
use PHPHealth\CDA\DataType\Code\LoincCode;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Html\Text;
use PHPHealth\CDA\Elements\Html\Title;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\tests\MyTestCase;

/**
 * @author     Julien Fastré <julien.fastre@champs-libres.coop>
 * @group      CDA
 * @group      CDA_XMLBodyComponent
 *
 * phpunit-debug  --no-coverage --group CDA_XMLBodyComponent
 */
class XMLBodyComponent_test extends MyTestCase
{
    public function setUp()
    {

    }

    public function test_XMLComponent()
    {

        $body = self::getBody();

        $expected = <<<XML
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
XML;

        $expectedDoc = new \DOMDocument('1.0');
        $expectedDoc->loadXML($expected);

        $fake = new \DOMDocument;
        $fake->appendChild($body->toDOMElement($fake));

        $this->assertEqualXMLStructure($expectedDoc->firstChild, $fake->firstChild, true);
    }

    /**
     * create an xml body
     *
     * __note__: this function is public to let other test re-use this
     * body.
     *
     * @return XMLBodyComponent
     */
    public static function getBody(): XMLBodyComponent
    {
        $section   = (new Section())
          ->setMoodCode('')
          ->setCode(new Code(new LoincCode('42349-1', 'REASON FOR REFERRAL')))
          ->setId(new Id(new InstanceIdentifier('430ADCD7-4481-DC0F-181D-2398F930B220')))
          ->setText(new Text('Robert Hunter is a patient.'))
          ->addTemplateId(new InstanceIdentifier('1.3.6.1.4.1.19376.1.5.3.1.3.1'))
          ->setTitle(new Title('Reason for referral'));
        $component = (new SingleComponent())
          ->addSection($section);

        return (new XMLBodyComponent())
          ->addComponent($component);
    }
}
