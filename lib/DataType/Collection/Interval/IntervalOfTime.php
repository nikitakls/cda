<?php
/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

namespace PHPHealth\CDA\DataType\Collection\Interval;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Interfaces\XSITypeInterface;


/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class IntervalOfTime extends AbstractInterval
{
    /** @var TimeStamp */
    private $low;

    /** @var TimeStamp */
    private $high;

    /** @var bool */
    private $showXSIType;

    /**
     * IntervalOfTime constructor.
     *
     * @param TimeStamp $low
     * @param TimeStamp $high
     */
    public function __construct($low = null, $high = null)
    {
        if ($low instanceof TimeStamp) {
            $this->setLow($low);
        }
        if ($high instanceof TimeStamp) {
            $this->setHigh($high);
        }
        $this->setShowXSIType(true);
    }

    /**
     * @return TimeStamp
     */
    public function getLow(): TimeStamp
    {
        return $this->low;
    }

    /**
     * @param TimeStamp $low
     *
     * @return self
     */
    public function setLow(TimeStamp $low): self
    {
        $this->low = $low;
        return $this;
    }

    /**
     * @return TimeStamp
     */
    public function getHigh(): TimeStamp
    {
        return $this->high;
    }

    /**
     * @param TimeStamp $high
     *
     * @return self
     */
    public function setHigh(TimeStamp $high): self
    {
        $this->high = $high;
        return $this;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->hasLow()) {
            $low = $doc->createElement(CDA::NS_CDA . 'low');
            $this->low->setValueToElement($low, $doc);
            $el->appendChild($low);
        }
        if ($this->hasHigh()) {
            $high = $doc->createElement(CDA::NS_CDA . 'high');
            $this->high->setValueToElement($high, $doc);
            $el->appendChild($high);
        }
        if ($this->isShowXSIType()) {
            $el->setAttribute('xsi:type', XSITypeInterface::INTERVAL_TIMESTAMP);
        }
    }

    /**
     * @return bool
     */
    public function hasLow(): bool
    {
        return null !== $this->low;
    }

    /**
     * @return bool
     */
    public function hasHigh(): bool
    {
        return null !== $this->high;
    }

    /**
     * @return bool
     */
    public function isShowXSIType(): bool
    {
        return $this->showXSIType;
    }

    /**
     * @param bool $showXSIType
     *
     * @return IntervalOfTime
     */
    public function setShowXSIType(bool $showXSIType): IntervalOfTime
    {
        $this->showXSIType = $showXSIType;
        return $this;
    }
}
