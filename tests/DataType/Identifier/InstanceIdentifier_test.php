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

namespace PHPHealth\tests\classes\DataType\Identifier;

use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\tests\MyTestCase;

/**
 * Tests for InstanceIdentifier
 *
 * @author     julien
 *
 * @group      CDA
 * @group      CDA_InstanceIdentifier_test
 *
 * phpunit-debug  --no-coverage --group CDA_InstanceIdentifier_test
 *
 */
class InstanceIdentifier_test extends MyTestCase
{
    public function test_RootOnly()
    {
        $ii = new InstanceIdentifier('string');

        $doc = new \DOMDocument('1.0', 'UTF-8');

        $el = $doc->createElement('id');
        $doc->appendChild($el);

        $ii->setValueToElement($el, $doc);

        $expected    = <<<'CDA'
<id root="string"/>
CDA;
        $expectedDoc = new \DOMDocument('1.0');
        $expectedDoc->loadXML($expected);
        $expectedII = $expectedDoc
          ->getElementsByTagName('id')
          ->item(0);

        $this->assertEqualXMLStructure($expectedII, $el, true);
    }

    public function test_RootAndExtension()
    {
        $ii = new InstanceIdentifier('string');
        $ii->setExtension('chill/abrumet');

        $doc = new \DOMDocument('1.0', 'UTF-8');

        $el = $doc->createElement('id');
        $doc->appendChild($el);

        $ii->setValueToElement($el, $doc);

        $expected    = <<<'CDA'
<id root="string" extension="chill/abrumet" />
CDA;
        $expectedDoc = new \DOMDocument('1.0');
        $expectedDoc->loadXML($expected);
        $expectedII = $expectedDoc
          ->getElementsByTagName('id')
          ->item(0);

        $this->assertEqualXMLStructure($expectedII, $el, true);
    }
}
