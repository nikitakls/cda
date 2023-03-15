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
 *
 * see page 70 of EventSummary_CDAImplementationGuide_v1.3.pdf
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_ExtEffectiveTime
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_ExtEffectiveTime
 *
 */


use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\RIM\Extensions\ExtEffectiveTime;
use PHPHealth\tests\MyTestCase;

class ExtEffectiveTime_test extends MyTestCase
{
    public function test_tag()
    {
        $expected          = <<<XML
<?xml version="1.0" encoding="UTF-8"?>

<ext:effectiveTime xsi:type="IVL_TS">
    <low value="20050101010100+1100" />
    <high value="20250101010100+1100" />
</ext:effectiveTime>

XML;
        $tag               = new ExtEffectiveTime(new IntervalOfTime(
          (new TimeStamp(
            new \DateTime('2005-01-01 01:01:00', new \DateTimeZone('+1100'))
          ))->setPrecision(TimeStamp::PRECISION_SECONDS)->setOffset(true),
          (new TimeStamp(
            new \DateTime('2025-01-01 01:01:00', new \DateTimeZone('+1100'))
          ))->setPrecision(TimeStamp::PRECISION_SECONDS)->setOffset(true)
        ));
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

}