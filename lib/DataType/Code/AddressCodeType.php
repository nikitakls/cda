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

namespace PHPHealth\CDA\DataType\Code;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\AnyType;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 * implements AS 5017-2006: Health Care Client Electronic Communication Usage Code
 *
 */
class AddressCodeType extends AnyType
{
    const BUSINESS = 'WP';  // An office address. First choice for business related con- tacts during business hours.
    const HOME     = 'H';   // A communication address at a home, attempted contacts for business purposes might
    // intrude privacy and chances are one will contact family or other household members
    // instead of the person one wishes to call. Typically used with urgent cases, or if no other contacts are available.
    const HOME_BUSINESS     = 'WP H';
    const HOME_PRIMARY      = 'HP';
    const HOME_VACATION     = 'HV';
    const ANSWERING_SERVICE = 'AS';
    const EMERGENCY_CONTACT = 'EC';
    const MOBILE_CONTACT    = 'MC';
    const PAGER             = 'PG';
    const WORKPLACE         = 'WP';

    /** @var string */
    private $code;

    /**
     * AddressCodeType constructor.
     *
     * @param string $code
     */
    public function __construct($code = '')
    {
        $this->setCode($code);
    }

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->getCode()) {
            $el->setAttribute(CDA::NS_CDA . 'use', $this->getCode());
        }
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return AddressCodeType
     */
    public function setCode(string $code): self
    {
        $upper_code = strtoupper($code);
        $this->code = \in_array($upper_code,
          array(
            self::BUSINESS,
            self::HOME,
            self::HOME_BUSINESS,
            self::HOME_PRIMARY,
            self::HOME_VACATION,
            self::ANSWERING_SERVICE,
            self::EMERGENCY_CONTACT,
            self::MOBILE_CONTACT,
            self::PAGER,
            self::WORKPLACE
          ), true)
          ? $upper_code
          : '';
        return $this;
    }
}