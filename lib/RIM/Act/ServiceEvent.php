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

/**
 * What is a “Service Event”?
 * The CDA specification defines what the serviceEvent XML element represents as being “the main act such as a
 * colonoscopy or an appendectomy, being documented“. It goes on to note that for some types of CDA documents,
 * such as an operative note, procedure note, history and physical note, etc. the “service event” being document is very obvious.
 *
 * Although it is not always accurate, it is often helpful to think of the serviceEvent as representing
 * “something that the patient could be billed for”.
 */

namespace PHPHealth\CDA\RIM\Act;


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\EffectiveTimeTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\PerformersTrait;

class ServiceEvent extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use IdsTrait;
    use CodeTrait;
    use EffectiveTimeTrait;
    use PerformersTrait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    public function __construct()
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClassRoot)
          ->setClassCode('')
          ->setAcceptableMoodCodes(MoodCodeInterface::ActMood)
          ->setMoodCode(MoodCodeInterface::EVENT);
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc)
          ->renderCode($el, $doc)
          ->renderEffectiveTime($el, $doc)
          ->renderPerformers($el, $doc);
        return $el;
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'serviceEvent';
    }
}