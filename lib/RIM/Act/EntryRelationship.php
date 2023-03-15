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


namespace PHPHealth\CDA\RIM\Act;


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\ContextConductionIndInterface;
use PHPHealth\CDA\Interfaces\InversionIndInterface;
use PHPHealth\CDA\Interfaces\NegationInterface;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\Traits\ActTrait;
use PHPHealth\CDA\Traits\ContextConductionIndTrait;
use PHPHealth\CDA\Traits\EncounterTrait;
use PHPHealth\CDA\Traits\InversionIndTrait;
use PHPHealth\CDA\Traits\NegationIndTrait;
use PHPHealth\CDA\Traits\ObservationMediaTrait;
use PHPHealth\CDA\Traits\ObservationTrait;
use PHPHealth\CDA\Traits\OrganizerTrait;
use PHPHealth\CDA\Traits\ProcedureTrait;
use PHPHealth\CDA\Traits\RegionOfInterestTrait;
use PHPHealth\CDA\Traits\SeperatableIndTrait;
use PHPHealth\CDA\Traits\SequenceNumberTrait;
use PHPHealth\CDA\Traits\SubstanceAdministrationTrait;
use PHPHealth\CDA\Traits\SupplyTrait;
use PHPHealth\CDA\Traits\TypeCodeTrait;

/**
 * Class EntryRelationship
 *
 * @package PHPHealth\CDA\RIM\Act
 */
class EntryRelationship extends AbstractElement implements TypeCodeInterface, InversionIndInterface, ContextConductionIndInterface, NegationInterface
{
    use SequenceNumberTrait;
    use SeperatableIndTrait;
    use ActTrait;
    use EncounterTrait;
    use ObservationTrait;
    use ObservationMediaTrait;
    use OrganizerTrait;
    use ProcedureTrait;
    use RegionOfInterestTrait;
    use SubstanceAdministrationTrait;
    use SupplyTrait;

    use TypeCodeTrait;
    use NegationIndTrait;
    use ContextConductionIndTrait;
    use InversionIndTrait;

    /**
     * EntryRelationship constructor.
     * type code is required.
     *
     * @param null   $choice
     * @param string $type_code
     */
    public function __construct($choice = null, string $type_code = '')
    {
        $this->setAcceptableTypeCodes(TypeCodeInterface::x_ActRelationshipEntryRelationship)
          ->setTypeCode(TypeCodeInterface::CAUSE);
        $this->templateIds = array();
        if ($choice instanceof Act) {
            $this->setAct($choice);
        } elseif ($choice instanceof Encounter) {
            $this->setEncounter($choice);
        } elseif ($choice instanceof Observation) {
            $this->setObservation($choice);
        } elseif ($choice instanceof ObservationMedia) {
            $this->setObservationMedia($choice);
        } elseif ($choice instanceof Organizer) {
            $this->setOrganizer($choice);
        } elseif ($choice instanceof SubstanceAdministration) {
            $this->setSubstanceAdministration($choice);
        }
        if ($type_code) {
            $this->setTypeCode($type_code);
        }
    }


    /**
     * Transforms the element into a DOMElement, which will be included
     * into the final CDA XML
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        if ($this->hasSequenceNumber()) {
            $this->renderSequenceNumber($el, $doc);
        }
        if ($this->hasSeperatableInd()) {
            $this->renderSeperatableInd($el, $doc);
        }
        if ($this->hasAct()) {
            $this->renderAct($el, $doc);
        } elseif ($this->hasEncounter()) {
            $this->renderEncounter($el, $doc);
        } elseif ($this->hasObservation()) {
            $this->renderObservation($el, $doc);
        } elseif ($this->hasObservationMedia()) {
            $this->renderObservationMedia($el, $doc);
        } elseif ($this->hasOrganizer()) {
            $this->renderOrganizer($el, $doc);
        } elseif ($this->hasSubstanceAdministration()) {
            $this->renderSubstanceAdministration($el, $doc);
        }
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'entryRelationship';
    }
}