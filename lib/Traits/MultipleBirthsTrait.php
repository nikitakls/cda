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


use PHPHealth\CDA\RIM\Extensions\MultipleBirthInd;
use PHPHealth\CDA\RIM\Extensions\MultipleBirthOrderNumber;

trait MultipleBirthsTrait
{
    /** @var MultipleBirthInd */
    private $birth_ind;

    /** @var MultipleBirthOrderNumber */
    private $birth_order;


    /**
     * @param MultipleBirthInd $birth_ind
     *
     * @return self
     */
    public function setMultipleBirthInd(MultipleBirthInd $birth_ind): self
    {
        $this->birth_ind = $birth_ind;
        return $this;
    }

    /**
     * @param MultipleBirthOrderNumber $birth_order
     *
     * @return self
     */
    public function setMultipleBirthOrderNumber(MultipleBirthOrderNumber $birth_order): self
    {
        $this->birth_order = $birth_order;
        return $this;
    }

    public function renderMultipleBirths(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasMultipleBirthInd()) {
            $el->appendChild($this->getMultipleBirthInd()->toDOMElement($doc));
            if ($this->hasMultipleBirthOrderNumber()) {
                $el->appendChild($this->getMultipleBirthOrderNumber()->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMultipleBirthInd(): bool
    {
        return null !== $this->birth_ind;
    }

    /**
     * @return MultipleBirthInd
     */
    public function getMultipleBirthInd(): MultipleBirthInd
    {
        return $this->birth_ind;
    }

    /**
     * @return bool
     */
    public function hasMultipleBirthOrderNumber(): bool
    {
        return null !== $this->birth_order;
    }

    /**
     * @return MultipleBirthOrderNumber
     */
    public function getMultipleBirthOrderNumber(): MultipleBirthOrderNumber
    {
        return $this->birth_order;
    }

}