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


namespace PHPHealth\CDA\RIM\Participation;

use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Entity\AssignedEntity;
use PHPHealth\CDA\Traits\AssignedEntityTrait;
use PHPHealth\CDA\Traits\ModeCodeTrait;
use PHPHealth\CDA\Traits\TimeTrait;

/**
 * Class Performer
 *
 * @package PHPHealth\CDA\RIM\Participation
 */
class Performer extends Participation
{

    use TimeTrait;
    use ModeCodeTrait;
    use AssignedEntityTrait;

    /**
     * Performer constructor.
     *
     * @param null $assignedEntity
     */
    public function __construct($assignedEntity = null)
    {
        $this->setAcceptableTypeCodes(TypeCodeInterface::ParticipationPhysicalPerformer)
          ->setTypeCode(TypeCodeInterface::PERFORMER);
        if ($assignedEntity instanceof AssignedEntity) {
            $this->setAssignedEntity($assignedEntity);
        }
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderTime($el, $doc)
          ->renderModeCode($el, $doc)
          ->renderAssignedEntity($el, $doc);
        return $el;
    }


    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'performer';
    }

}