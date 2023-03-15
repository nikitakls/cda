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
 * @group       CDA_RIM_JobClassCode
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_JobClassCode
 *
 */

use PHPHealth\CDA\RIM\Extensions\JobClassCode;
use PHPHealth\tests\MyTestCase;

class JobClassCode_test extends MyTestCase
{
    public function test_full_time()
    {
        $expected          = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<ext:jobClassCode code="FT" codeSystem="2.16.840.1.113883.5.1059" codeSystemName="HL7:EmployeeJobClass" displayName="full-time"/>

XML;
        $job_class_code    = new JobClassCode(JobClassCode::CODE_FULL_TIME);
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $job_class_code->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_part_time()
    {
        $expected          = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<ext:jobclasscode code="PT" codesystem="2.16.840.1.113883.5.1059" codesystemname="HL7:EmployeeJobClass" displayname="part-time"/>

XML;
        $job_class_code    = new JobClassCode(JobClassCode::CODE_PART_TIME);
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $job_class_code->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The code bad-value is not valid!');
        new JobClassCode('bad-value');
    }

}