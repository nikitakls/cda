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


namespace PHPHealth\CDA\Elements;


use PHPHealth\CDA\Traits\NameTrait;
use PHPHealth\CDA\Traits\ValueTrait;

class Qualifier extends AbstractElement
{
    use NameTrait;
    use ValueTrait;

    public function __construct(Name $name, Value $value)
    {
        $this->setName($name)
          ->setValue($value);

    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $el->appendChild($this->getName()->toDOMElement($doc));
        $el->appendChild($this->getValue()->toDOMElement($doc));
        return $el;
    }


    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'qualifier';
    }
}