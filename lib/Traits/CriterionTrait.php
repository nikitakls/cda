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


use PHPHealth\CDA\RIM\Act\Criterion;

/**
 * Trait CriterionTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait CriterionTrait
{
    /** @var Criterion */
    private $criterion;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderCriterion(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasCriterion()) {
            $el->appendChild($this->getCriterion()->toDOMElement($doc));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCriterion(): bool
    {
        return null !== $this->criterion;
    }

    /**
     * @return Criterion
     */
    public function getCriterion(): Criterion
    {
        return $this->criterion;
    }

    /**
     * @param Criterion $criterion
     *
     * @return self
     */
    public function setCriterion(Criterion $criterion): self
    {
        $this->criterion = $criterion;
        return $this;
    }
}