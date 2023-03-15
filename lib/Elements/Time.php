<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.
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

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Interval\PeriodicIntervalOfTime;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;

/**
 * @author julien
 */
class Time extends AbstractElement
{
    /**
     *
     * @var TimeStamp
     */
    protected $time;

    /**
     * Time constructor.
     *
     * @param null $time
     */
    public function __construct($time)
    {
        $this->setTime($time);
    }

    /**
     * @return TimeStamp|IntervalOfTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param TimeStamp|IntervalOfTime $in
     *
     * @return self
     */
    public function setTime($in): self
    {
        if ($in instanceof TimeStamp || $in instanceof IntervalOfTime || $in instanceof PeriodicIntervalOfTime) {
            $this->time = $in;
        }
        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc, array('time'));
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'time';
    }
}
