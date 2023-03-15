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

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */


namespace PHPHealth\CDA\Elements\Html;


use PHPHealth\CDA\Elements\AbstractElement;

abstract class AbstractHtmlElement extends AbstractElement
{
    /** @var string */
    protected $content;

    /** @var array */
    protected $tags;

    protected $tag_attributes;

    /**
     * AbstractHtmlElement constructor.
     *
     * @param string $choice
     */
    public function __construct($choice = '')
    {
        $this->tags           = array();
        $this->tag_attributes = array();
        if ($choice) {
            if (\is_string($choice)) {
                $this->setContent($choice);
            } else {
                $this->addTag($choice);
            }
        }
    }

    /**
     * @param $choice
     *
     * @return self
     */
    public function addTag($choice): self
    {
        if ($this->canAddTag($choice)) {
            $this->tags[] = $choice;
        }
        return $this;
    }

    /**
     * Checks to see if the choice can be added to the tags array of this class.
     *
     * @param $choice
     *
     * @return bool
     */
    abstract protected function canAddTag($choice): bool;

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc, $this->tag_attributes);
        if ($this->hasContent()) {
            $el->appendChild($doc->createTextNode($this->getContent()));
        } else {
            foreach ($this->getTags() as $tag) {
                $el->appendChild($tag->toDOMElement($doc));
            }
        }
        return $el;
    }

    /**
     * @return bool
     */
    public function hasContent(): bool
    {
        return empty($this->content) === false;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     *
     * @return self
     */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return Br
     */
    public function returnBr(): Br
    {
        if ($this instanceof Br) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Br');
    }

    /**
     * @return Caption
     */
    public function returnCaption(): Caption
    {
        if ($this instanceof Caption) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Caption');
    }

    /**
     * @return FootNote
     */
    public function returnFootNote(): FootNote
    {
        if ($this instanceof FootNote) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class FootNote');
    }

    /**
     * @return FootNoteRef
     */
    public function returnFootNoteRef(): FootNoteRef
    {
        if ($this instanceof FootNoteRef) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class FootNoteRef');
    }

    /**
     * @return Item
     */
    public function returnItem(): Item
    {
        if ($this instanceof Item) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Item');
    }

    /**
     * @return LinkHtml
     */
    public function returnLinkHtml(): LinkHtml
    {
        if ($this instanceof LinkHtml) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class LinkHtml');
    }

    /**
     * @return ListElement
     */
    public function returnListElement(): ListElement
    {
        if ($this instanceof ListElement) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class ListElement');
    }

    /**
     * @return Paragraph
     */
    public function returnParagraph(): Paragraph
    {
        if ($this instanceof Paragraph) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Paragraph');
    }

    /**
     * @return ReferenceElement
     */
    public function returnReferenceElement(): ReferenceElement
    {
        if ($this instanceof ReferenceElement) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class ReferenceElement');
    }

    /**
     * @return RenderMultiMedia
     */
    public function returnRenderMultiMedia(): RenderMultiMedia
    {
        if ($this instanceof RenderMultiMedia) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class RenderMultiMedia');
    }

    /**
     * @return Sub
     */
    public function returnSub(): Sub
    {
        if ($this instanceof Sub) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Sub');
    }

    /**
     * @return Sup
     */
    public function returnSup(): Sup
    {
        if ($this instanceof Sup) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Sup');
    }

    /**
     * @return Table
     */
    public function returnTable(): Table
    {
        if ($this instanceof Table) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Table');
    }

    /**
     * @return TableBody
     */
    public function returnTableBody(): TableBody
    {
        if ($this instanceof TableBody) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class TableBody');
    }

    /**
     * @return TableCell
     */
    public function returnTableCell(): TableCell
    {
        if ($this instanceof TableCell) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class TableCell');
    }

    /**
     * @return TableHead
     */
    public function returnTableHead(): TableHead
    {
        if ($this instanceof TableHead) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class TableHead');
    }

    /**
     * @return TableRow
     */
    public function returnTableRow(): TableRow
    {
        if ($this instanceof TableRow) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class TableRow');
    }

    /**
     * @return Text
     */
    public function returnText(): Text
    {
        if ($this instanceof Text) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Text');
    }

    /**
     * @return Title
     */
    public function returnTitle(): Title
    {
        if ($this instanceof Title) {
            return $this;
        }
        throw new \RuntimeException('The element is not an instance of Class Title');
    }
}