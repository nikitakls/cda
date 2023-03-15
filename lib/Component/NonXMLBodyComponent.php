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

namespace PHPHealth\CDA\Component;

use PHPHealth\CDA\ClinicalDocument as CD;
use PHPHealth\CDA\DataType\TextAndMultimedia\EncapsuledData;

/**
 * Component which contains unstructured content
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class NonXMLBodyComponent extends AbstractComponent
{
    /**
     *
     * @var EncapsuledData
     */
    private $content;

    /**
     * @return EncapsuledData
     */
    public function getContent(): EncapsuledData
    {
        return $this->content;
    }

    /**
     * @param EncapsuledData $content
     *
     * @return self
     */
    public function setContent(EncapsuledData $content): self
    {
        $this->content = $content;
        return $this;
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $component = $this->createElement($doc);
        $text      = $doc->createElement(CD::NS_CDA . 'text');
        $this->content->setValueToElement($text, $doc);
        $component->appendChild($text);
        return $component;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'nonXMLBody';
    }
}
