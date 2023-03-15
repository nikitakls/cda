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

use PHPHealth\CDA\DataType\ValueType;

/**
 * Class ReferenceElement
 *
 * @package PHPHealth\CDA\Elements\Html
 */
class ReferenceElement extends AbstractHtmlElement
{
    /** @var ValueType */
    protected $value;

    /**
     * ReferenceElement constructor.
     *
     * @param string $value
     */
    public function __construct(string $value = '')
    {
        parent::__construct('');
        $this->tag_attributes = array('value');
        $this->setValue($value);
    }

    /**
     * @return ValueType
     */
    public function getValue(): ValueType
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return ReferenceElement
     */
    public function setValue(string $value): self
    {
        $this->value = new ValueType($value, 'value');
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function canAddTag($choice): bool
    {
        return false;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'reference';
    }
}
