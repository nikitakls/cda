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
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\AuthorsTrait;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\EffectiveTimesTrait;
use PHPHealth\CDA\Traits\EntryRelationshipsTrait;
use PHPHealth\CDA\Traits\ExpectedUseTimeTrait;
use PHPHealth\CDA\Traits\ExtCoveragesTrait;
use PHPHealth\CDA\Traits\ExtSubjectOf2Trait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\IndependentIndTrait;
use PHPHealth\CDA\Traits\InformantsTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\ParticipantsTrait;
use PHPHealth\CDA\Traits\PerformersTrait;
use PHPHealth\CDA\Traits\PreconditionsTrait;
use PHPHealth\CDA\Traits\PriorityCodesTrait;
use PHPHealth\CDA\Traits\ProductTrait;
use PHPHealth\CDA\Traits\QuantityTrait;
use PHPHealth\CDA\Traits\ReferencesTrait;
use PHPHealth\CDA\Traits\RepeatNumberTrait;
use PHPHealth\CDA\Traits\SpecimensTrait;
use PHPHealth\CDA\Traits\StatusCodeTrait;
use PHPHealth\CDA\Traits\SubjectTrait;
use PHPHealth\CDA\Traits\TextTrait;

class Supply Extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use IdsTrait;
    use CodeTrait;
    use TextTrait;
    use StatusCodeTrait;
    use EffectiveTimesTrait;
    use PriorityCodesTrait;
    use RepeatNumberTrait;
    use IndependentIndTrait;
    use QuantityTrait;
    use ExpectedUseTimeTrait;
    use SubjectTrait;
    use SpecimensTrait;
    use ProductTrait;
    use PerformersTrait;
    use AuthorsTrait;
    use InformantsTrait;
    use ParticipantsTrait;
    use EntryRelationshipsTrait;
    use ReferencesTrait;
    use PreconditionsTrait;
    use ExtSubjectOf2Trait;
    use ExtCoveragesTrait;

    use ClassCodeTrait;
    use MoodCodeTrait;

    public function __construct()
    {
        $this->setAcceptableClassCodes([ClassCodeInterface::SUPPLY])
          ->setClassCode(ClassCodeInterface::SUPPLY)
          ->setAcceptableMoodCodes(MoodCodeInterface::x_DocumentSubstanceMood);
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc);
        $this->renderCode($el, $doc);
        $this->renderText($el, $doc);
        $this->renderStatusCode($el, $doc);
        $this->renderEffectiveTimes($el, $doc);
        $this->renderPriorityCodes($el, $doc);
        $this->renderRepeatNumber($el, $doc);
        $this->renderIndependentInd($el, $doc);
        $this->renderQuantity($el, $doc);
        $this->renderExpectedUseTime($el, $doc);
        $this->renderSubject($el, $doc);
        $this->renderSpecimens($el, $doc);
        $this->renderProduct($el, $doc);
        $this->renderPerformers($el, $doc);
        $this->renderAuthors($el, $doc);
        $this->renderInformants($el, $doc);
        $this->renderParticipants($el, $doc);
        $this->renderEntryRelationships($el, $doc);
        $this->renderReferences($el, $doc);
        $this->renderPreconditions($el, $doc);
        $this->renderExtSubjectOf2($el, $doc);
        $this->renderExtCoverages($el, $doc);
        return $el;
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'supply';
    }


}