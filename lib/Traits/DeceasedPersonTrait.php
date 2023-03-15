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


use PHPHealth\CDA\RIM\Extensions\DeceasedInd;
use PHPHealth\CDA\RIM\Extensions\DeceasedTime;

/**
 * Trait DeceasedIndTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait DeceasedPersonTrait
{
    /** @var DeceasedInd */
    private $deceased_ind;
    /** @var DeceasedTime */
    private $deceased_time;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderDeceasedPerson(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasDeceasedInd()) {
            $el->appendChild($this->getDeceasedInd()->toDOMElement($doc));
            if ($this->hasDeceasedTime()) {
                $el->appendChild($this->getDeceasedTime()->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDeceasedInd(): bool
    {
        return null !== $this->deceased_ind;
    }

    /**
     * @return DeceasedInd
     */
    public function getDeceasedInd(): DeceasedInd
    {
        return $this->deceased_ind;
    }

    /**
     * @param DeceasedInd $deceased_ind
     *
     * @return self
     */
    public function setDeceasedInd(DeceasedInd $deceased_ind): self
    {
        $this->deceased_ind = $deceased_ind;
        return $this;
    }

    /**
     * @return bool
     */
    public
    function hasDeceasedTime(): bool
    {
        return null !== $this->deceased_time;
    }

    /**
     * @return DeceasedTime
     */
    public
    function getDeceasedTime(): DeceasedTime
    {
        return $this->deceased_time;
    }

    /**
     * @param DeceasedTime $deceased_time
     *
     * @return self
     */
    public
    function setDeceasedTime(
      DeceasedTime $deceased_time
    ): self {
        $this->deceased_time = $deceased_time;
        return $this;
    }
}