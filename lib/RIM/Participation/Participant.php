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


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Role\ParticipantRole;
use PHPHealth\CDA\Traits\AwarenessCodeTrait;
use PHPHealth\CDA\Traits\ContextControlCodeTrait;
use PHPHealth\CDA\Traits\ParticipantRoleTrait;
use PHPHealth\CDA\Traits\TimeTrait;
use PHPHealth\CDA\Traits\TypeCodeTrait;

/**
 * Class Participant
 *
 * @package PHPHealth\CDA\Elements
 */
class Participant extends AbstractElement implements TypeCodeInterface
{
    use AwarenessCodeTrait;
    use ContextControlCodeTrait;
    use ParticipantRoleTrait;
    use TimeTrait;
    use TypeCodeTrait;


    public function __construct(ParticipantRole $participant_role)
    {
        $this->setAcceptableTypeCodes(['', TypeCodeInterface::CAUSATIVE_AGENT])
          ->setTypeCode(TypeCodeInterface::CAUSATIVE_AGENT)
          ->setContextControlCode('OP')
          ->setParticipantRole($participant_role);
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
        $this->renderContextControlCode($el, $doc)
          ->renderTime($el, $doc)
          ->renderAwarenessCode($el, $doc)
          ->renderParticipantRole($el, $doc);
        return $el;
    }


    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'participant';
    }


}