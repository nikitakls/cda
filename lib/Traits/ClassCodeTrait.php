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


trait ClassCodeTrait
{
    /** @var string */
    private $class_code = '';
    /** @var string[] */
    private $acceptable_class_codes = array('');

    /**
     * @return string
     */
    public function getClassCode(): string
    {
        return $this->class_code;
    }

    /**
     * @param string $class_code
     *
     * @return self
     */
    public function setClassCode(string $class_code): self
    {
        if (\in_array($class_code, $this->getAcceptableClassCodes(), true) === false) {
            throw new \InvalidArgumentException("The class code {$class_code} is not valid!");
        }
        $this->class_code = $class_code;
        return $this;
    }

    /**
     * @return array
     */
    public function getAcceptableClassCodes(): array
    {
        return $this->acceptable_class_codes;
    }

    /**
     * @param string[] $acceptable_class_codes
     *
     * @return self
     */
    public function setAcceptableClassCodes(array $acceptable_class_codes): self
    {
        $this->acceptable_class_codes = $acceptable_class_codes;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasClassCode(): bool
    {
        return empty($this->class_code) === false;
    }

}