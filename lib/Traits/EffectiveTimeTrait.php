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


namespace PHPHealth\CDA\Traits;


use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Interval\PeriodicIntervalOfTime;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Elements\EffectiveTime;

/**
 * Trait EffectiveTimeTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait EffectiveTimeTrait
{
    /** @var  EffectiveTime */
    private $effectiveTime;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderEffectiveTime(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasEffectiveTime()) {
            $el->appendChild($this->getEffectiveTime()->toDOMElement($doc));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasEffectiveTime(): bool
    {
        return null !== $this->effectiveTime;
    }

    /**
     * @return EffectiveTime
     */
    public function getEffectiveTime(): EffectiveTime
    {
        return $this->effectiveTime;
    }

    /**
     * can take a number of input parameter class types, converts to effective time.
     *
     * @param TimeStamp|PeriodicIntervalOfTime|IntervalOfTime|EffectiveTime $in
     *
     * @return self
     */
    public function setEffectiveTime($in): self
    {
        if ($in instanceof TimeStamp
            || $in instanceof PeriodicIntervalOfTime
            || $in instanceof IntervalOfTime) {
            $this->effectiveTime = new EffectiveTime($in);
        } elseif ($in instanceof EffectiveTime) {
            $this->effectiveTime = $in;
        }
        return $this;
    }
}