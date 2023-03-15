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


namespace PHPHealth\CDA\RIM\Act;


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\Traits\EncompassingEncounterTrait;
use PHPHealth\CDA\Traits\TypeCodeTrait;

/**
 * Class ComponentOf
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class ComponentOf extends AbstractElement implements TypeCodeInterface
{
    use TypeCodeTrait;
    use EncompassingEncounterTrait;

    /**
     * ComponentOf constructor.
     *
     * @param null   $encompassing_encounter
     * @param string $type_code
     */
    public function __construct($encompassing_encounter = null, $type_code = '')
    {
        $this->setAcceptableTypeCodes(array('', TypeCodeInterface::COMPONENT))
          ->setTypeCode($type_code);
        $this->templateIds = array();
        if ($encompassing_encounter) {
            $this->setEncompassingEncounter($encompassing_encounter);
        }
    }

    /**
     * Transforms the element into a DOMElement, which will be included
     * into the final CDA XML
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        if ($this->hasEncompassingEncounter()) {
            $el->appendChild($this->getEncompassingEncounter()->toDOMElement($doc));
        }
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'componentOf';
    }
}