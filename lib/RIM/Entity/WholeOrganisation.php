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

namespace PHPHealth\CDA\RIM\Entity;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */


use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\Address\Addr;
use PHPHealth\CDA\Elements\Address\Telecom;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\Traits\AddrsTrait;
use PHPHealth\CDA\Traits\AsEntityIdentifierTrait;
use PHPHealth\CDA\Traits\EntityNameTrait;
use PHPHealth\CDA\Traits\TelecomsTrait;


/**
 * Class WholeOrganisation
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class WholeOrganisation extends AbstractElement
{
    use EntityNameTrait;
    use AsEntityIdentifierTrait;
    use AddrsTrait;
    use TelecomsTrait;

    /**
     * WholeOrganisation constructor.
     *
     * @param null $name
     * @param null $as_identifier
     * @param null $addr
     * @param null $telecom
     */
    public function __construct($name = null, $as_identifier = null, $addr = null, $telecom = null)
    {
        if ($name && $name instanceof EntityName) {
            $this->setName($name);
        }
        if ($as_identifier && $as_identifier instanceof AsEntityIdentifier) {
            $this->setAsEntityIdentifier($as_identifier);
        }
        if ($addr && $addr instanceof Addr) {
            $this->addAddr($addr);
        }
        if ($telecom && $telecom instanceof Telecom) {
            $this->addTelecom($telecom);
        }
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderEntityName($el, $doc);
        $this->renderAsEntityIdentifier($el, $doc);
        $this->renderAddrs($el, $doc);
        $this->renderTelecoms($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'wholeOrganization';
    }

}