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


namespace PHPHealth\CDA\Elements;


use PHPHealth\CDA\DataType\Code\CharacterStringWithCode;

class SoftwareName extends AbstractElement
{

    /** @var CharacterStringWithCode */
    protected $character_string_with_code;

    public function __construct($cs_code = null)
    {
        if ($cs_code instanceof CharacterStringWithCode) {
            $this->setCharacterStringWithCode($cs_code);
        }
    }

    /**
     * sets the code attributes and set the text of the tag to the display version of the software
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if ($this->hasCharacterStringWithCode()) {
            $cs_code = $this->getCharacterStringWithCode();
            $el->appendChild($doc->createTextNode($cs_code->getDisplayName()));
            $cs_code->setValueToElement($el, $doc);
        }
        return $el;
    }

    public function hasCharacterStringWithCode(): bool
    {
        return null !== $this->character_string_with_code;
    }

    /**
     * @return CharacterStringWithCode
     */
    public function getCharacterStringWithCode(): CharacterStringWithCode
    {
        return $this->character_string_with_code;
    }

    /**
     * @param CharacterStringWithCode $character_string_with_code
     *
     * @return SoftwareName
     */
    public function setCharacterStringWithCode(CharacterStringWithCode $character_string_with_code): SoftwareName
    {
        $this->character_string_with_code = $character_string_with_code;
        return $this;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'softwareName';
    }

}