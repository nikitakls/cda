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

namespace PHPHealth\tests\classes\CDA\Tests\RIM\Extensions;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_DeceasedTime
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_DeceasedTime
 *
 */


use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\RIM\Extensions\DeceasedTime;
use PHPHealth\tests\MyTestCase;

class DeceasedTime_test extends MyTestCase
{
    public function test_past_value()
    {
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<ext:deceasedTime value="20100101000000"/>

XML;

        $deceased_time = new DeceasedTime(new TimeStamp(new \DateTime('2010-01-01', new \DateTimeZone('Australia/Hobart'))));
        $dom           = new \DOMDocument('1.0', 'UTF-8');
        $doc           = $deceased_time->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

    public function test_future_value()
    {
        $future_date = new \DateTime('+10 days', new \DateTimeZone('Australia/Hobart'));
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The deceased date can not be in the future!');
        $deceased_time = new DeceasedTime(new TimeStamp($future_date));
    }

}