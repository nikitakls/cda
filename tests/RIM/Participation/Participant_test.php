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

namespace PHPHealth\tests\classes\CDA\Tests\RIM\Participation;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * @group       CDA
 * @group       CDA_RIM
 * @group       CDA_RIM_Participant
 *
 * phpunit-debug  --no-coverage --group CDA_RIM_Participant
 *
 */


use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\RIM\Participation\Participant;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Entity\PlayingEntity;
use PHPHealth\CDA\RIM\Role\ParticipantRole;
use PHPHealth\tests\MyTestCase;


class Participant_test extends MyTestCase
{
    /**
     * see page 113 of EventSummary_CDAImplementationGuide_v1.3.pdf
     */
    public function test_tag()
    {
        $expected = <<<'CDA'
<!-- Begin Substance/Agent -->
<participant typeCode="CAGNT">
  <participantRole>
    <playingEntity>
        <code code="385420005" codeSystem="2.16.840.1.113883.6.96" codeSystemName="SNOMED CT" displayName="Contrast media" />
    </playingEntity>
  </participantRole>
</participant>
<!-- End Substance/Agent -->
CDA;
        $tag      = new Participant(
          (new ParticipantRole(
            (new PlayingEntity(Code::SNOMED('385420005', 'Contrast media')
            ))->setClassCode('')
          ))->setClassCode('')
        );
        $tag->setTypeCode(TypeCodeInterface::CAUSATIVE_AGENT)
          ->setContextControlCode('');

        $dom               = new \DOMDocument('1.0', 'UTF-8');
        $doc               = $tag->toDOMElement($dom);
        $dom->formatOutput = true;
        $dom->appendChild($doc);
        $cda = $dom->saveXML();
        $this->assertXmlStringEqualsXmlString($expected, $cda);
    }
}
