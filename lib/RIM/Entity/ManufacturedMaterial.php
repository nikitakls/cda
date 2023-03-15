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
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\DataType\Code\CodedWithEquivalents;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Traits\CodeTrait;

/**
 * Class ManufacturedMaterial
 *
 * @package PHPHealth\CDA\RIM\Entity
 */
class ManufacturedMaterial extends DrugOrMaterial
{
    use CodeTrait;

    /**
     * ManufacturedLabeledDrug constructor.
     *
     * @param CodedWithEquivalents $code
     */
    public function __construct($code = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassManufacturedMaterial)
          ->setClassCode(ClassCodeInterface::MANUFACTURED_MATERIAL);
        if ($code && $code instanceof Code) {
            $this->setCode($code);
        }
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderCode($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'manufacturedMaterial';
    }
}
