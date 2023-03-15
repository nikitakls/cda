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


use PHPHealth\CDA\RIM\Act\EntryRelationship;

/**
 * Trait EntryRelationshipsTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait EntryRelationshipsTrait
{
    /** @var EntryRelationship[] */
    private $entryRelationships = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderEntryRelationships(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasEntryRelationships()) {
            foreach ($this->getEntryRelationships() as $entry_relationship) {
                $el->appendChild($entry_relationship->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasEntryRelationships(): bool
    {
        return \count($this->entryRelationships) > 0;
    }

    /**
     * @return EntryRelationship[]
     */
    public function getEntryRelationships(): array
    {
        return $this->entryRelationships;
    }

    /**
     * @param EntryRelationship[] $entryRelationships
     *
     * @return self
     */
    public function setEntryRelationships(array $entryRelationships): self
    {
        foreach ($entryRelationships as $entry_relationship) {
            if ($entry_relationship instanceof EntryRelationship) {
                $this->addEntryRelationship($entry_relationship);
            }
        }
        return $this;
    }

    /**
     * @param EntryRelationship $entry_relationship
     *
     * @return self
     */
    public function addEntryRelationship(EntryRelationship $entry_relationship): self
    {
        $this->entryRelationships[] = $entry_relationship;
        return $this;
    }
}