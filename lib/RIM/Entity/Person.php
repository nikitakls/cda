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

namespace PHPHealth\CDA\RIM\Entity;

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Traits\DeceasedPersonTrait;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
abstract class Person extends LivingSubject
{
    use DeceasedPersonTrait;

    /**
     * Person constructor.
     *
     * @param Set|NULL        $names
     * @param TimeStamp|NULL  $birth_time
     * @param CodedValue|NULL $administrativeGenderCode
     */
    public function __construct(
      Set $names = null,
      TimeStamp $birth_time = null,
      CodedValue $administrativeGenderCode = null
    ) {
        if ($names) {
            $this->setNames($names);
        }
        if ($birth_time) {
            $this->setBirthTime($birth_time);
        }
        if ($administrativeGenderCode) {
            $this->setAdministrativeGenderCode($administrativeGenderCode);
        }
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClass)
          ->setClassCode(ClassCodeInterface::PERSON);
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if ($this->hasNames()) {
            $this->getNames()->setValueToElement($el, $doc);
        }
        $this->renderAdministrativeGenderCode($el, $doc)
          ->renderBirthTime($el, $doc)
          ->renderEthnicGroup($el, $doc)
          ->renderMultipleBirths($el, $doc)
          ->renderDeceasedPerson($el, $doc)
          ->renderBirthPlace($el, $doc)
          ->renderAsEntityIdentifier($el, $doc);
        return $el;
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'person';
    }

}
