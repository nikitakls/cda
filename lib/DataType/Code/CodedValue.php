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

/**
 * Coded data, specifying only a code, code system, and optionally display name
 * and original text. Used only as the type of properties of other data types.
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class CodedValue extends CodedWithEquivalents
{
    protected $codeSystemVersion;
    /**
     * @var string
     */
    private $tagName;

    /**
     * CodedValue constructor.
     *
     * @param $code
     * @param $displayName
     * @param $codeSystem
     * @param $codeSystemName
     */
    public function __construct(
      $code,
      $displayName,
      $codeSystem,
      $codeSystemName,
      $codeSystemVersion = null
    ) {
        $this->setCode($code);
        if($displayName){
            $this->setDisplayName($displayName);
        }
        if($codeSystem){
            $this->setCodeSystem($codeSystem);
        }
        if($codeSystemName){
            $this->setCodeSystemName($codeSystemName);
        }
        if($codeSystemVersion){
            $this->setCodeSystemVersion($codeSystemVersion);
        }
    }

    public function setCodeSystemVersion(string $version){
        $this->codeSystemVersion = $version;
        return $this;
    }

    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        parent::setValueToElement($el, $doc);

        if($this->codeSystemVersion){
            $el->setAttribute('codeSystemVersion', $this->codeSystemVersion);
        }
    }

    public function setTagName(string $tagName){
        $this->tagName = $tagName;
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }
}
