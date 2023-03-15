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
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodedValueTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\InterpretationCodeTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\TextTrait;
use PHPHealth\CDA\Traits\ValueTrait;

/**
 * Class ObservationRange
 *
 * @package PHPHealth\CDA\RIM\Act
 */
class ObservationRange extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use CodedValueTrait;
    use CodeTrait;
    use TextTrait;
    use ValueTrait;
    use InterpretationCodeTrait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    public function __construct()
    {
        $this->setAcceptableClassCodes(array_merge([''], ClassCodeInterface::ActClassObservation))
          ->setAcceptableMoodCodes(['', MoodCodeInterface::EVENT_CRITERION])
          ->setClassCode('')
          ->setMoodCode('');
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        if ($this->hasCode()) {
            $this->renderCode($el, $doc);
        } elseif ($this->hasCodedValue()) {
            $this->renderCodedValue($el, $doc);
        }
        $this->renderText($el, $doc);
        $this->renderValue($el, $doc);
        $this->renderInterpretationCode($el, $doc);
        return $el;
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'observationRange';
    }


}