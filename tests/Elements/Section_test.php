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

namespace PHPHealth\tests\classes\CDA\Elements;

/**
 * see page 69 of EventSummary_CDAImplementationGuide_v1.3.pdf
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 *
 * @group       CDA
 * @group       CDA_Component
 * @group       CDA_Component_section
 *
 * phpunit-debug  --no-coverage --group CDA_Component_section
 *
 */


use PHPHealth\CDA\Component\SingleComponent\Section;
use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Html\Table;
use PHPHealth\CDA\Elements\Html\TableCell;
use PHPHealth\CDA\Elements\Html\Text;
use PHPHealth\CDA\Elements\Html\Title;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\RIM\Extensions\ExtCode;
use PHPHealth\CDA\RIM\Extensions\ExtCoverage2;
use PHPHealth\CDA\RIM\Extensions\ExtEffectiveTime;
use PHPHealth\CDA\RIM\Extensions\ExtEntitlement;
use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\CDA\RIM\Extensions\ExtParticipant;
use PHPHealth\CDA\RIM\Extensions\ExtParticipantRole;
use PHPHealth\tests\MyTestCase;

class Section_test extends MyTestCase
{
    public function test_tag()
    {
        $expected          = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<section>
  <id root="88CDBCA4-EFD1-11DF-8DE4-E4CDDFD72085"/>
  <code code="102.16080" codeSystem="1.2.36.1.2001.1001.101" codeSystemName="NCTIS Data Components" displayName="Administrative Observations"/>
  <title>Administrative Observations</title>
  <!-- Begin Narrative text -->
  <text>
    <table>
      <tbody>
        <tr>
          <th>Australian Medicare Prescriber Number</th>
          <td>049960CT</td>
        </tr>
      </tbody>
    </table>
  </text>
  <!-- End Narrative text -->
  <!-- Begin Document Author Healthcare Provider Entitlement -->
  <ext:coverage2 typeCode="COVBY">
    <ext:entitlement classCode="COV" moodCode="EVN">
      <ext:id assigningAuthorityName="Medicare Prescriber number" root="1.2.36.174030967.0.3" extension="049960CT" />
      <ext:code code="10" codeSystem="1.2.36.1.2001.1001.101.104.16047" codeSystemName="NCTIS Entitlement Type Values" displayName="Medicare Prescriber Number" />
      <ext:effectiveTime xsi:type="IVL_TS">
        <low value="20050101010100+1100" />
        <high value="20250101010100+1100" />
      </ext:effectiveTime>
      <ext:participant typeCode="HLD">
        <ext:participantRole classCode="ASSIGNED">
        <!-- Same as the author (assignedAuthor) id -->
            <ext:id root="7FCB0EC4-0CD0-11E0-9DFC-8F50DFD72085" />
        </ext:participantRole>
      </ext:participant>
    </ext:entitlement>
  </ext:coverage2>
</section>

XML;
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $section = (new Section(
          Id::fromString('88CDBCA4-EFD1-11DF-8DE4-E4CDDFD72085'),
          Code::NCTIS('102.16080', 'Administrative Observations'),
          new Title('Administrative Observations'),
          new Text(
            (new Table())
              ->getTbody()
              ->createRow()
              ->createCell('Australian Medicare Prescriber Number', TableCell::TH)->getRow()
              ->createCell('049960CT')->getRow()
              ->getSection()
              ->getTable()
          )
        ))
          ->setMoodCode('')
          ->setClassCode('')
          ->setExtCoverage2(
            new ExtCoverage2(
              new ExtEntitlement(
                new ExtId('Medicare Prescriber number', '1.2.36.174030967.0.3', '049960CT'),
                new ExtCode(null, new CodedValue(
                  '10',
                  'Medicare Prescriber Number',
                  '1.2.36.1.2001.1001.101.104.16047',
                  'NCTIS Entitlement Type Values')),
                new ExtEffectiveTime(new IntervalOfTime(
                  (new TimeStamp(
                    new \DateTime('2005-01-01 01:01:00', new \DateTimeZone('+1100'))
                  ))->setPrecision(TimeStamp::PRECISION_SECONDS)->setOffset(true),
                  (new TimeStamp(
                    new \DateTime('2025-01-01 01:01:00', new \DateTimeZone('+1100'))
                  ))->setPrecision(TimeStamp::PRECISION_SECONDS)->setOffset(true)
                )),
                new ExtParticipant(
                  new ExtParticipantRole(
                    new ExtId('', '7FCB0EC4-0CD0-11E0-9DFC-8F50DFD72085')
                  )
                )
              )
            )
          );
        $doc     = $section->toDOMElement($dom);
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

}