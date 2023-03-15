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


namespace PHPHealth\CDA\Elements;


use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Interfaces\NegationInterface;
use PHPHealth\CDA\Traits\ApproachSiteCodesTrait;
use PHPHealth\CDA\Traits\AuthorsTrait;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\EffectiveTimeTrait;
use PHPHealth\CDA\Traits\EntryRelationshipsTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\InformantsTrait;
use PHPHealth\CDA\Traits\LanguageCodeTrait;
use PHPHealth\CDA\Traits\MethodCodesTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\NegationIndTrait;
use PHPHealth\CDA\Traits\ParticipantsTrait;
use PHPHealth\CDA\Traits\PerformersTrait;
use PHPHealth\CDA\Traits\PreconditionsTrait;
use PHPHealth\CDA\Traits\PriorityCodeTrait;
use PHPHealth\CDA\Traits\ReferencesTrait;
use PHPHealth\CDA\Traits\SpecimensTrait;
use PHPHealth\CDA\Traits\StatusCodeTrait;
use PHPHealth\CDA\Traits\SubjectTrait;
use PHPHealth\CDA\Traits\TargetSiteCodesTrait;
use PHPHealth\CDA\Traits\TextTrait;

class Procedure extends AbstractElement implements ClassCodeInterface, MoodCodeInterface, NegationInterface
{
    use IdsTrait;
    use CodeTrait;
    use TextTrait;
    use StatusCodeTrait;
    use EffectiveTimeTrait;
    use PriorityCodeTrait;
    use LanguageCodeTrait;
    use MethodCodesTrait;
    use ApproachSiteCodesTrait;
    use TargetSiteCodesTrait;
    use SubjectTrait;
    use SpecimensTrait;
    use PerformersTrait;
    use AuthorsTrait;
    use InformantsTrait;
    use ParticipantsTrait;
    use EntryRelationshipsTrait;
    use ReferencesTrait;
    use PreconditionsTrait;

    use MoodCodeTrait;
    use ClassCodeTrait;
    use NegationIndTrait;

    /**
     * Procedure constructor.
     */
    public function __construct()
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setClassCode(ClassCodeInterface::PROCEDURE)
          ->setAcceptableMoodCodes(MoodCodeInterface::x_DocumentProcedureMood)
          ->setMoodCode(MoodCodeInterface::EVENT);
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
        $this->renderIds($el, $doc)
          ->renderCode($el, $doc)
          ->renderText($el, $doc)
          ->renderStatusCode($el, $doc)
          ->renderEffectiveTime($el, $doc)
          ->renderPriorityCode($el, $doc)
          ->renderLanguageCode($el, $doc)
          ->renderMethodCodes($el, $doc)
          ->renderApproachSiteCodes($el, $doc)
          ->renderTargetSiteCodes($el, $doc)
          ->renderSubject($el, $doc)
          ->renderSpecimens($el, $doc)
          ->renderPerformers($el, $doc)
          ->renderAuthors($el, $doc)
          ->renderInformants($el, $doc)
          ->renderParticipants($el, $doc)
          ->renderEntryRelationships($el, $doc)
          ->renderReferences($el, $doc)
          ->renderPreconditions($el, $doc);
        return $el;
    }


    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'procedure';
    }
}