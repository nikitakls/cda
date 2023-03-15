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


/**
 * Trait MoodCodeTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait MoodCodeTrait
{
    /** @var string */
    private $mood_code = '';
    /** @var string[] */
    private $acceptable_mood_codes = [''];

    /**
     * @return string
     */
    public function getMoodCode(): string
    {
        return $this->mood_code;
    }

    /**
     * @param string $mood_code
     *
     * @return self
     */
    public function setMoodCode(string $mood_code): self
    {
        if (\in_array($mood_code, $this->getAcceptableMoodCodes(), true) === false) {
            throw new \InvalidArgumentException("The mood code {$mood_code} is not valid!");
        }
        $this->mood_code = $mood_code;
        return $this;
    }

    /**
     * @return array
     */
    public function getAcceptableMoodCodes(): array
    {
        return $this->acceptable_mood_codes;
    }

    /**
     * @param string[] $acceptable_mood_codes
     *
     * @return self
     */
    public function setAcceptableMoodCodes(array $acceptable_mood_codes): self
    {
        $this->acceptable_mood_codes = $acceptable_mood_codes;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMoodCode(): bool
    {
        return false === empty($this->mood_code);
    }


}