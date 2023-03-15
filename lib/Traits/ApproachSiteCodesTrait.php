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


use PHPHealth\CDA\DataType\Code\CodedWithEquivalents;

/**
 * Trait ApproachSiteCodesTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait ApproachSiteCodesTrait
{
    /** @var CodedWithEquivalents[] */
    private $approachSiteCodes = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderApproachSiteCodes(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasApproachSiteCodes()) {
            foreach ($this->getApproachSiteCodes() as $approach_site_code) {
                $approach_site_code->setValueToElement($el, $doc);
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasApproachSiteCodes(): bool
    {
        return \count($this->approachSiteCodes) > 0;
    }

    /**
     *
     * @return CodedWithEquivalents[]
     */
    public function getApproachSiteCodes(): array
    {
        return $this->approachSiteCodes;
    }

    /**
     *
     * @param CodedWithEquivalents[] $approach_site_codes
     *
     * @return self
     */
    public function setApproachSiteCodes(array $approach_site_codes): self
    {
        foreach ($approach_site_codes as $approach_site_code) {
            if ($approach_site_code instanceof CodedWithEquivalents) {
                $this->addApproachSiteCode($approach_site_code);
            }
        }
        return $this;
    }

    /**
     * @param CodedWithEquivalents $approach_site_code
     *
     * @return self
     */
    public function addApproachSiteCode(CodedWithEquivalents $approach_site_code): self
    {
        $this->approachSiteCodes[] = $approach_site_code;
        return $this;
    }

}