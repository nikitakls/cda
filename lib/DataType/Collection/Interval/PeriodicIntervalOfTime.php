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
use PHPHealth\CDA\Traits\XSITypeTrait;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class PeriodicIntervalOfTime extends AbstractInterval
{
    use XSITypeTrait;
    /**
     *
     * @var \DateInterval
     */
    protected $period;

    /**
     *
     * @var boolean
     */
    protected $institutionSpecified;


    /** @var string */
    private $tag;

    /** @var TimeStamp */
    private $center;

    /**
     * PeriodicIntervalOfTime constructor.
     *
     * @param \DateInterval $period
     */
    public function __construct(\DateInterval $period)
    {
        $this->setPeriod($period)
          ->setXSIType(XSITypeInterface::PERIODIC_TIME_INTERVAL)
          ->setTag('period');
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     *
     * @throws \Exception
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->getXSIType()) {
            $el->setAttributeNS(CDA::NS_XSI_URI, 'xsi:type', $this->getXSIType());
        }
        if ($this->hasInstitutionSpecified()) {
            $el->setAttribute(CDA::NS_CDA . 'institutionSpecified',
              $this->getInstitutionSpecified()
                ? 'true'
                : 'false');
        }

        if ($this->hasCenter()) {
            $center = $doc->createElement(CDA::NS_CDA . 'center');
            $this->getCenter()->setValueToElement($center, $doc);
            $el->appendChild($center);
        }
        list($unit, $value) = $this->processPeriod();
        $period = $doc->createElement(CDA::NS_CDA . $this->getTag());
        $period->setAttribute(CDA::NS_CDA . 'unit', $unit);
        $period->setAttribute(CDA::NS_CDA . 'value', $value);

        $el->appendChild($period);
    }


    /**
     * @return bool
     */
    public function hasInstitutionSpecified(): bool
    {
        return null !== $this->institutionSpecified;
    }

    /**
     * @return bool
     */
    public function getInstitutionSpecified(): bool
    {
        return $this->institutionSpecified;
    }

    /**
     * @param $institutionSpecified
     *
     * @return self
     */
    public function setInstitutionSpecified($institutionSpecified): self
    {
        $this->institutionSpecified = $institutionSpecified;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCenter(): bool
    {
        return null !== $this->center;
    }

    /**
     * @return TimeStamp
     */
    public function getCenter(): TimeStamp
    {
        return $this->center;
    }

    /**
     * @param TimeStamp $center
     *
     * @return PeriodicIntervalOfTime
     */
    public function setCenter(TimeStamp $center): self
    {
        $this->center = $center;
        return $this;
    }

    /**
     * return an array where the first element is the unit, and the
     * second the unit
     */
    protected function processPeriod(): array
    {
        $seconds = (int)$this->getPeriod()->format('%s');
        $minutes = (int)$this->getPeriod()->format('%i');
        $hours   = (int)$this->getPeriod()->format('%h');
        $days    = (int)$this->getPeriod()->format('%d');
        $months  = (int)$this->getPeriod()->format('%m');

        if ($months !== 0) {
            return ['mo', $months];
        }
        if ($days !== 0) {
            return ['d', $days];
        }
        if ($hours !== 0) {
            return ['h', $hours];
        }
        if ($minutes !== 0) {
            return ['min', $minutes];
        }
        if ($seconds !== 0) {
            return ['s', $seconds];
        }
        return ['', ''];
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     *
     * @return self
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return \DateInterval
     */
    public function getPeriod(): \DateInterval
    {
        return $this->period;
    }

    /**
     * @param \DateInterval $period
     *
     * @return self
     */
    public function setPeriod(\DateInterval $period): self
    {
        $this->period = $period;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasPeriod(): bool
    {
        return null !== $this->period;
    }

}
