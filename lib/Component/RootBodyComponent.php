<?php

/**
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
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

/**
 * Component which contains the body of the document
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */

/**
 * Class RootBodyComponent
 *
 * @package PHPHealth\CDA\Component
 */
class RootBodyComponent extends AbstractComponent
{
    /**
     *
     * @var AbstractComponent[]
     */
    private $components = array();

    /**
     * RootBodyComponent constructor.
     *
     * @param null $component
     */
    public function __construct($component = null)
    {
        if ($component instanceof AbstractComponent) {
            $this->addComponent($component);
        }
    }

    /**
     * @param AbstractComponent $component
     */
    public function addComponent(AbstractComponent $component)
    {
        $this->components[] = $component;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return \count($this->components) === 0;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $component = $this->createElement($doc);
        foreach ($this->getComponents() as $subComponent) {
            $component->appendChild($subComponent->toDOMElement($doc));
        }
        return $component;
    }

    /**
     *
     * @return AbstractComponent[]
     */
    public function getComponents(): array
    {
        return $this->components;
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
