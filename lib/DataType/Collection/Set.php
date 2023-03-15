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

namespace PHPHealth\CDA\DataType\Collection;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\AnyType;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\Interfaces\ElementInterface;
use PHPHealth\CDA\Interfaces\UseAttributeInterface;

/**
 * Set of elements.
 *
 * This class restrict the sub element to the same element name. This name
 * cannot be changed after the construction of this class.
 *
 * Example of initializsation :
 *
 * ```
 * use PHPHealth\CDA\DataType\Name\PersonName;
 *
 * new Set(PersonName::class);
 * ```
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class Set extends AnyType implements \IteratorAggregate
{
    /**
     * The contained elements
     *
     * @var mixed[]
     */
    protected $elements = array();

    /**
     * @var string
     */
    private $elementName;

    /**
     *
     * @param string $elementName the class of the element to restrict
     */
    public function __construct($elementName)
    {
        $this->elementName = $elementName;
    }

    public static function fromString($root, $extension = null)
    {
        $set = new Set(InstanceIdentifier::class);
        $set->add(new InstanceIdentifier($root, $extension));
        return $set;
    }

    /**
     * @param $el
     *
     * @return self
     */
    public function add($el): self
    {
        if (!$el instanceof $this->elementName) {
            throw new \InvalidArgumentException(sprintf('The given element should be '
                                                        . 'an instance of %s, %s given', $this->elementName, \get_class($el)));
        }

        $this->elements[] = $el;

        return $this;
    }

    /**
     * check that the Set contains element, or throws an \InvalidArgumentException
     *
     * Example usage :
     *
     * ```
     * public function setIds(Set $ids)
     * {
     *      $ids->checkContainsOrThrow(InstanceIdentifier::class);
     *      $this->ids = $ids;
     *
     *      return $this;
     * }
     * ```
     *
     * @param string $name
     *
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function checkContainsOrThrow($name): bool
    {
        if ($name !== $this->getElementName()) {
            throw new \InvalidArgumentException(sprintf('The Set should countains %s'
                                                        . ' but contains %s', $name, $this->getElementName()));
        }

        return true;
    }

    /**
     * @return string
     */
    public function getElementName(): string
    {
        return $this->elementName;
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if (\count($this->elements) === 0) {
            return;
        }

        if ($this->elements[0] instanceof AnyType) {
            foreach ($this->elements as $sub) {
                $sub->setValueToElement($el, $doc);
            }
        } elseif ($this->elements[0] instanceof ElementInterface) {
            foreach ($this->elements as $sub) {
                $el->appendChild($sub->toDOMElement($doc));
                if ($sub instanceof UseAttributeInterface
                    && false === empty($sub->getUseAttribute())) {
                    $el->setAttribute(CDA::NS_CDA . 'use', $sub->getUseAttribute());
                }
            }
        } else {
            throw new \LogicException(sprintf(
              'the elements added to set are '
              . 'not instance of %s nor %s',
              AnyType::class,
              ElementInterface::class
            ));
        }
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->get() as $el) {
            yield $el;
        }
    }

    /**
     * @return mixed[]
     */
    public function get(): array
    {
        return $this->elements;
    }
}
