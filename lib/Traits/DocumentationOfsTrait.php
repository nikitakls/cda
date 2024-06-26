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


use PHPHealth\CDA\RIM\Act\DocumentationOf;

/**
 * Trait DocumentationOfsTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait DocumentationOfsTrait
{
    /** @var DocumentationOf[] */
    private $documentationOfs = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderDocumentationOfs(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasDocumentationOfs()) {
            foreach ($this->getDocumentationOfs() as $documentation_of) {
                $el->appendChild($documentation_of->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDocumentationOfs(): bool
    {
        return \count($this->documentationOfs) > 0;
    }

    /**
     * @return DocumentationOf[]
     */
    public function getDocumentationOfs(): array
    {
        return $this->documentationOfs;
    }

    /**
     * @param DocumentationOf[] $documentationOfs
     *
     * @return self
     */
    public function setDocumentationOfs(array $documentationOfs): self
    {
        foreach ($documentationOfs as $documentation_of) {
            if ($documentation_of instanceof DocumentationOf) {
                $this->addComponentOf($documentation_of);
            }
        }
        return $this;
    }

    /**
     * @param DocumentationOf $documentation_of
     *
     * @return self
     */
    public function addDocumentationOf(DocumentationOf $documentation_of): self
    {
        $this->documentationOfs[] = $documentation_of;
        return $this;
    }

}