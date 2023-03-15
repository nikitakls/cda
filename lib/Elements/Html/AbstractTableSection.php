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

use PHPHealth\CDA\Elements\AbstractElement;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
abstract class AbstractTableSection extends AbstractElement
{
    /**
     *
     * @var TableRow[]
     */
    private $rows = array();

    /**
     * A reference to the table where the section is attached to
     *
     * @var Table
     */
    private $table;

    /**
     * AbstractTableSection constructor.
     *
     * @param Table|NULL $table
     */
    public function __construct(Table $table = null)
    {
        $this->table = $table;
    }

    /**
     *
     * @return TableRow
     */
    public function createRow(): TableRow
    {
        $row = new TableRow($this);

        $this->addRow($row);

        return $row;
    }

    /**
     *
     * @param TableRow $row
     *
     * @return self
     */
    public function addRow(TableRow $row): self
    {
        $this->rows[] = $row;

        return $this;
    }

    /**
     *
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     *
     * @param Table $table
     *
     * @return self
     */
    public function setTable(Table $table): self
    {
        $this->table = $table;

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return \count($this->getRows()) === 0;
    }

    /**
     *
     * @return TableRow[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     *
     * @return self
     */
    public function setRows(array $rows): self
    {
        $this->rows = $rows;
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

        foreach ($this->getRows() as $row) {
            $el->appendChild($row->toDOMElement($doc));
        }

        return $el;
    }

}
