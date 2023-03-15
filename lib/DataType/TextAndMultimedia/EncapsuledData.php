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

use PHPHealth\CDA\ClinicalDocument as CD;

/**
 * Data that is primarily intended for human interpretation or for further
 * machine processing outside the scope of HL7. This includes unformatted or
 * formatted written language, multimedia data, or structured information in as
 * defined by a different standard (e.g., XML-signatures.) Instead of the data
 * itself, an ED may contain only a reference (see TEL.) Note that ST is a
 * specialization of the ED where the mediaType is fixed to text/plain.
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class EncapsuledData extends BinaryData
{
    private $mediaType;

    private $charset;

    private $language;

    private $compression;

    private $reference;

    private $integrityCheck;

    private $intetgrityCheckAlgorithm;

    private $thumbnail;

    /**
     * @return mixed
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param $charset
     *
     * @return self
     */
    public function setCharset($charset): self
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param $language
     *
     * @return self
     */
    public function setLanguage($language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompression()
    {
        return $this->compression;
    }

    /**
     * @param $compression
     *
     * @return self
     */
    public function setCompression($compression): self
    {
        $this->compression = $compression;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param $reference
     *
     * @return self
     */
    public function setReference($reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntegrityCheck()
    {
        return $this->integrityCheck;
    }

    /**
     * @param $integrityCheck
     *
     * @return self
     */
    public function setIntegrityCheck($integrityCheck): self
    {
        $this->integrityCheck = $integrityCheck;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntegrityCheckAlgorithm()
    {
        return $this->intetgrityCheckAlgorithm;
    }

    /**
     * @param $integrityCheckAlgorithm
     *
     * @return self
     */
    public function setIntegrityCheckAlgorithm($integrityCheckAlgorithm): self
    {
        $this->intetgrityCheckAlgorithm = $integrityCheckAlgorithm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param $thumbnail
     *
     * @return self
     */
    public function setThumbnail($thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->getMediaType() && $this->getMediaType() !== 'text/plain') {
            $el->setAttribute(CD::NS_CDA . 'mediaType', $this->getMediaType());
        }

        $content = $this->getMediaType() === 'text/plain'
          ? new \DOMCdataSection($this->getContent())
          : new \DOMText($this->getContent());

        $el->appendChild($content);
    }

    /**
     * @return mixed
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param $mediaType
     *
     * @return self
     */
    public function setMediaType($mediaType): self
    {
        $this->mediaType = $mediaType;
        return $this;
    }


}
