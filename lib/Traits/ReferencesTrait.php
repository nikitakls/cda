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

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */


namespace PHPHealth\CDA\Traits;


use PHPHealth\CDA\Elements\Html\ReferenceElement;

/**
 * Trait ReferencesTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait ReferencesTrait
{

    /** @var ReferenceElement[] */
    private $references = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderReferences(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasReferences()) {
            foreach ($this->getReferences() as $reference) {
                $el->appendChild($reference->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasReferences(): bool
    {
        return \count($this->references) > 0;
    }

    /**
     * @return ReferenceElement[]
     */
    public function getReferences(): array
    {
        return $this->references;
    }

    /**
     * @param ReferenceElement[] $references
     *
     * @return self
     */
    public function setReferences(array $references): self
    {
        foreach ($references as $reference) {
            if ($reference instanceof ReferenceElement) {
                $this->addReference($reference);
            }
        }
        return $this;
    }

    /**
     * @param ReferenceElement $reference_element
     *
     * @return self
     */
    public function addReference(ReferenceElement $reference_element): self
    {
        $this->references[] = $reference_element;
        return $this;
    }


}