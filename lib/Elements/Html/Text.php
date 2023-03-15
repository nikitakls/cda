<?php

/**
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
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

use PHPHealth\CDA\Interfaces\MediaTypeInterface;
use PHPHealth\CDA\Interfaces\XSITypeInterface;
use PHPHealth\CDA\Traits\XSITypeTrait;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class Text extends AbstractHtmlElement implements XSITypeInterface, MediaTypeInterface
{
    use XSITypeTrait;
    /** @var string */
    private $media_type;

    /**
     * Text constructor.
     *
     * @param $choice
     */
    public function __construct($choice = '')
    {
        parent::__construct(\is_string($choice)
          ? $choice
          : '');
        $this->setXSIType('')
          ->setMediaType('');
        if ($choice && \is_string($choice) === false) {
            $this->addTag($choice);
        }

    }


    /**
     * @inheritDoc
     */
    public function getMediaType(): string
    {
        return $this->media_type;
    }

    public function setMediaType(string $media_type): self
    {
        $this->media_type = $media_type;
        return $this;
    }

    protected function canAddTag($choice): bool
    {
        return ($choice
                && ($choice instanceof LinkHtml
                    || $choice instanceof Sub
                    || $choice instanceof Sup
                    || $choice instanceof Br
                    || $choice instanceof Footnote
                    || $choice instanceof FootNoteRef
                    || $choice instanceof Paragraph
                    || $choice instanceof ReferenceElement
                    || $choice instanceof ListElement
                    || $choice instanceof Table
                    || $choice instanceof RenderMultiMedia));
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'text';
    }
}
