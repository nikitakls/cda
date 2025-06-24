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

namespace PHPHealth\CDA\Elements\Address;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */
class RussianState extends BaseState
{
    public $name;
    public $code;

    public function __construct(string $name, int $code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'address:stateCode';
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
//        $el->setAttribute('xsi:type', 'CD');
        $el->setAttribute('codeSystem', '1.2.643.5.1.13.13.99.2.206');
        $el->setAttribute('codeSystemVersion', '6.5');
        $el->setAttribute('codeSystemName', 'Субъекты Российской Федерации');

        $el->setAttribute('code', $this->code);
        $el->setAttribute('displayName', $this->name);
        return $el;
    }

}
