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

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\TextAndMultimedia\EncapsuledData;
use PHPHealth\CDA\Interfaces\XSITypeInterface;
use PHPHealth\CDA\Traits\XSITypeTrait;


/**
 * Class Desc
 *
 * @package PHPHealth\CDA\Elements
 */
class Desc extends AbstractElement implements XSITypeInterface
{
    use XSITypeTrait;
    /** @var EncapsuledData */
    private $content;


    /**
     * Text constructor.
     *
     * @param EncapsuledData $content
     */
    public function __construct(EncapsuledData $content)
    {

        $this->setXSIType('');
        $this->setContent($content);
    }

    /**
     * @param string $content
     * @param string $xsi_type
     *
     * @return Desc
     */
    public static function fromString(string $content, string $xsi_type = ''): Desc
    {
        $desc = new Desc((new EncapsuledData())->setContent($content)->returnEncapsuledData());
        if ($xsi_type) {
            $desc->setXSIType($xsi_type);
        }
        return $desc;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        $this->getContent()->setValueToElement($el, $doc);

        return $el;
    }

    /**
     *
     * @return EncapsuledData
     */
    public function getContent(): EncapsuledData
    {
        return $this->content;
    }

    /**
     * @param EncapsuledData $content
     *
     * @return self
     */
    public function setContent(EncapsuledData $content): self
    {
        $this->content = $content;
        return $this;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'desc';
    }
}
