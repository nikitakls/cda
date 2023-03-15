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

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_Elements
 * @group       CDA_AuthoringDevice
 *
 * phpunit-debug  --no-coverage --group CDA_AuthoringDevice
 *
 */


use PHPHealth\CDA\DataType\Code\CharacterStringWithCode;
use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AuthoringDevice;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\ManufacturerModelName;
use PHPHealth\CDA\Elements\SoftwareName;
use PHPHealth\tests\MyTestCase;

class AuthoringDevice_test extends MyTestCase
{
    public function test_tag()
    {
        $expected = <<<CDA
<?xml version="1.0" encoding="UTF-8"?>
<authoringDevice classCode="DEV" determinerCode="INSTANCE">
    <code code="Code" displayName="unit-tester-code" codeSystem="codeSystem" codeSystemName="codeSystemName" />
    <manufacturerModelName 
        code="unit-tester"
        displayName="unit-tester-model"
        codeSystem="abc"
        codeSystemName="unit-tester-system"
        codeSystemVersion="1.2.3">unit-tester-model</manufacturerModelName>
    <softwareName 
        code="unit-tester"
        displayName="unit-tester-software"
        codeSystem="def"
        codeSystemName="unit-tester-system"
        codeSystemVersion="4.5.6">unit-tester-software</softwareName>
</authoringDevice>
CDA;

        $tag = (new AuthoringDevice())
          ->setCode(new Code(new CodedValue('Code', 'unit-tester-code', 'codeSystem', 'codeSystemName')))
          ->setManufacturerModelName(
            new ManufacturerModelName(
              (new CharacterStringWithCode())
                ->setCode('unit-tester')
                ->setDisplayName('unit-tester-model')
                ->setCodeSystem('abc')
                ->setCodeSystemVersion('1.2.3')
                ->setCodeSystemName('unit-tester-system')
            ))
          ->setSoftwareName(
            new SoftwareName(
              (new CharacterStringWithCode())
                ->setCode('unit-tester')
                ->setDisplayName('unit-tester-software')
                ->setCodeSystem('def')
                ->setCodeSystemVersion('4.5.6')
                ->setCodeSystemName('unit-tester-system')
            ));
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $doc = $tag->toDOMElement($dom);
        $dom->appendChild($doc);
        $dom->formatOutput = true;
        $cda               = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }


    public function test_bad_determiner()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The determiner code xxx is not an acceptable value!');
        (new AuthoringDevice())->setDeterminerCode('xxx');
    }

    public function test_bad_class()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The class code xxx is not valid!');
        (new AuthoringDevice())->setClassCode('xxx');
    }
}