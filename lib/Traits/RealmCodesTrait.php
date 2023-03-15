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

use PHPHealth\CDA\ClinicalDocument as CDA;

/**
 * Trait RealmCodeTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait RealmCodesTrait
{
    /** @var string[] */
    private $realmCodes = [];

    /**
     * @param array $realm_codes
     *
     * @return self
     */
    public function setRealmCode(array $realm_codes): self
    {
        foreach ($realm_codes as $realm_code) {
            if (\is_string($realm_code)) {
                $this->addRealmCode($realm_code);
            }
        }
        return $this;
    }

    public function addRealmCode(string $realm_code): self
    {
        $this->realmCodes[] = $realm_code;
        return $this;
    }

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderRealmCodes(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasRealmCode()) {
            foreach ($this->getRealmCodes() as $realm_code) {
                $realmCodeEl = $doc->createElement(CDA::NS_CDA . 'realmCode');
                $realmCodeEl->setAttribute('code', $realm_code);
                $el->appendChild($realmCodeEl);
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRealmCode(): bool
    {
        return \count($this->realmCodes) > 0;
    }

    /**
     * @return string[]
     */
    public function getRealmCodes(): array
    {
        return $this->realmCodes;
    }
}