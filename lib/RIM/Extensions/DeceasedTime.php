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

namespace PHPHealth\CDA\RIM\Extensions;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */


use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * Class DeceasedTime
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class DeceasedTime extends AbstractElement
{
    /** @var TimeStamp */
    protected $value;

    /**
     * DeceasedTime constructor.
     *
     * @param TimeStamp $value
     */
    public function __construct(TimeStamp $value)
    {
        $this->setValue($value);
    }

    /**
     * @return TimeStamp
     */
    public function getValue(): TimeStamp
    {
        return $this->value;
    }

    /**
     * @param TimeStamp $value
     *
     * @return DeceasedTime
     */
    public function setValue(TimeStamp $value): DeceasedTime
    {
        if ($value->getDate()) {
            $now = new \DateTime(null, $value->getDate()->getTimezone());
            if ($value->getDate() > $now) {
                throw new \InvalidArgumentException('The deceased date can not be in the future!');
            }
            $this->value = $value;
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
        return $this->createElement($doc, array('value'));
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'ext:deceasedTime';
    }
}