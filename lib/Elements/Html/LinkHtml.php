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

namespace PHPHealth\CDA\Elements\Html;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\DataType\ValueType;

class LinkHtml extends AbstractHtmlElement
{
    /** @var ValueType */
    protected $href;
    /** @var ValueType */
    protected $name;
    /** @var ValueType */
    protected $rel;
    /** @var ValueType */
    protected $rev;
    /** @var ValueType */
    protected $title;

    protected $language;
    protected $styleCode;

    public function __construct(string $choice = '', string $href = '')
    {
        parent::__construct($choice);
        $this->tag_attributes = array('href', 'name', 'rel', 'rev', 'title');
        if ($href) {
            $this->setHref($href);
        }
    }

    /**
     * @return ValueType
     */
    public function getHref(): ValueType
    {
        return $this->href;
    }

    /**
     * @param string $href
     *
     * @return self
     */
    public function setHref(string $href): self
    {
        $this->href = new ValueType($href, 'href');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getName(): ValueType
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = new ValueType($name, 'name');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getRel(): ValueType
    {
        return $this->rel;
    }

    /**
     * @param string $rel
     *
     * @return self
     */
    public function setRel(string $rel): self
    {
        $this->rel = new ValueType($rel, 'rel');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getRev(): ValueType
    {
        return $this->rev;
    }

    /**
     * @param string $rev
     *
     * @return self
     */
    public function setRev(string $rev): self
    {
        $this->rev = new ValueType($rev, 'rev');
        return $this;
    }

    /**
     * @return ValueType
     */
    public function getTitle(): ValueType
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = new ValueType($title, 'title');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc, array('href'));
        $el->appendChild($doc->createTextNode($this->getContent()));
        return $el;
    }

    /**
     * @inheritDoc
     */
    protected function canAddTag($choice): bool
    {
        return ($choice
                && ($choice instanceof FootNote
                    || $choice instanceof FootNoteRef));
    }

    /**
     * @inheritDoc
     */
    protected function getElementTag(): string
    {
        return 'linkHtml';
    }

}