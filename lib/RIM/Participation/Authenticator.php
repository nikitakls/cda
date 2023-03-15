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
use PHPHealth\CDA\Interfaces\ContextControlCodeInterface;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\Traits\AssignedEntityTrait;
use PHPHealth\CDA\Traits\ContextControlCodeTrait;
use PHPHealth\CDA\Traits\SignatureCodeTrait;
use PHPHealth\CDA\Traits\TimeTrait;
use PHPHealth\CDA\Traits\TypeCodeTrait;

class Authenticator extends AbstractElement implements TypeCodeInterface, ContextControlCodeInterface
{
    use TimeTrait;
    use AssignedEntityTrait;
    use TypeCodeTrait;
    use SignatureCodeTrait;
    use ContextControlCodeTrait;

    public function __construct()
    {
        $this->setAcceptableTypeCodes(TypeCodeInterface::ParticipationType)
          ->setTypeCode(TypeCodeInterface::AUTHENTICATOR)
          ->setContextControlCode('');
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderTime($el, $doc);
        $this->renderSignatureCode($el, $doc);
        $this->renderAssignedEntity($el, $doc);
        return $el;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'authenticator';
    }
}