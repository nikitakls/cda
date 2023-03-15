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


namespace PHPHealth\CDA\RIM\Extensions;


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;

class ExtAsSpecimenInContainer extends AbstractElement implements ClassCodeInterface
{
    use ClassCodeTrait;
    /** @var ExtContainer */
    protected $extContainer;


    public function __construct(ExtContainer $ext_container)
    {
        $this->setAcceptableClassCodes(['', ClassCodeInterface::CONTAINER])
          ->setClassCode(ClassCodeInterface::CONTAINER)
          ->setExtContainer($ext_container);
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $el->appendChild($this->getExtContainer()->toDOMElement($doc));
        return $el;
    }

    /**
     * @return ExtContainer
     */
    public function getExtContainer(): ExtContainer
    {
        return $this->extContainer;
    }

    /**
     * @param ExtContainer $extContainer
     *
     * @return self
     */
    public function setExtContainer(ExtContainer $extContainer): self
    {
        $this->extContainer = $extContainer;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'ext:asSpecimenInContainer';
    }
}