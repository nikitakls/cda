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


use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\ValueType;
use PHPHealth\CDA\Elements\Html\ReferenceElement;
use PHPHealth\CDA\Interfaces\MediaTypeInterface;
use PHPHealth\CDA\Interfaces\XSITypeInterface;
use PHPHealth\CDA\Traits\ValueTypeTrait;
use PHPHealth\CDA\Traits\XSITypeTrait;

class Value extends AbstractElement implements XSITypeInterface, MediaTypeInterface
{
    use ValueTypeTrait;
    use XSITypeTrait;

    // attributes

    /** @var ValueType */
    protected $code;
    /** @var ValueType */
    protected $code_system;
    /** @var ValueType */
    protected $code_system_name;
    /** @var ValueType */
    protected $display_name;
    /** @var ValueType */
    protected $units;
    /** @var ReferenceElement */
    protected $reference_element;
    /** @var  string */
    protected $content;
    /** @var string */
    protected $media_type;
    // child elements
    /** @var Low */
    protected $low;
    /** @var High */
    protected $high;
    /** @var array */
    protected $tags;

    /**
     * Value constructor.
     * XSI types are required for the value tag
     *
     * @link http://www.cdapro.com/know/25047
     *
     * @param string $xsi_type
     * @param string $value
     */
    public function __construct(string $value = '', string $xsi_type = '')
    {
        $this->media_type = '';
        if ($xsi_type === XSITypeInterface::BOOLEAN
            && \in_array($value, array('true', 'false'), true) === false) {
            throw new \InvalidArgumentException("The value for booleans must be true or false, {$value} supplied!");
        }
        if ($value && \is_string($value)) {
            $this->setValueTypeString($value);
        }
        $this->setXSIType($xsi_type);
        $this->tags = array();
    }

    /**
     * @param string $value_type
     *
     * @return Value
     */
    public function setValueTypeString(string $value_type): self
    {
        $this->setValueType(new ValueType($value_type, 'value'));
        return $this;
    }

    /**
     * @param string $code
     * @param string $displayName
     *
     * @param bool   $xsi_attribute
     *
     * @return Value
     */
    public static function SNOMED(string $code, string $displayName, bool $xsi_attribute = true): Value
    {
        $value = (new Value())
          ->setCode($code)
          ->setDisplayName($displayName)
          ->setCodeSystem('2.16.840.1.113883.6.96')
          ->setCodeSystemName('SNOMED CT');
        if ($xsi_attribute) {
            $value->setXSIType(XSITypeInterface::CONCEPT_DESCRIPTOR);
        }
        return $value;
    }

    public static function NCTISValue(string $code, string $displayName, bool $xsi_attribute = true): Value
    {
        $value = (new Value())
          ->setCode($code)
          ->setDisplayName($displayName)
          ->setCodeSystem('2.16.840.1.113883.6.96')
          ->setCodeSystemName('SNOMED CT');
        if ($xsi_attribute) {
            $value->setXSIType(XSITypeInterface::CONCEPT_DESCRIPTOR);
        }
        return $value;
    }

    public static function HL7ResultStatus(string $code, string $displayName, bool $xsi_attribute = true): Value
    {
        $value = (new Value())
          ->setCode($code)
          ->setDisplayName($displayName)
          ->setCodeSystem('2.16.840.1.113883.12.123')
          ->setCodeSystemName('HL7 Result Status');
        if ($xsi_attribute) {
            $value->setXSIType(XSITypeInterface::CONCEPT_DESCRIPTOR);
        }
        return $value;
    }


    /**
     * @return ValueType
     */
    public function getCode(): ValueType
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return Value
     */
    public function setCode(string $code): self
    {
        $this->code = new ValueType ($code, 'code');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getCodeSystem(): ValueType
    {
        return $this->code_system;
    }

    /**
     * @param string $code_system
     *
     * @return Value
     */
    public function setCodeSystem(string $code_system): self
    {
        $this->code_system = new ValueType ($code_system, 'codeSystem');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getCodeSystemName(): ValueType
    {
        return $this->code_system_name;
    }

    /**
     * @param string $code_system_name
     *
     * @return Value
     */
    public function setCodeSystemName(string $code_system_name): self
    {
        $this->code_system_name = new ValueType ($code_system_name, 'codeSystemName');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getDisplayName(): ValueType
    {
        return $this->display_name;
    }

    /**
     * @param string $display_name
     *
     * @return Value
     */
    public function setDisplayName(string $display_name): self
    {
        $this->display_name = new ValueType ($display_name, 'displayName');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getUnits(): ValueType
    {
        return $this->units;
    }

    /**
     * @param string $units
     *
     * @return Value
     */
    public function setUnits(string $units): self
    {
        $this->units = new ValueType ($units, 'unit');
        return $this;
    }

    /**
     * @return string
     */
    public function getElementTag(): string
    {
        return 'value';
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $attributes = array();
        if ($this->hasValueType()) {
            $attributes[] = 'value_type';
        }
        if ($this->hasCode()) {
            $attributes[] = 'code';
        }
        if ($this->hasCodeSystem()) {
            $attributes[] = 'code_system';
        }
        if ($this->hasCodeSystemName()) {
            $attributes[] = 'code_system_name';
        }
        if ($this->hasDisplayName()) {
            $attributes[] = 'display_name';
        }
        if ($this->hasUnits()) {
            $attributes[] = 'units';
        }

        $el = $this->createElement($doc, $attributes);
        if ($this->content) {
            $el->appendChild(new \DOMText($this->getContent()));
        } elseif ($this->hasReferenceElement()) {
            $el->appendChild($this->getReferenceElement()->toDOMElement($doc));
        }

        if ($this->hasLow()) {
            $el->appendChild($this->getLow()->toDOMElement($doc));
        }
        if ($this->hasHigh()) {
            $el->appendChild($this->getHigh()->toDOMElement($doc));
        }

        if ($this->hasTags()) {
            foreach ($this->getTags() as $tag => $value) {
                $el->appendChild($doc->createElement(CDA::NS_CDA . $tag, $value));
            }
        }

        return $el;
    }

    public function hasCode(): bool
    {
        return null !== $this->code;
    }

    public function hasCodeSystem(): bool
    {
        return null !== $this->code_system;
    }

    public function hasCodeSystemName(): bool
    {
        return null !== $this->code_system_name;
    }

    public function hasDisplayName(): bool
    {
        return null !== $this->display_name;
    }

    public function hasUnits(): bool
    {
        return null !== $this->units;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Value
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function hasReferenceElement(): bool
    {
        return null !== $this->reference_element;
    }

    /**
     * @return ReferenceElement
     */
    public function getReferenceElement(): ReferenceElement
    {
        return $this->reference_element;
    }

    /**
     * @param ReferenceElement $reference_element
     *
     * @return Value
     */
    public function setReferenceElement(ReferenceElement $reference_element): Value
    {
        $this->reference_element = $reference_element;
        return $this;
    }

    public function hasLow(): bool
    {
        return null !== $this->low;
    }

    /**
     * @return Low
     */
    public function getLow(): Low
    {
        return $this->low;
    }

    /**
     * @param Low $low
     *
     * @return self
     */
    public function setLow(Low $low): self
    {
        $this->low = $low;
        return $this;
    }

    public function hasHigh(): bool
    {
        return null !== $this->high;
    }

    /**
     * @return High
     */
    public function getHigh(): High
    {
        return $this->high;
    }

    /**
     * @param High $high
     *
     * @return self
     */
    public function setHigh(High $high): self
    {
        $this->high = $high;
        return $this;
    }

    public function hasTags(): bool
    {
        return \count($this->tags) > 0;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param $tag
     * @param $value
     *
     * @return Value
     */
    public function addTagValue($tag, $value): Value
    {
        $this->tags[$tag] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMediaType(): string
    {
        return $this->media_type;
    }

    public function setMediaType(string $media_type): self
    {
        $this->media_type = $media_type;
        return $this;
    }
}