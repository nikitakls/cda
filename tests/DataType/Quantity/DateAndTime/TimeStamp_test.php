<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.fastre@champs-libres.coop
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


namespace PHPHealth\tests\classes\CDA\Tests\DataType\Quantity\DateAndTime;

use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\tests\MyTestCase;

/**
 * tests for TimeStampTest
 *
 * @author     julien
 * @group      CDA
 * @group      CDA_TimeStamp
 *
 * phpunit-debug  --no-coverage --group CDA_TimeStamp
 */
class TimeStamp_test extends MyTestCase
{
    public function test_EffectiveTime()
    {
        $ts = new TimeStamp();
        $ts->setDate(\DateTime::createFromFormat(\DateTime::ATOM,
          '2009-12-12T17:21:51-0500'));

        $doc = new \DOMDocument('1.0', 'UTF-8');

        $el = $doc->createElement('effectiveTime');
        $doc->appendChild($el);

        $ts->setValueToElement($el, $doc);

        $expected = <<<'CDA'
<effectiveTime value="20091212172151"/>
CDA;

        $this->assertXmlStringEqualsXmlString($expected, $doc->saveXML($el));
    }

    public function test_WithPrecision()
    {
        $ts = new TimeStamp();
        $ts->setDate(\DateTime::createFromFormat(\DateTime::ATOM, '2009-12-12T17:21:51-0500'))
          ->setPrecision(TimeStamp::PRECISION_DAY);

        $doc = new \DOMDocument('1.0', 'UTF-8');

        $el = $doc->createElement('effectiveTime');
        $doc->appendChild($el);

        $ts->setValueToElement($el, $doc);

        $expected = <<<'CDA'
<effectiveTime value="20091212"/>
CDA;

        $this->assertXmlStringEqualsXmlString($expected, $doc->saveXML($el));
    }

    public function test_WithOffsetOnFalse()
    {
        $ts = new TimeStamp();
        $ts->setDate(\DateTime::createFromFormat(\DateTime::ATOM, '2009-12-12T17:21:51-0500'))
          ->setPrecision(TimeStamp::PRECISION_SECONDS);

        $doc = new \DOMDocument('1.0', 'UTF-8');

        $el = $doc->createElement('effectiveTime');
        $doc->appendChild($el);

        $ts->setValueToElement($el, $doc);

        $expected = <<<'CDA'
<effectiveTime value="20091212172151"/>
CDA;

        $this->assertXmlStringEqualsXmlString($expected, $doc->saveXML($el));
    }

    public function test_WithOffsetOnTrue()
    {
        $ts = new TimeStamp();
        $ts->setDate(\DateTime::createFromFormat(\DateTime::ATOM,
          '2009-12-12T17:21:51-0500'))
          ->setPrecision(TimeStamp::PRECISION_SECONDS)
          ->setOffset(true);

        $doc = new \DOMDocument('1.0', 'UTF-8');

        $el = $doc->createElement('effectiveTime');
        $doc->appendChild($el);

        $ts->setValueToElement($el, $doc);

        $expected = <<<'CDA'
<effectiveTime value="20091212172151-0500"/>
CDA;

        $this->assertXmlStringEqualsXmlString($expected, $doc->saveXML($el));
    }
}
