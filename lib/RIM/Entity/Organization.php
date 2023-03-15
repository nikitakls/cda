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

namespace PHPHealth\CDA\RIM\Entity;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Traits\AddrsTrait;
use PHPHealth\CDA\Traits\AsEntityIdentifierTrait;
use PHPHealth\CDA\Traits\TelecomsTrait;

/**
 * @author julien
 */
abstract class Organization extends Entity
{
    use TelecomsTrait;
    use AddrsTrait;
    use AsEntityIdentifierTrait;


    /**
     * Organization constructor.
     *
     * @param Set $names
     * @param Id  $id
     */
    public function __construct(Set $names, Id $id)
    {
        $this->setNames($names)
          ->addId($id)
          ->setAcceptableClassCodes(ClassCodeInterface::EntityClassOrganization)
          ->setClassCode(ClassCodeInterface::ORGANISATION);
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc);
        $this->renderNames($el, $doc);
        return $el;
    }

    /**
     * @return bool
     */
    protected function hasAsEntityIdentifier(): bool
    {
        return null !== $this->as_entity_identifier;
    }

}
