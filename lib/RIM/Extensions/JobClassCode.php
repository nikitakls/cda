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


use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AbstractElement;

/**
 * Class JobClassCode
 *
 * @package PHPHealth\CDA\RIM\Extensions
 * @link    https://hl7.org/fhir/2018Jan/v3/EmployeeJobClass/cs.html
 */
class JobClassCode extends AbstractElement
{
    /** CodedValue */
    const CODE_FULL_TIME   = 'FT';
    const CODE_PART_TIME   = 'PT';
    const DESC_FULL_TIME   = 'full-time';
    const DESC_PART_TIME   = 'part-time';
    const CODE_SYSTEM      = '2.16.840.1.113883.5.1059';
    const CODE_SYSTEM_DESC = 'HL7:EmployeeJobClass';
    protected $coded_value;

    /**
     * JobClassCode constructor.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        switch (strtoupper($code)) {
            case self::CODE_FULL_TIME:
                $this->setCodedValue(new CodedValue(
                  self::CODE_FULL_TIME,
                  self::DESC_FULL_TIME,
                  self::CODE_SYSTEM,
                  self::CODE_SYSTEM_DESC
                ));
            break;
            case self::CODE_PART_TIME:
                $this->setCodedValue(new CodedValue(
                  self::CODE_PART_TIME,
                  self::DESC_PART_TIME,
                  self::CODE_SYSTEM,
                  self::CODE_SYSTEM_DESC
                ));
            break;
            default:
                throw new \InvalidArgumentException("The code {$code} is not valid!");
        }

    }

    /**
     * @return CodedValue
     */
    public function getCodedValue(): CodedValue
    {
        return $this->coded_value;
    }

    /**
     * @param CodedValue $coded_value
     *
     * @return JobClassCode
     */
    public function setCodedValue(CodedValue $coded_value): self
    {
        $this->coded_value = $coded_value;
        return $this;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc, ['coded_value']);
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'ext:jobClassCode';
    }
}