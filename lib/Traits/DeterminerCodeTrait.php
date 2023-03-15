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


use PHPHealth\CDA\Interfaces\DeterminerCodeInterface;

trait DeterminerCodeTrait
{
    /** @var string */
    private $determiner_code;

    private $acceptable_determiner_codes = DeterminerCodeInterface::EntityDeterminer;

    /**
     * @return string
     */
    public function getDeterminerCode(): string
    {
        return $this->determiner_code;
    }

    /**
     * @param string $determiner_code
     *
     * @return self
     */
    public function setDeterminerCode(string $determiner_code): self
    {
        if (\in_array($determiner_code, $this->getAcceptableDeterminerCodes(), true) === false) {
            throw new \InvalidArgumentException("The determiner code {$determiner_code} is not an acceptable value!");
        }
        $this->determiner_code = $determiner_code;
        return $this;
    }

    /**
     * @return array
     */
    public function getAcceptableDeterminerCodes(): array
    {
        return $this->acceptable_determiner_codes;
    }

    /**
     * @param array $acceptable_determiner_codes
     *
     * @return self
     */
    public function setAcceptableDeterminerCodes(array $acceptable_determiner_codes): self
    {
        $this->acceptable_determiner_codes = $acceptable_determiner_codes;
        return $this;
    }
}