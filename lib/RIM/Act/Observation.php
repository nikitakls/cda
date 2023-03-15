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

namespace PHPHealth\CDA\RIM\Act;

use PHPHealth\CDA\DataType\NullType;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Value;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\DerivationExprTrait;
use PHPHealth\CDA\Traits\InterpretationCodesTrait;
use PHPHealth\CDA\Traits\MethodCodesTrait;
use PHPHealth\CDA\Traits\ReferenceRangesTrait;
use PHPHealth\CDA\Traits\RepeatNumberTrait;
use PHPHealth\CDA\Traits\TargetSiteCodesTrait;
use PHPHealth\CDA\Traits\ValuesTrait;

/**
 * Class Observation
 *
 * @package PHPHealth\CDA\RIM\Act
 */
class Observation extends Act
{
    use TargetSiteCodesTrait;
    use ValuesTrait;
    use DerivationExprTrait;
    use RepeatNumberTrait;
    use InterpretationCodesTrait;
    use MethodCodesTrait;
    use ReferenceRangesTrait;

    /**
     * Observation constructor.
     *
     * @param null $code
     * @param null $value
     */
    public function __construct($code = null, $value = null)
    {
        parent::__construct();
        $this->setAcceptableClassCodes(array('', ClassCodeInterface::OBSERVATION))
          ->setAcceptableMoodCodes(MoodCodeInterface::x_ActMoodDocumentObservation)
          ->setMoodCode('')
          ->setClassCode(ClassCodeInterface::OBSERVATION);
        if ($code instanceof Code) {
            $this->setCode($code);
        }
        if ($value instanceof Value) {
            $this->addValue($value);
        }
    }


    /**
     *
     * @param string $flavour
     *
     * @return \PHPHealth\CDA\RIM\Act\Observation
     */
    public static function nullObservation($flavour = null): Observation
    {
        return (new self())
          ->setCode(
            (new Code())
              ->setNullFlavour($flavour ?? NullType::NOT_HERE)
          )->setMoodCode(MoodCodeInterface::DEFINITION);
    }

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
          ->renderLanguageCode($el, $doc)
          ->renderValues($el, $doc)
          ->renderInterpretationCodes($el, $doc)
          ->renderMethodCodes($el, $doc)
          ->renderTargetSiteCodes($el, $doc)
          ->renderSubject($el, $doc)
          ->renderSpecimens($el, $doc)
          ->renderPerformers($el, $doc)
          ->renderAuthors($el, $doc)
          ->renderParticipants($el, $doc)
          ->renderEntryRelationships($el, $doc)
          ->renderReferences($el, $doc)
          ->renderPreconditions($el, $doc)
          ->renderReferenceRanges($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'observation';
    }

}
