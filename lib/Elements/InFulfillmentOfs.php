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

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\IntegerType;

/**
 * Class VersionNumber
 *
 * @package PHPHealth\CDA\Elements
 */
class InFulfillmentOfs extends AbstractElement
{
    /**
     * @var
     */
    protected $version;

    /**
     * VersionNumber constructor.
     *
     * @param Id $version
     */
    public function __construct(Id $id)
    {
        $this->setOrder($id);
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $q = $doc->createElement('order');
        $q->appendChild($this->getOrder()->toDOMElement($doc));
        $el->appendChild($q);
        return $el;
    }

    /**
     * @return Id
     */
    public function getOrder(): Id
    {
        return $this->version;
    }

    /**
     * @param IntegerType $version
     *
     * @return self
     */
    public function setOrder(Id $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'inFulfillmentOf';
    }
}