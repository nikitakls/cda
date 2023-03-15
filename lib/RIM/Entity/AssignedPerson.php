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

namespace PHPHealth\CDA\RIM\Entity;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\RIM\Extensions\AsEmployment;
use PHPHealth\CDA\RIM\Extensions\AsQualifications;

class AssignedPerson extends Person
{

    /** @var Set */
    protected $person_name;

    /** @var AsEmployment */
    protected $as_employment;

    /** @var AsQualifications */
    protected $as_qualifications;

    /** @noinspection PhpMissingParentConstructorInspection */
    /** @noinspection MagicMethodsValidityInspection */
    public function __construct($names = null, $as_entity_identifier = null, $as_employment = null, $as_qualifications = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClass)
          ->setClassCode(ClassCodeInterface::PERSON);
        if ($names) {
            $this->setNames($names);
        }
        if ($as_entity_identifier) {
            $this->setAsEntityIdentifier($as_entity_identifier);
        }
        if ($as_employment) {
            $this->setAsEmployment($as_employment);
        }
        if ($as_qualifications) {
            $this->setAsQualifications($as_qualifications);
        }
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = parent::toDOMElement($doc);
        if ($this->hasAsEmployment()) {
            $el->appendChild($this->getAsEmployment()->toDOMElement($doc));
        }
        if ($this->hasAsQualifications()) {
            $el->appendChild($this->getAsQualifications()->toDOMElement($doc));
        }
        return $el;
    }

    public function hasAsEmployment(): bool
    {
        return null !== $this->as_employment;
    }

    public function getAsEmployment(): AsEmployment
    {
        return $this->as_employment;
    }

    public function setAsEmployment(AsEmployment $as_employment): self
    {
        $this->as_employment = $as_employment;
        return $this;
    }

    public function hasAsQualifications(): bool
    {
        return null !== $this->as_qualifications;
    }

    public function getAsQualifications(): AsQualifications
    {
        return $this->as_qualifications;
    }

    public function setAsQualifications(AsQualifications $as_qualifications): self
    {
        $this->as_qualifications = $as_qualifications;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'assignedPerson';
    }
}