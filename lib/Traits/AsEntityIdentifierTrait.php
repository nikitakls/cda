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


use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;

/**
 * Trait AsEntityIdentifierTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait AsEntityIdentifierTrait
{
    /** @var AsEntityIdentifier */
    private $as_entity_identifier;

    /**
     * @return bool
     */
    public function hasAsEntityIdentifier(): bool { return null !== $this->as_entity_identifier; }

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderAsEntityIdentifier(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasAsEntityIdentifier()) {
            $el->appendChild($this->getAsEntityIdentifier()->toDOMElement($doc));
        }
        return $this;
    }

    /**
     * @return AsEntityIdentifier
     */
    public function getAsEntityIdentifier(): AsEntityIdentifier
    {
        return $this->as_entity_identifier;
    }

    /**
     * @param AsEntityIdentifier $as_entity_identifier
     *
     * @return self
     */
    public function setAsEntityIdentifier(AsEntityIdentifier $as_entity_identifier): self
    {
        $this->as_entity_identifier = $as_entity_identifier;
        return $this;
    }

}