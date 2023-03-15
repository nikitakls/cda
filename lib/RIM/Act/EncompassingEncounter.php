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
 */


namespace PHPHealth\CDA\RIM\Act;


use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Interval\PeriodicIntervalOfTime;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodedValueTrait;
use PHPHealth\CDA\Traits\DischargeDispositionCodeTrait;
use PHPHealth\CDA\Traits\EffectiveTimeTrait;
use PHPHealth\CDA\Traits\EncounterParticipantsTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\LocationTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\ResponsiblePartyTrait;

/**
 * Class EncompassingEncounter
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class EncompassingEncounter extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use IdsTrait;
    use CodedValueTrait;
    use EffectiveTimeTrait;
    use EncounterParticipantsTrait;
    use DischargeDispositionCodeTrait;
    use ResponsiblePartyTrait;
    use LocationTrait;

    use ClassCodeTrait;
    use MoodCodeTrait;

    /**
     * EncompassingEncounter constructor.
     *
     * @param TimeStamp|PeriodicIntervalOfTime|IntervalOfTime $effectiveTime
     */
    public function __construct($effectiveTime = null)
    {
        $this->setAcceptableClassCodes(['', ClassCodeInterface::ENCOUNTER])
          ->setAcceptableMoodCodes(['', MoodCodeInterface::EVENT])
          ->setClassCode(ClassCodeInterface::ENCOUNTER)
          ->setMoodCode('');
        if ($effectiveTime) {
            $this->setEffectiveTime($effectiveTime);
        }
    }

    /**
     * Transforms the element into a DOMElement, which will be included
     * into the final CDA XML
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc);
        $this->renderCodedValue($el, $doc);
        $this->renderEffectiveTime($el, $doc);
        $this->renderDischargeDispositionCode($el, $doc);

        // responsibleParty
        $this->renderEncounterParticipants($el, $doc);
        $this->renderLocation($el, $doc);
        // location
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'encompassingEncounter';
    }
}