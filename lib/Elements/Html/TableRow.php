<?php
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

namespace PHPHealth\CDA\Elements\Html;

use PHPHealth\CDA\DataType\ReferenceType;
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class TableRow extends AbstractElement
{
    /**
     *
     * @var TableCell[]
     */
    private $cells;

    /**
     * a reference to the section this row is attached to
     *
     * @var AbstractTableSection
     */
    private $section;

    /**
     *
     * @var ReferenceType
     */
    private $reference;

    /**
     * TableRow constructor.
     *
     * @param AbstractTableSection $section
     */
    public function __construct(AbstractTableSection $section = null)
    {
        $this->section = $section;
    }

    /**
     *
     * @param string $content
     *
     * @param null   $type
     *
     * @return TableCell
     */
    public function createCell($content, $type = null): TableCell
    {
        if (null === $type) {
            $type = $this->getSection() instanceof TableHead
              ? TableCell::TH
              : TableCell::TD;
        }
        $cell = new TableCell(
          $type,
          $this,
          $content);
        $this->addCell($cell);
        return $cell;
    }

    /**
     * @return AbstractTableSection
     */
    public function getSection(): AbstractTableSection
    {
        return $this->section;
    }

    /**
     * @param AbstractTableSection $section
     *
     * @return self
     */
    public function setSection(AbstractTableSection $section): self
    {
        $this->section = $section;
        return $this;
    }

    /**
     *
     * @param TableCell $cell
     *
     * @return self
     */
    public function addCell(TableCell $cell): self
    {
        $cell->setRow($this);

        $this->cells[] = $cell;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return \count($this->getCells()) > 0;
    }

    /**
     *
     * @return TableCell[]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    /**
     * @param array $cells
     *
     * @return self
     */
    public function setCells(array $cells): self
    {
        $this->cells = $cells;
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

        foreach ($this->getCells() as $cell) {
            $el->appendChild($cell->toDOMElement($doc));
        }

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
        return 'tr';
    }
}
