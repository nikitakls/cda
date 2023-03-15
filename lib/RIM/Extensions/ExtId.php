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


namespace PHPHealth\CDA\RIM\Extensions;


use PHPHealth\CDA\DataType\Code\AssigningAuthorityNameCode;
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * Class ExtId
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class ExtId extends AbstractElement
{
    const oid_nehta = '1.2.36.1.2001.1003.0';
    /** @var AssigningAuthorityNameCode */
    protected $assigningAuthorityName;

    /**
     * Id constructor.
     *
     * @param null $authority_name
     * @param null $root
     * @param null $extension
     */
    public function __construct($authority_name = null, $root = null, $extension = null)
    {
        $this->assigningAuthorityName = new AssigningAuthorityNameCode();
        $this->assigningAuthorityName->setRoot($root ?? self::oid_nehta);
        if ($authority_name) {
            $this->assigningAuthorityName->setAssigningAuthorityName($authority_name);
        }
        if ($extension) {
            $this->assigningAuthorityName->setExtension($extension);
        }
    }

    /**
     * @param $root
     * @param $extension
     *
     * @return ExtId
     */
    public static function fromString($root, $extension = null): ExtId
    {
        return new ExtId('', $root, $extension);
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc, ['assigningAuthorityName']);
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'ext:id';
    }
}