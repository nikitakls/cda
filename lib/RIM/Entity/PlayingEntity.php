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


namespace PHPHealth\CDA\RIM\Entity;


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\DescTrait;
use PHPHealth\CDA\Traits\DeterminerCodeTrait;
use PHPHealth\CDA\Traits\NamesTrait;
use PHPHealth\CDA\Traits\QuantitiesTrait;
use PHPHealth\CDA\Traits\SpecimenPlayingEntityTrait;

/**
 * Class PlayingEntity
 *
 * @package PHPHealth\CDA\RIM\Entity
 */
class PlayingEntity extends AbstractElement implements ClassCodeInterface
{
    use CodeTrait;
    use QuantitiesTrait;
    use NamesTrait;
    use DescTrait;
    use SpecimenPlayingEntityTrait;
    use ClassCodeTrait;
    use DeterminerCodeTrait;

    /**
     * PlayingEntity constructor.
     *
     * @param null $code
     */
    public function __construct($code = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassRoot)
          ->setClassCode(ClassCodeInterface::ENTITY)
          ->setDeterminerCode('');
        if ($code && $code instanceof Code) {
            $this->setCode($code);
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
        $this->renderCode($el, $doc);
        $this->renderQuantities($el, $doc);
        $this->renderNames($el, $doc);
        $this->renderDesc($el, $doc);
        return $el;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'playingEntity';
    }
}