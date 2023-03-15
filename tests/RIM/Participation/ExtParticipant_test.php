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

namespace PHPHealth\tests\classes\CDA\RIM\Participation;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 *
 * see page 70 of EventSummary_CDAImplementationGuide_v1.3.pdf
 * @group       CDA
 * @group       CDA_ROLE
 * @group       CDA_ROLE_ExtParticipant
 *
 * phpunit-debug  --no-coverage --group CDA_ROLE_ExtParticipant
 *
 */


use PHPHealth\CDA\RIM\Extensions\ExtId;
use PHPHealth\CDA\RIM\Extensions\ExtParticipant;
use PHPHealth\CDA\RIM\Extensions\ExtParticipantRole;
use PHPHealth\tests\MyTestCase;

class ExtParticipant_test extends MyTestCase
{
    public function test_tag()
    {
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<ext:participant typeCode="HLD">
  <ext:participantRole classCode="ASSIGNED">
  <!-- Same as the author (assignedAuthor) id -->
      <ext:id root="7FCB0EC4-0CD0-11E0-9DFC-8F50DFD72085" />
  </ext:participantRole>
</ext:participant>
XML;

        $tag               = new ExtParticipant(
          new ExtParticipantRole(
            new ExtId('', '7FCB0EC4-0CD0-11E0-9DFC-8F50DFD72085'))
        );
        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }

}