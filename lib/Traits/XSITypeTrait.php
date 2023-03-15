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


use PHPHealth\CDA\Interfaces\XSITypeInterface;

trait XSITypeTrait
{
    /** @var string */
    private $xsi_type = '';
    /** @var string[] */
    private $acceptable_xsi_types = XSITypeInterface::xsi_types;

    /**
     * @return string
     */
    public function getXSIType(): string
    {
        return $this->xsi_type;
    }

    /**
     * @param string $xsi_type
     *
     * @return self
     */
    public function setXSIType(string $xsi_type): self
    {
        if (\in_array($xsi_type, $this->getAcceptableXsiTypes(), true) === false) {
            throw new \InvalidArgumentException("The xsi_type {$xsi_type} is not valid!");
        }
        $this->xsi_type = $xsi_type;
        return $this;
    }

    /**
     * @return array
     */
    public function getAcceptableXsiTypes(): array
    {
        return $this->acceptable_xsi_types;
    }

    /**
     * @param array $acceptable_xsi_types
     *
     * @return self
     */
    public function setAcceptableXsiTypes(array $acceptable_xsi_types): self
    {
        $this->acceptable_xsi_types = $acceptable_xsi_types;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasXSIType(): bool
    {
        return '' !== $this->xsi_type;
    }


}