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
 * Trait EffectiveTimesTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait EffectiveTimesTrait
{
    /** @var  EffectiveTime[] */
    private $effectiveTimes = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderEffectiveTimes(\DOMElement $el, \DOMDocument $doc): self
    {
        $first = true;
        if ($this->hasEffectiveTimes()) {
            foreach ($this->getEffectiveTimes() as $effective_time) {
                if (!$first) {
                    $effective_time->setOperatorAppend();
                }

                $el->appendChild($effective_time->toDOMElement($doc));

                $first = false;
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasEffectiveTimes(): bool
    {
        return \count($this->effectiveTimes) > 0;
    }

    /**
     * @return EffectiveTime[]
     */
    public function getEffectiveTimes(): array
    {
        return $this->effectiveTimes;
    }

    /**
     * @param EffectiveTime[] $effectiveTimes
     *
     * @return self
     */
    public function setEffectiveTimes(array $effectiveTimes): self
    {
        foreach ($effectiveTimes as $effective_time) {
            $this->addEffectiveTime($effective_time);
        }
        return $this;
    }

    /**
     * @param $in
     *
     * @return EffectiveTimesTrait
     */
    public function addEffectiveTime($in): self
    {
        if ($in instanceof TimeStamp
            || $in instanceof PeriodicIntervalOfTime
            || $in instanceof IntervalOfTime) {
            $this->effectiveTimes[] = new EffectiveTime($in);
        } elseif ($in instanceof EffectiveTime) {
            $this->effectiveTimes[] = $in;
        }
        return $this;
    }
}