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

namespace PHPHealth\CDA\RIM\Entity;

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

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;

/**
 * @author julien
 */
class RepresentedCustodianOrganization extends Organization
{

    public function __construct(Set $names, Id $id)
    {
        parent::__construct($names, $id);
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassOrganization);
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        if ($this->hasIds()) {
            foreach ($this->getIds() as $id) {
                $el->appendChild($id->toDOMElement($doc));
            }
        }

        foreach ($this->getNames()->get() as $name) {
            /* @var $name \PHPHealth\CDA\DataType\Name\EntityName */
            $name->setValueToElement($el, $doc);
        }
        if ($this->hasTelecoms()) {
            foreach ($this->getTelecoms() as $telecom) {
                $el->appendChild($telecom->toDOMElement($doc));
            }
        }
        if ($this->hasAddrs()) {
            foreach ($this->getAddrs() as $addr) {
                $el->appendChild($addr->toDOMElement($doc));
            }
        }
        if ($this->hasAsEntityIdentifier()) {
            $el->appendChild($this->getAsEntityIdentifier()->toDOMElement($doc));
        }
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'representedCustodianOrganization';
    }
}
