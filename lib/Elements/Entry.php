<?php
/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Act\Act;
use PHPHealth\CDA\RIM\Act\Encounter;
use PHPHealth\CDA\RIM\Act\Observation;
use PHPHealth\CDA\RIM\Act\SubstanceAdministration;
use PHPHealth\CDA\Traits\ActTrait;
use PHPHealth\CDA\Traits\ContextConductionIndTrait;
use PHPHealth\CDA\Traits\EncounterTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\ObservationMediaTrait;
use PHPHealth\CDA\Traits\ObservationTrait;
use PHPHealth\CDA\Traits\OrganizerTrait;
use PHPHealth\CDA\Traits\ProcedureTrait;
use PHPHealth\CDA\Traits\RegionOfInterestTrait;
use PHPHealth\CDA\Traits\SubstanceAdministrationTrait;
use PHPHealth\CDA\Traits\SupplyTrait;
use PHPHealth\CDA\Traits\TypeCodeTrait;

/**
 * Class Entry
 *
 * @package PHPHealth\CDA\Elements
 */
class Entry extends AbstractElement implements TypeCodeInterface
{

    use IdsTrait;
    use ActTrait;
    use EncounterTrait;
    use ObservationTrait;
    use ObservationMediaTrait;
    use OrganizerTrait;
    use ProcedureTrait;
    use RegionOfInterestTrait;
    use SubstanceAdministrationTrait;
    use SupplyTrait;
    // <xs:element ref="ext:controlAct"/>
    use TypeCodeTrait;
    use ContextConductionIndTrait;

    /**
     * Entry constructor.
     *
     * @param null $choice
     */
    public function __construct($choice = null)
    {
        $this->setAcceptableTypeCodes(TypeCodeInterface::x_ActRelationshipEntry)
          ->setTypeCode(TypeCodeInterface::COMPONENT);
        if ($choice instanceof Act) {
            $this->setAct($choice);
        } elseif ($choice instanceof Encounter) {
            $this->setEncounter($choice);
        } elseif ($choice instanceof Observation) {
            $this->setObservation($choice);
        } elseif ($choice instanceof Procedure) {
            $this->setProcedure($choice);
        } elseif ($choice instanceof SubstanceAdministration) {
            $this->setSubstanceAdministration($choice);
        }

    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc);
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
        } elseif ($this->hasProcedure()) {
            $this->renderProcedure($el, $doc);
        } elseif ($this->hasRegionOfInterest()) {
            $this->renderRegionOfInterest($el, $doc);
        } elseif ($this->hasSubstanceAdministration()) {
            $this->renderSubstanceAdministration($el, $doc);
        } elseif ($this->hasSupply()) {
            $this->renderSupply($el, $doc);
        }

        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'entry';
    }

}
