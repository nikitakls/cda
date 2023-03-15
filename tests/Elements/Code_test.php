<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.
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

namespace PHPHealth\tests\classes\CDA\Tests\TemplateCode;

use PHPHealth\CDA\DataType\Code\LoincCode;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\OriginalText;
use PHPHealth\CDA\Elements\Translation;
use PHPHealth\tests\MyTestCase;

/**
 * Test Loinc Code
 *
 * @author     julien.fastre@champs-libres.coop
 * @group      CDA
 * @group      CDA_Elements
 * @group      CDA_LOINC_Code
 *
 * phpunit-debug  --no-coverage --group CDA_LOINC_Code
 *
 */
class Code_test extends MyTestCase
{
    public function test_Code()
    {
        $code = new Code(LoincCode::create("57133-1", "REASON FOR REFERRAL"));

        $expected    = <<<'XML'
<code code="57133-1" displayName="REASON FOR REFERRAL" codeSystem="2.16.840.1.113883.6.1" codeSystemName="LOINC" />
XML;
        $expectedDoc = new \DOMDocument('1.0');
        $expectedDoc->loadXML($expected);
        $expectedCode = $expectedDoc
          ->getElementsByTagName('code')
          ->item(0);

        $this->assertEqualXMLStructure($expectedCode,
          $code->toDOMElement(new \DOMDocument()), true);
    }

    public function test_code_translation()
    {
        $expected = <<<CDA
<!-- Alternate code system in use and a translation into the specified code system is available -->
<code code="J45.9" codeSystem="2.16.840.1.113883.6.135" codeSystemName="ICD10AM" displayName="Asthma, unspecified">
    <originalText>Asthma</originalText>
    <translation code="195967001" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Asthma"/>
</code>
CDA;

        $tag = Code::ICD10AM('J45.9', 'Asthma, unspecified')
          ->setOriginalText(new OriginalText('Asthma'))
          ->setTranslation(Translation::SNOMED('195967001', 'Asthma'));

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_orignal_text_only()
    {
        $expected = <<<CDA
<code>
    <originalText>Asthma</originalText>
</code>
CDA;

        $tag = (new Code())
          ->setOriginalText(new OriginalText('Asthma'));

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}
