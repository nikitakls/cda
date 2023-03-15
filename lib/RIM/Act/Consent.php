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
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodedValueTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\StatusCodeTrait;

/**
 * Class Consent
 *
 * @package PHPHealth\CDA\RIM\Act
 */
class Consent extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use IdsTrait;
    use CodedValueTrait;
    use StatusCodeTrait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    /**
     * Consent constructor.
     */
    public function __construct()
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setAcceptableMoodCodes(MoodCodeInterface::ActMood)
          ->setClassCode(ClassCodeInterface::CONSENT)
          ->setMoodCode(MoodCodeInterface::EVENT);
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
        if ($this->hasIds()) {
            foreach ($this->getIds() as $id) {
                $el->appendChild($id->toDOMElement($doc));
            }
        }

        if ($this->hasCodedValue()) {
            $el->appendChild((new Code($this->getCodedValue()))->toDOMElement($doc));
        }
        if ($this->hasStatusCode()) {
            $el->appendChild($this->getStatusCode()->toDOMElement($doc));
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
        return 'consent';
    }

}