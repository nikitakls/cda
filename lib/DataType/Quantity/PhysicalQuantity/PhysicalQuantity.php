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

namespace PHPHealth\CDA\DataType\Quantity\PhysicalQuantity;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\Quantity\AbstractQuantity;

/**
 * A dimensioned quantity expressing the result of measuring.
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class PhysicalQuantity extends AbstractQuantity
{
    /** @var string */
    protected $ucumUnit;

    /** @var string */
    protected $value;

    /**
     * PhysicalQuantity constructor.
     *
     * @param $ucumUnit
     * @param $value
     */
    public function __construct(string $ucumUnit = '', string $value = '')
    {
        if ($ucumUnit) {
            $this->setUcumUnit($ucumUnit);
        }
        if ($value) {
            $this->setValue($value);
        }
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->hasValue()) {
            $el->setAttributeNS(CDA::NS_CDA, 'value', $this->getValue());
        }

        if ($this->hasUcumUnit()) {
            $el->setAttributeNS(CDA::NS_CDA, 'unit', $this->getUcumUnit());
        }
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return empty($this->value) === false;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasUcumUnit(): bool
    {
        return empty($this->ucumUnit) === false;
    }

    /**
     * @return mixed
     */
    public function getUcumUnit()
    {
        return $this->ucumUnit;
    }

    /**
     * @param $ucumUnit
     *
     * @return self
     */
    public function setUcumUnit($ucumUnit): self
    {
        $this->ucumUnit = $ucumUnit;
        return $this;
    }
}
