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

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\Boolean\Boolean;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\ContextConductionIndInterface;
use PHPHealth\CDA\Interfaces\ContextControlCodeInterface;
use PHPHealth\CDA\Interfaces\DeterminerCodeInterface;
use PHPHealth\CDA\Interfaces\ElementInterface;
use PHPHealth\CDA\Interfaces\InversionIndInterface;
use PHPHealth\CDA\Interfaces\MediaTypeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Interfaces\NegationInterface;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\Interfaces\UseAttributeInterface;
use PHPHealth\CDA\Interfaces\XSITypeInterface;
use PHPHealth\CDA\RIM\Act\Observation;
use PHPHealth\CDA\RIM\Act\SubstanceAdministration;
use PHPHealth\CDA\RIM\Act\Supply;
use PHPHealth\CDA\RIM\Entity\AssignedPerson;
use PHPHealth\CDA\RIM\Entity\SpecimenPlayingEntity;
use PHPHealth\CDA\RIM\Extensions\ExtParticipantRole;
use PHPHealth\CDA\RIM\Participation\Consumable;
use PHPHealth\CDA\RIM\Participation\Performer;
use PHPHealth\CDA\RIM\Role\ManufacturedProduct;
use PHPHealth\CDA\RIM\Role\SpecimenRole;
use PHPHealth\CDA\Traits\NullFlavourTrait;
use PHPHealth\CDA\Traits\RealmCodesTrait;
use PHPHealth\CDA\Traits\TemplateIdsTrait;
use PHPHealth\CDA\Traits\TypeIdTrait;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
abstract class AbstractElement implements ElementInterface, NullFlavourInterface
{
    use NullFlavourTrait;
    use RealmCodesTrait;
    use TypeIdTrait;
    use TemplateIdsTrait;

    /**
     * @var array
     */
    protected $attributes = array();

    /**
     * this is a total hack to add non-commonly used attributes.
     * don't use it lazy bones!
     *
     * @param $attribute
     * @param $value
     *
     * @return AbstractElement
     * @deprecated
     */
    public function addAttribute($attribute, $value): self
    {
        $this->attributes[$attribute] = $value;
        return $this;
    }

    /**
     * @return TargetSiteCode
     */
    public function returnTargetSiteCode(): TargetSiteCode
    {
        if ($this instanceof TargetSiteCode) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of TargetSiteCode');
    }

    /**
     * @return Observation
     */
    public function returnObservation(): Observation
    {
        if ($this instanceof Observation) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of Observation');
    }

    /**
     * @return SubstanceAdministration
     */
    public function returnSubstanceAdministration(): SubstanceAdministration
    {
        if ($this instanceof SubstanceAdministration) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of SubstanceAdministration');
    }

    /**
     * @return SpecimenRole
     */
    public function returnSpecimenRole(): SpecimenRole
    {
        if ($this instanceof SpecimenRole) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of SpecimenRole');
    }

    /**
     * @return ManufacturedProduct
     */
    public function returnManufacturedProduct(): ManufacturedProduct
    {
        if ($this instanceof ManufacturedProduct) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of ManufacturedProduct');
    }

    /**
     * @return SpecimenPlayingEntity
     */
    public function returnSpecimenPlayingEntity(): SpecimenPlayingEntity
    {
        if ($this instanceof SpecimenPlayingEntity) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of SpecimenPlayingEntity');
    }

    /**
     * @return Consumable
     */
    public function returnConsumable(): Consumable
    {
        if ($this instanceof Consumable) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of Consumable');
    }

    /**
     * @return Performer
     */
    public function returnPerformer(): Performer
    {
        if ($this instanceof Performer) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of Performer');
    }

    /**
     * @return AssignedPerson
     */
    public function returnAssignedPerson(): AssignedPerson
    {
        if ($this instanceof AssignedPerson) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of AssignedPerson');
    }

    /**
     * @return ExtParticipantRole
     */
    public function returnExtParticipantRole(): ExtParticipantRole
    {
        if ($this instanceof ExtParticipantRole) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of ExtParticipantRole');
    }

    /**
     * @return Supply
     */
    public function returnSupply(): Supply
    {
        if ($this instanceof Supply) {
            return $this;
        }
        throw new \RuntimeException('The method must be an instance of Supply');
    }

    /**
     * @param \DOMDocument $doc
     * @param array        $properties
     *
     * @return \DOMElement
     */
    protected function createElement(\DOMDocument $doc, array $properties = array()): \DOMElement
    {
        /* @var $el \DOMElement */
        $el = $doc->createElement(CDA::NS_CDA . $this->getElementTag());
        if ($this->hasNullFlavour()) {
            $el->setAttribute(CDA::NS_CDA . 'nullFlavor', $this->getNullFlavour());
            return $el;
        }

        // tag can have class code or type code, but not both.
        // can have a class code and a mood code, but not type code and mood code
        /** @noinspection PhpUndefinedMethodInspection */
        if ($this instanceof ClassCodeInterface
            && $this->hasClassCode()) {
            $el->setAttribute(CDA::NS_CDA . 'classCode', $this->getClassCode());
            /** @noinspection PhpUndefinedMethodInspection */
            if ($this instanceof MoodCodeInterface
                && $this->hasMoodCode()) {
                $el->setAttribute(CDA::NS_CDA . 'moodCode', $this->getMoodCode());
            }
        } /** @noinspection PhpUndefinedMethodInspection */
        elseif ($this instanceof TypeCodeInterface && $this->hasTypeCode()) {
            $el->setAttribute(CDA::NS_CDA . 'typeCode', $this->getTypeCode());
        }

        if ($this instanceof DeterminerCodeInterface
            && false === empty($this->getDeterminerCode())) {
            $el->setAttribute(CDA::NS_CDA . 'determinerCode', $this->getDeterminerCode());
        }

        if ($this instanceof MediaTypeInterface && $this->getMediaType()) {
            $el->setAttribute(CDA::NS_CDA . 'mediaType', $this->getMediaType());
        }

        if ($this instanceof InversionIndInterface
            && $this->hasInversionInd()) {
            $negationInd = new Boolean('inversionInd', $this->getInversionInd());
            $negationInd->setValueToElement($el, $doc);
        }

        if ($this instanceof ContextConductionIndInterface
            && $this->hasContextConductionInd()) {
            $negationInd = new Boolean('contextConductionInd', $this->getContextConductionInd());
            $negationInd->setValueToElement($el, $doc);
        }

        if ($this instanceof NegationInterface
            && $this->hasNegationInd()) {
            $negationInd = new Boolean('negationInd', $this->getNegationInd());
            $negationInd->setValueToElement($el, $doc);
        }
        if ($this instanceof UseAttributeInterface
            && false === empty($this->getUseAttribute())) {
            $el->setAttribute(CDA::NS_CDA . 'use', $this->getUseAttribute());
        }

        if ($this instanceof ContextControlCodeInterface
            && false === empty($this->getContextControlCode())) {

            $el->setAttribute(CDA::NS_CDA . 'contextControlCode', $this->getContextControlCode());
        }
        if ($this instanceof XSITypeInterface
            && false === empty($this->getXSIType())) {
            $el->setAttribute(CDA::NS_CDA . 'xsi:type', $this->getXSIType());
        }

        foreach ($properties as $property) {
            $this->{$property}->setValueToElement($el, $doc);
        }

        foreach ($this->attributes as $attribute => $value) {
            $el->setAttribute($attribute, $value);
        }
        // attributes have finished, now start adding the elements.
        // realm codes are used to store data like the organisation/country etc this tag conforms to.
        $this->renderRealmCodes($el, $doc)
          ->renderTypeId($el, $doc)
          ->renderTemplateIds($el, $doc);
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    abstract protected function getElementTag(): string;

}
