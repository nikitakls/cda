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
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * Class Addr
 *
 * @package PHPHealth\CDA\Elements\Address
 */
class Addr extends AbstractElement
{

    /** @var AddressCodeType $address_code_use_attribute */
    protected $address_code_use_attribute;
    /** @var HouseNumber */
    private $house_number;
    /** @var StreetName */
    private $street_name;
    /** @var StreetNameType */
    private $street_name_type;
    /** @var StreetAddressLine */
    private $street_address_line;
    /** @var City */
    private $city;
    /** @var PostalCode */
    private $postal_code;
    /** @var State */
    private $state;
    /** @var Country */
    private $country;
    /** @var AdditionalLocator */
    private $additional_locator;

    /**
     * Addr constructor.
     *
     * @param null $street_address_line
     * @param null $city
     * @param null $state
     * @param null $postal_code
     * @param null $additional_locator
     */
    public function __construct(
      $street_address_line = null,
      $city = null,
      $state = null,
      $postal_code = null,
      $additional_locator = null
    ) {
        if ($street_address_line) {
            if ($street_address_line instanceof StreetAddressLine) {
                $this->setStreetAddressLine($street_address_line);
            } elseif (\is_string($street_address_line)) {
                $this->setStreetAddressLine(new StreetAddressLine($street_address_line));
            }
        }
        if ($city) {
            if ($city instanceof City) {
                $this->setCity($city);
            } elseif (\is_string($city)) {
                $this->setCity(new City($city));
            }
        }
        if ($state) {
            if ($state instanceof State) {
                $this->setState($state);
            } elseif (\is_string($state)) {
                $this->setState(new State($state));
            }
        }
        if ($postal_code) {
            if ($postal_code instanceof PostalCode) {
                $this->setPostalCode($postal_code);
            } elseif (\is_string($postal_code)) {
                $this->setPostalCode(new PostalCode($postal_code));
            }
        }
        if ($additional_locator) {
            if ($additional_locator instanceof AdditionalLocator) {
                $this->setAdditionalLocator($additional_locator);
            } elseif (\is_string($additional_locator)) {
                $this->setAdditionalLocator(new AdditionalLocator($additional_locator));
            }
        }
        $this->address_code_use_attribute = new AddressCodeType('');
    }

    /**
     * @return AddressCodeType
     */
    public function getUseAttribute(): AddressCodeType
    {
        return $this->address_code_use_attribute;
    }

    /**
     * @param $address_code_type
     *
     * @return Addr
     */
    public function setUseAttribute($address_code_type): Addr
    {
        $this->address_code_use_attribute = $address_code_type instanceof AddressCodeType
          ? $address_code_type
          : new AddressCodeType($address_code_type);
        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc, ['address_code_use_attribute']);
        // if the street address line is present use it, otherwise see if the individual components were set.
        if ($this->hasStreetAddressLine()) {
            $el->appendChild($this->getStreetAddressLine()->toDOMElement($doc));
        } else {
            if (null !== $this->house_number) {
                $el->appendChild($this->getHouseNumber()->toDOMElement($doc));
            }
            if (null !== $this->street_name) {
                $el->appendChild($this->getStreetName()->toDOMElement($doc));
            }
            if (null !== $this->street_name_type) {
                $el->appendChild($this->getStreetNameType()->toDOMElement($doc));
            }
        }

        if ($this->hasCity()) {
            $el->appendChild($this->getCity()->toDOMElement($doc));
        }
        if ($this->hasState()) {
            $el->appendChild($this->getState()->toDOMElement($doc));
        }
        if ($this->hasPostalCode()) {
            $el->appendChild($this->getPostalCode()->toDOMElement($doc));
        }
        if ($this->hasAdditionalLocator()) {
            $el->appendChild($this->getAdditionalLocator()->toDOMElement($doc));
        }
        if ($this->hasCountry()) {
            $el->appendChild($this->getCountry()->toDOMElement($doc));
        }
        return $el;
    }

    /**
     * @return bool
     */
    public function hasStreetAddressLine(): bool
    {
        return $this->street_address_line !== null;
    }

    /**
     * @return StreetAddressLine
     */
    public function getStreetAddressLine(): StreetAddressLine
    {
        return $this->street_address_line;
    }

    /**
     * @param StreetAddressLine $street_address_line
     *
     * @return Addr
     */
    public function setStreetAddressLine(StreetAddressLine $street_address_line): Addr
    {
        $this->street_address_line = $street_address_line;
        return $this;
    }

    /**
     * @return HouseNumber
     */
    public function getHouseNumber(): HouseNumber
    {
        return $this->house_number;
    }

    /**
     * @param HouseNumber $house_number
     *
     * @return Addr
     */
    public function setHouseNumber(HouseNumber $house_number): Addr
    {
        $this->house_number = $house_number;
        return $this;
    }

    /**
     * @return StreetName
     */
    public function getStreetName(): StreetName
    {
        return $this->street_name;
    }

    /**
     * @param StreetName $street_name
     *
     * @return Addr
     */
    public function setStreetName(StreetName $street_name): Addr
    {
        $this->street_name = $street_name;
        return $this;
    }

    /**
     * @return StreetNameType
     */
    public function getStreetNameType(): StreetNameType
    {
        return $this->street_name_type;
    }

    /**
     * @param StreetNameType $street_name_type
     *
     * @return Addr
     */
    public function setStreetNameType(StreetNameType $street_name_type): Addr
    {
        $this->street_name_type = $street_name_type;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCity(): bool
    {
        return null !== $this->city;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     *
     * @return Addr
     */
    public function setCity(City $city): Addr
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasState(): bool
    {
        return null !== $this->state;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     *
     * @return Addr
     */
    public function setState(State $state): Addr
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasPostalCode(): bool
    {
        return null !== $this->postal_code;
    }

    /**
     * @return PostalCode
     */
    public function getPostalCode(): PostalCode
    {
        return $this->postal_code;
    }

    /**
     * @param PostalCode $postal_code
     *
     * @return Addr
     */
    public function setPostalCode(PostalCode $postal_code): Addr
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAdditionalLocator(): bool
    {
        return null !== $this->additional_locator;
    }

    /**
     * @return AdditionalLocator
     */
    public function getAdditionalLocator(): AdditionalLocator
    {
        return $this->additional_locator;
    }

    /**
     * @param AdditionalLocator $additional_locator
     *
     * @return Addr
     */
    public function setAdditionalLocator(AdditionalLocator $additional_locator): Addr
    {
        $this->additional_locator = $additional_locator;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCountry(): bool
    {
        return null !== $this->country;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     *
     * @return Addr
     */
    public function setCountry(Country $country): Addr
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'addr';
    }
}
