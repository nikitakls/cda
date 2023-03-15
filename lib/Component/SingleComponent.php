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

use PHPHealth\CDA\Component\SingleComponent\Section;
use PHPHealth\CDA\Interfaces\TypeCodeInterface;
use PHPHealth\CDA\Traits\TypeCodeTrait;

/**
 * Single component. Must be included in a XMLBodyComponent.
 *
 * Will return a `<component>` element node.
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class SingleComponent extends AbstractComponent implements TypeCodeInterface
{
    use TypeCodeTrait;

    /** @var Section[] */
    private $sections;

    /**
     * SingleComponent constructor.
     *
     * @param null $sections
     */
    public function __construct($sections = null)
    {
        $this->setAcceptableTypeCodes(['', TypeCodeInterface::COMPONENT])
          ->setTypeCode(TypeCodeInterface::COMPONENT);
        $this->sections = array();
        if (\is_array($sections)) {
            $this->setSections($sections);
        } elseif ($sections instanceof Section) {
            $this->addSection($sections);
        }
    }

    /**
     *
     * @param Section $section
     *
     * @return self
     */
    public function addSection(Section $section): self
    {
        $this->sections[] = $section;

        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $component = $this->createElement($doc);
        foreach ($this->getSections() as $section) {
            $component->appendChild($section->toDOMElement($doc));
        }
        return $component;
    }

    /**
     *
     * @return Section[]
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     *
     * @param Section[] $sections
     *
     * @return self
     */
    public function setSections($sections): self
    {
        $this->sections = array();

        foreach ($sections as $section) {
            if ($section instanceof Section) {
                $this->addSection($section);
            }
        }

        return $this;
    }

    /**
     * get the element tag name
     *
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'component';
    }
}
