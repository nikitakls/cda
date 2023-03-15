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

namespace PHPHealth\CDA\DataType\TextAndMultimedia;

use PHPHealth\CDA\DataType\AnyType;

/**
 *
 * The CDA description is :
 * ========================
 *
 * BIN is a raw block of bits. BIN is a protected type that should not be
 * declared outside the data type specification. A bit is semantically identical
 * with a non-null BL value. Thus, all binary data is — semantically — a
 * sequence of non-null BL values.
 *
 * In this library
 * ===============
 *
 * The content is inserted inside a simple content.
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class BinaryData extends AnyType
{
    /**
     * the content
     *
     * @var mixed
     */
    private $content;

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        $content = new \DOMText($this->getContent());
        $el->appendChild($content);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /** @noinspection ReturnTypeCanBeDeclaredInspection */

    /**
     * @param $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function returnEncapsuledData(): EncapsuledData
    {
        if ($this instanceof EncapsuledData) {
            return $this;
        }
        throw new \RuntimeException('This call is only valid from an Encapsuled data object');
    }
}
