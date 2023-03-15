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


use PHPHealth\CDA\Elements\MethodCode;

trait MethodCodesTrait
{
    /** @var MethodCode[] */
    private $methodCodes = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderMethodCodes(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasMethodCodes()) {
            foreach ($this->getMethodCodes() as $method_code) {
                $el->appendChild($method_code->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMethodCodes(): bool
    {
        return \count($this->methodCodes) > 0;
    }

    /**
     * @return MethodCode[]
     */
    public function getMethodCodes(): array
    {
        return $this->methodCodes;
    }

    /**
     * @param MethodCode[] $methodCodes
     *
     * @return self
     */
    public function setMethodCodes(array $methodCodes): self
    {
        foreach ($methodCodes as $method_code) {
            if ($method_code instanceof MethodCode) {
                $this->addMethodCode($method_code);
            }
        }
        return $this;
    }

    /**
     * @param MethodCode $method_code
     *
     * @return self
     */
    public function addMethodCode(MethodCode $method_code): self
    {
        $this->methodCodes[] = $method_code;
        return $this;
    }
}