<?php

/**
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
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

namespace PHPHealth\CDA\DataType\Code;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\AnyType;

/**
 * A CD represents any kind of concept usually by giving a code defined in a
 * code system. A CD can contain the original text or phrase that served as the
 * basis of the coding and one or more translations into different coding systems.
 * A CD can also contain qualifiers to describe, e.g., the concept of a
 * "left foot" as a postcoordinated term built from the primary code "FOOT"
 * and the qualifier "LEFT". In cases of an exceptional value, the CD need
 * not contain a code but only the original text describing that concept.
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class ConceptDescriptor extends AnyType
{

    private $codeSystem;

    private $codeSystemName;

    private $displayName;

    private $originalText;

    /**
     *
     * @var string
     */
    private $code;

    /**
     * @return bool
     */
    public function hasOriginalText(): bool
    {
        return !empty($this->getOriginalText());
    }

    /**
     * @return mixed
     */
    public function getOriginalText()
    {
        return $this->originalText;
    }

    /**
     * @param $originalText
     *
     * @return self
     */
    public function setOriginalText($originalText): self
    {
        $this->originalText = $originalText;
        return $this;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        $el->setAttribute(CDA::NS_CDA . 'code', $this->getCode());

        if ($this->hasDisplayName()) {
            $el->setAttribute('displayName', $this->getDisplayName());
        }

        if ($this->hasCodeSystem()) {
            $el->setAttribute('codeSystem', $this->getCodeSystem());
        }

        if ($this->hasCodeSystemName()) {
            $el->setAttribute('codeSystemName', $this->getCodeSystemName());
        }
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param $code
     *
     * @return self
     */
    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDisplayName(): bool
    {
        return !empty($this->getDisplayName());
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param $displayName
     *
     * @return self
     */
    public function setDisplayName($displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCodeSystem(): bool
    {
        return !empty($this->getCodeSystem());
    }

    /**
     * @return mixed
     */
    public function getCodeSystem()
    {
        return $this->codeSystem;
    }

    /**
     * @param $codeSystem
     *
     * @return self
     */
    public function setCodeSystem($codeSystem): self
    {
        $this->codeSystem = $codeSystem;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCodeSystemName(): bool
    {
        return !empty($this->getCodeSystemName());
    }

    /**
     * @return mixed
     */
    public function getCodeSystemName()
    {
        return $this->codeSystemName;
    }

    /**
     * @param $codeSystemName
     *
     * @return self
     */
    public function setCodeSystemName($codeSystemName): self
    {
        $this->codeSystemName = $codeSystemName;
        return $this;
    }
}
