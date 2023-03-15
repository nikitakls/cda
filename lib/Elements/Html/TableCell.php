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

namespace PHPHealth\CDA\Elements\Html;

/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

use PHPHealth\CDA\DataType\ReferenceType;
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class TableCell extends AbstractElement
{
    /**
     *
     */
    const TH = 'th';
    /**
     *
     */
    const TD = 'td';
    /**
     *
     * @var string
     */
    private $content;
    /**
     *
     * @var ReferenceType
     */
    private $reference;
    /**
     *
     * @var TableRow
     */
    private $row;
    /**
     * a string determining if the row is th or td
     *
     * @var string
     */
    private $level;

    /**
     * TableCell constructor.
     *
     * @param                                       $level
     * @param TableRow                              $row
     * @param string                                $content
     */
    public function __construct($level, TableRow $row = null, $content = '')
    {
        $this->setContent($content);
        if (false === \in_array($level, array(self::TH, self::TD), true)) {
            throw new \InvalidArgumentException("The level supplied was '{$level}' it must be th or td,");
        }
        $this->level = $level;
    }

    /**
     *
     * @return TableRow
     */
    public function getRow(): TableRow
    {
        return $this->row;
    }

    /**
     *
     * @param TableRow $row
     *
     * @return self
     */
    public function setRow(TableRow $row): self
    {
        $this->row = $row;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return empty($this->getContent());
    }

    /**
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        if ($this->hasReference()) {
            $this->getReference()->setValueToElement($el, $doc);
        }

        $el->appendChild($doc->createTextNode($this->getContent()));

        return $el;
    }

    /**
     * @return bool
     */
    public function hasReference(): bool
    {
        return null !== $this->reference;
    }

    /**
     *
     * @return ReferenceType
     */
    public function getReference(): ReferenceType
    {
        return $this->reference;
    }

    /**
     *
     * @param ReferenceType $reference
     *
     * @return self
     */
    public function setReference(ReferenceType $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return $this->level;
    }
}
