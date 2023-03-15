<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.
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

namespace PHPHealth\CDA\DataType\Identifier;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\AnyType;

/**
 * An identifier that uniquely identifies a thing or object. Examples are object
 * identifier for HL7 RIM objects, medical record number, order id, service
 * catalog item id, Vehicle Identification Number (VIN), etc. Instance
 * identifiers are defined based on ISO object identifiers.
 *
 * @author julien
 */
class InstanceIdentifier extends AnyType
{
    /**
     *
     * @var string
     */
    private $root;

    /**
     *
     * @var string
     */
    private $extension;

    /**
     *
     * @var string
     */
    private $assigningAuthorityName;

    /**
     * InstanceIdentifier constructor.
     *
     * @param      $root
     * @param null $extension
     * @param null $assigningAuthorityName
     */
    public function __construct(
      $root,
      $extension = null,
      $assigningAuthorityName = null
    ) {
        $this->root                   = $root;
        $this->extension              = $extension;
        $this->assigningAuthorityName = $assigningAuthorityName;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        $el->setAttribute(CDA::NS_CDA . 'root', $this->getRoot());

        if ($this->hasExtension()) {
            $el->setAttribute(CDA::NS_CDA . 'extension', $this->getExtension());
        }

        if ($this->hasAssigningAuthorityName()) {
            $el->setAttribute(
              CDA::NS_CDA . 'assigningAuthorityName',
              $this->getAssigningAuthorityName()
            );
        }
    }

    /**
     * @return string
     */
    public function getRoot(): string
    {
        return $this->root;
    }

    /**
     * @param $root
     *
     * @return self
     */
    public function setRoot($root): self
    {
        $this->root = $root;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasExtension(): bool
    {
        return $this->getExtension() !== null;
    }

    /**
     * @return null|string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param $extension
     *
     * @return self
     */
    public function setExtension($extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasAssigningAuthorityName(): bool
    {
        return $this->getAssigningAuthorityName() !== null;
    }

    /**
     * @return null|string
     */
    public function getAssigningAuthorityName()
    {
        return $this->assigningAuthorityName;
    }

    /**
     * @param $assigningAuthorityName
     *
     * @return self
     */
    public function setAssigningAuthorityName($assigningAuthorityName): self
    {
        $this->assigningAuthorityName = $assigningAuthorityName;

        return $this;
    }
}
