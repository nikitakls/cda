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

namespace PHPHealth\CDA\RIM\Participation;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\Elements\SignatureCode;
use PHPHealth\CDA\Elements\Time;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Entity\AssignedEntity;


/**
 * Class LegalAuthenticator
 *
 * @package PHPHealth\CDA\RIM\Participation
 */
class LegalAuthenticator extends Authenticator
{
    /**
     * LegalAuthenticator constructor.
     *
     * @param Time           $time
     * @param SignatureCode  $signature_code
     * @param AssignedEntity $assigned_entity
     */
    public function __construct(Time $time, SignatureCode $signature_code, AssignedEntity $assigned_entity)
    {
        parent::__construct();
        $this->setAcceptableTypeCodes(['', TypeCodeInterface::LEGAL_AUTHENTICATOR])
          ->setTypeCode('')
          ->setTime($time)
          ->setSignatureCode($signature_code)
          ->setAssignedEntity($assigned_entity);
    }

    protected function getElementTag(): string
    {
        return 'legalAuthenticator';
    }


}