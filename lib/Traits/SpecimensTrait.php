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


use PHPHealth\CDA\RIM\Participation\Specimen;

/**
 * Trait SpecimensTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait SpecimensTrait
{
    /** @var Specimen[] */
    private $specimens = [];
    /**
     * @return bool
     */

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderSpecimens(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasSpecimens()) {
            foreach ($this->getSpecimens() as $specimen) {
                $el->appendChild($specimen->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSpecimens(): bool
    {
        return \count($this->specimens) > 0;
    }

    /**
     * @return Specimen[]
     */
    public function getSpecimens(): array
    {
        return $this->specimens;
    }

    /**
     * @param Specimen[] $specimens
     *
     * @return self
     */
    public function setSpecimens(array $specimens): self
    {
        foreach ($specimens as $specimen) {
            if ($specimen instanceof Specimen) {
                $this->addSpecimen($specimen);
            }
        }
        return $this;
    }

    /**
     * @param Specimen $specimen
     *
     * @return self
     */
    public function addSpecimen(Specimen $specimen): self
    {
        $this->specimens[] = $specimen;
        return $this;
    }


}