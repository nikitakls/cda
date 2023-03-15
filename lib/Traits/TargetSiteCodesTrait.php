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


use PHPHealth\CDA\Elements\TargetSiteCode;

trait TargetSiteCodesTrait
{
    /** @var array */
    private $targetSiteCodes = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderTargetSiteCodes(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasTargetSiteCodes()) {
            foreach ($this->getTargetSiteCodes() as $target_site_code) {
                $el->appendChild($target_site_code->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTargetSiteCodes(): bool
    {
        return \count($this->targetSiteCodes) > 0;
    }

    /**
     * @return TargetSiteCode[]
     */
    public function getTargetSiteCodes(): array
    {
        return $this->targetSiteCodes;
    }

    /**
     * @param TargetSiteCode[] $targetSiteCodes
     *
     * @return self
     */
    public function setTargetSiteCodes(array $targetSiteCodes): self
    {
        foreach ($targetSiteCodes as $target_site_code) {
            if ($target_site_code instanceof TargetSiteCode) {
                $this->addTargetSiteCode($target_site_code);
            }
        }
        $this->targetSiteCodes = $targetSiteCodes;
        return $this;
    }

    /**
     * @param TargetSiteCode $target_site_code
     *
     * @return self
     */
    public function addTargetSiteCode(TargetSiteCode $target_site_code): self
    {
        $this->targetSiteCodes[] = $target_site_code;
        return $this;
    }
}