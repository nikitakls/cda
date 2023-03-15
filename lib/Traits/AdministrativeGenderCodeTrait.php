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

namespace PHPHealth\CDA\Traits;


use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AdministrativeGenderCode;

/**
 * Trait AdministrativeGenderCodeTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait AdministrativeGenderCodeTrait
{
    /** @var AdministrativeGenderCode */
    private $administrative_gender_code;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return AdministrativeGenderCodeTrait
     */
    public function renderAdministrativeGenderCode(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasAdministrativeGenderCode()) {
            $el->appendChild($this->getAdministrativeGenderCode()->toDOMElement($doc));
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasAdministrativeGenderCode(): bool
    {
        return null !== $this->administrative_gender_code;
    }

    /**
     * @return AdministrativeGenderCode
     */
    public function getAdministrativeGenderCode(): AdministrativeGenderCode
    {
        return $this->administrative_gender_code;
    }

    /**
     * @param $value
     *
     * @return self
     */
    public function setAdministrativeGenderCode($value): self
    {
        if ($value instanceof CodedValue) {
            $this->administrative_gender_code = new AdministrativeGenderCode($value);
            return $this;
        }

        if ($value instanceof AdministrativeGenderCode) {
            $this->administrative_gender_code = $value;
            return $this;
        }
        $this->administrative_gender_code = AdministrativeGenderCode::getCodedValueFromString($value);
        return $this;
    }
}