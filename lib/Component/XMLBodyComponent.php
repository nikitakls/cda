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

namespace PHPHealth\CDA\Component;

use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\SingleComponentTrait;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class XMLBodyComponent extends AbstractComponent implements ClassCodeInterface, MoodCodeInterface
{
    use SingleComponentTrait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    /**
     * XMLBodyComponent constructor.
     *
     * @param null $component
     */
    public function __construct($component = null)
    {
        $acceptable_values = array(
          '',
          MoodCodeInterface::EVENT,
          MoodCodeInterface::GOAL,
          MoodCodeInterface::INTENT,
          MoodCodeInterface::PROMISE,
          MoodCodeInterface::PROPOSAL,
          MoodCodeInterface::REQUEST
        );
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setAcceptableMoodCodes($acceptable_values)
          ->setClassCode(ClassCodeInterface::DOCUMENT_BODY)
          ->setMoodCode('');
        if ($component instanceof SingleComponent) {
            $this->addComponent($component);
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

        foreach ($this->getComponents() as $component) {
            $el->appendChild($component->toDOMElement($doc));
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
        return 'structuredBody';
    }
}
