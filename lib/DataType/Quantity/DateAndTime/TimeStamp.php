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

namespace PHPHealth\CDA\DataType\Quantity\DateAndTime;

use PHPHealth\CDA\ClinicalDocument as CD;
use PHPHealth\CDA\DataType\Quantity\AbstractQuantity;

/**
 * A quantity specifying a point on the axis of natural time. A point in time is
 *  most often represented as a calendar expression.
 *
 * Semantically, however, time is independent from calendars and best described
 * by its relationship to elapsed time (measured as a physical quantity in the
 * dimension of time). A TS plus an elapsed time yields another TS. Inversely,
 * a TS minus another TS yields an elapsed time.
 *
 * As nobody knows when time began, a TS is conceptualized as the amount of time
 * that has elapsed from some arbitrary zero-point, called an epoch. Because
 * there is no absolute zero-point on the time axis; natural time is a
 * difference-scale quantity, where only differences are defined but no ratios.
 * (For example, no TS is — absolutely speaking — "twice as late" as another TS.)
 *
 * Given some arbitrary zero-point, one can express any point in time as an
 * elapsed time measured from that offset. Such an arbitrary zero-point is
 * called an epoch. This epoch-offset form is used as a semantic representation
 * here, without implying that any system would have to implement TS in that
 * way. Systems that do not need to compute distances between TSs will not need
 * any other representation than a calendar expression literal.
 *
 *
 * **note about implementation**
 *
 * **Offset** : the offset will be extracted from the given \DateTime. Set offset
 * to true if offset is required. The offset will be inserted only if the precision
 * is set to seconds (14)
 *
 *
 * @author julien.fastre@champs-libres.coop
 */
class TimeStamp extends AbstractQuantity
{
    const DATE_FORMAT       = 'YmdHis';
    const PRECISION_DAY     = 8;
    const PRECISION_HOURS   = 10;
    const PRECISION_MINUTES = 12;
    const PRECISION_SECONDS = 14;

    /** @var \DateTime */
    private $date;

    /** @var int */
    private $precision;

    /** @var bool */
    private $offset = false;

    /**
     * TimeStamp constructor.
     *
     * @param \DateTime|NULL $datetime
     */
    public function __construct(\DateTime $datetime = null)
    {
        $this->date      = $datetime ?? new \DateTime();
        $this->precision = self::PRECISION_SECONDS;
    }

    public static function fromString(string $in, $tz = 'UTC', int $precision = self::PRECISION_MINUTES): TimeStamp
    {
        $dt         = new \DateTime($in, new \DateTimeZone($tz));
        $time_stamp = new self($dt);
        $time_stamp->setOffset($tz[0] === '+')
          ->setPrecision($precision);
        return $time_stamp;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->getDate()) {
            $value = \mb_substr(
              $this->getDate()->format(self::DATE_FORMAT),
              0,
              $this->getPrecision()
            );

            if ($this->getPrecision() >= self::PRECISION_MINUTES
                && $this->getOffset() !== false) {
                $value .= $this->getDate()->format('O');
            }

            $el->setAttributeNS(CD::NS_CDA, 'value', $value);
        }
    }

    /**
     * @return \DateTime|NULL
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return TimeStamp
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * @param int $precision
     *
     * @return TimeStamp
     */
    public function setPrecision(int $precision): self
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * @return bool
     */
    public function getOffset(): bool
    {
        return $this->offset;
    }

    /**
     * @param bool $offset
     *
     * @return TimeStamp
     */
    public function setOffset(bool $offset): self
    {
        $this->offset = $offset;
        return $this;
    }
}
