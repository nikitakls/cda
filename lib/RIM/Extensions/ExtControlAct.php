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


namespace PHPHealth\CDA\RIM\Extensions;


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Interfaces\NegationInterface;
use PHPHealth\CDA\Traits\AuthorsTrait;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\EffectiveTimeTrait;
use PHPHealth\CDA\Traits\EntryRelationshipsTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\InformantsTrait;
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
use PHPHealth\CDA\Traits\TextTrait;

class ExtControlAct extends AbstractElement implements ClassCodeInterface, MoodCodeInterface, NegationInterface
{
    use IdsTrait;
    use CodeTrait;
    use TextTrait;
    use StatusCodeTrait;
    use EffectiveTimeTrait;
    use PriorityCodeTrait;
    use SubjectTrait;
    use SpecimensTrait;
    use PerformersTrait;
    use AuthorsTrait;
    use InformantsTrait;
    use ParticipantsTrait;
    use EntryRelationshipsTrait;
    use ReferencesTrait;
    use PreconditionsTrait;

    use ClassCodeTrait;
    use MoodCodeTrait;
    use NegationIndTrait;


    public function __construct()
    {
        // note the mood code is required.
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setClassCode(ClassCodeInterface::CONTROL_ACT)
          ->setAcceptableClassCodes(MoodCodeInterface::x_DocumentActMood);
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc);
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'controlAct';
    }


}