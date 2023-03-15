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

namespace PHPHealth\CDA\Elements\Address;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *

 */

use PHPHealth\CDA\DataType\Code\AddressCodeType;
use PHPHealth\CDA\DataType\ValueType;
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * Class Telecom
 *
 * @package PHPHealth\CDA\Elements\Address
 */
class Telecom extends AbstractElement
{
    /** @var ValueType */
    protected $value;
    /** @var AddressCodeType */
    protected $address_code_use_attribute;

    /**
     * Telecom constructor.
     *
     * @param $address_code_use_attribute
     * @param $value
     */
    public function __construct($address_code_use_attribute, $value)
    {
        if ($address_code_use_attribute instanceof AddressCodeType) {
            $this->setUseAttribute($address_code_use_attribute);
        } elseif (\is_string($address_code_use_attribute)) {
            $this->setUseAttribute(new AddressCodeType($address_code_use_attribute));
        }

        if ($value instanceof ValueType) {
            $this->setValue($value);
        } elseif (\is_string($value)) {
            $this->setValue(new ValueType($value));
        }

    }

    /**
     * @param AddressCodeType $address_code_use_attribute
     *
     * @return Telecom
     */
    public function setUseAttribute(AddressCodeType $address_code_use_attribute): Telecom
    {
        $this->address_code_use_attribute = $address_code_use_attribute;
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getValue(): ValueType
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return Telecom
     */
    public function setValue($value): Telecom
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $parameters = [];
        if ($this->hasUseAttribute()) {
            $parameters[] = 'address_code_use_attribute';
        }
        $parameters[] = 'value';
        return $this->createElement($doc, $parameters);
    }

    /**
     * @return bool
     */
    public function hasUseAttribute(): bool { return null !== $this->address_code_use_attribute; }

    /**
     * @return AddressCodeType
     */
    public function getUseAttribute(): AddressCodeType
    {
        return $this->address_code_use_attribute;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'telecom';
    }


}
