<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.
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

use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Interfaces\ContextControlCodeInterface;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\RIM\Role\AssignedAuthor;
use PHPHealth\CDA\Traits\AssignedAuthorTrait;
use PHPHealth\CDA\Traits\ContextControlCodeTrait;
use PHPHealth\CDA\Traits\FunctionCodedValueTrait;
use PHPHealth\CDA\Traits\TimeTrait;

/**
 * @author julien.fastre@champs-libres.coop
 */
class Author extends Participation implements ContextControlCodeInterface
{
    use FunctionCodedValueTrait;
    use AssignedAuthorTrait;
    use TimeTrait;

    use ContextControlCodeTrait;

    /**
     * Author constructor.
     *
     * @param TimeStamp      $time_stamp
     * @param AssignedAuthor $assignedAuthor
     */
    public function __construct(
      $time_stamp = null,
      $assignedAuthor = null
    ) {
        $this->setAcceptableTypeCodes(['', TypeCodeInterface::AUTHOR])
          ->setTypeCode(TypeCodeInterface::AUTHOR);
        if ($time_stamp && $time_stamp instanceof TimeStamp) {
            $this->setTime($time_stamp);
        }
        if ($assignedAuthor && $assignedAuthor instanceof AssignedAuthor) {
            $this->setAssignedAuthor($assignedAuthor);
        }
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderFunctionCodedValue($el, $doc)
          ->renderTime($el, $doc)
          ->renderAssignedAuthor($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'author';
    }
}
