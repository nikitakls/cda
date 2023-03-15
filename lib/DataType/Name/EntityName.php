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

namespace PHPHealth\CDA\DataType\Name;

/**
 * A name for a person, organization, place or thing. A sequence of name parts,
 * such as given name or family name, prefix, suffix, etc. Examples for entity
 * name values are "Jim Bob Walton, Jr.", "Health Level Seven, Inc.",
 * "Lake Tahoe", etc. An entity name may be as simple as a character string or
 * may consist of several entity name parts, such as, "Jim", "Bob", "Walton",
 * and "Jr.", "Health Level Seven" and "Inc.", "Lake" and "Tahoe".
 *
 * Structurally, the entity name data type is a sequence of entity name part
 * values with an added "use" code and a valid time range for information about
 * if and when the name can be used for a given purpose.
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\AnyType;
use PHPHealth\CDA\Interfaces\UseAttributeInterface;

class EntityName extends AnyType implements UseAttributeInterface
{
    /**
     *
     * @var string
     */
    protected $string = '';

    protected $use_attribute = '';

    protected $acceptable_use_attributes = array();

    /**
     * EntityName constructor.
     *
     * @param string $string
     */
    public function __construct($string = '')
    {
        $this->acceptable_use_attributes = UseAttributeInterface::AddressValues;
        $this->setString($string);
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        $name = $doc->createElement('name');
        $name->appendChild($doc->createTextNode($this->getString()));

        $el->appendChild($name);
        if (false === empty($this->getUseAttribute())) {
            $name->setAttribute(CDA::NS_CDA . 'use', $this->getUseAttribute());
        }
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @param $string
     *
     * @return self
     */
    public function setString($string): self
    {
        $this->string = $string;
        return $this;
    }

    /**
     * @return string
     */
    public function getUseAttribute(): string
    {
        return $this->use_attribute;
    }

    /**
     * Note that overloads do validation as appropriate
     *
     * @param string $use_attribute
     *
     * @return EntityName
     */
    public function setUseAttribute(string $use_attribute): self
    {
        if (\in_array($use_attribute, $this->acceptable_use_attributes, true) === false) {
            throw new \InvalidArgumentException("The use attribute {$use_attribute} is not an acceptable value!");
        }
        $this->use_attribute = $use_attribute;
        return $this;
    }
}
