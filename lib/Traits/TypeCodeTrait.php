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


trait TypeCodeTrait
{
    /** @var string */
    private $type_code = '';

    /** @var string[] */
    private $acceptable_type_codes;

    /**
     * @return string
     */
    public function getTypeCode(): string
    {
        return $this->type_code;
    }

    /**
     * @param string $type_code
     *
     * @return self
     */
    public function setTypeCode(string $type_code): self
    {
        if (\in_array($type_code, $this->getAcceptableTypeCodes(), true) === false) {
            throw new \InvalidArgumentException("The type code {$type_code} is not valid!");
        }
        $this->type_code = $type_code;
        return $this;
    }

    /**
     * @return array
     */
    public function getAcceptableTypeCodes(): array
    {
        return $this->acceptable_type_codes;
    }

    /**
     * @param string[] $acceptable_type_codes
     *
     * @return self
     */
    public function setAcceptableTypeCodes(array $acceptable_type_codes): self
    {
        $this->acceptable_type_codes = $acceptable_type_codes;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTypeCode(): bool
    {
        return false === empty($this->type_code);
    }


}