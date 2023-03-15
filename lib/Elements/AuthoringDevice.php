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


use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\DeterminerCodeInterface;
use PHPHealth\CDA\Traits\AsMaintainedEntitiesTrait;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\DeterminerCodeTrait;
use PHPHealth\CDA\Traits\ManufacturerModelNameTrait;
use PHPHealth\CDA\Traits\SoftwareNameTrait;

/**
 * Class AuthoringDevice
 *
 * @package PHPHealth\CDA\Elements
 */
class AuthoringDevice extends AbstractElement implements ClassCodeInterface, DeterminerCodeInterface
{
    use CodeTrait;
    use ManufacturerModelNameTrait;
    use SoftwareNameTrait;
    use AsMaintainedEntitiesTrait;
    use DeterminerCodeTrait;
    use ClassCodeTrait;

    /**
     * AuthoringDevice constructor.
     */
    public function __construct()
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassDevice)
          ->setClassCode(ClassCodeInterface::CLASS_DEVICE)
          ->setDeterminerCode(DeterminerCodeInterface::INSTANCE_);
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
        $this->renderCode($el, $doc)
          ->renderManufacturerModelName($el, $doc)
          ->renderSoftwareName($el, $doc)
          ->renderAsMaintainedEntity($el, $doc);
        return $el;
    }


    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'authoringDevice';
    }
}