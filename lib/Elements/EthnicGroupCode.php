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
 * see http://meteor.aihw.gov.au/content/index.phtml/itemId/291036 for details.
 *
 */


namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Code\CodedValue;

/**
 * Class EthnicGroupCode
 *
 * @package PHPHealth\CDA\Elements
 */
class EthnicGroupCode extends Code
{
    const status_aboriginal                       = 1;
    const status_torres_strait                    = 2;
    const status_both_aboriginal_torres_strait    = 3;
    const status_neither_aboriginal_torres_strait = 4;
    const status_unknown                          = 9;

    /**
     * EthnicGroupCode constructor.
     * either use a coded value in the constuctor, or the METeOR Indigenous Status int.
     *
     * @param int|CodedValue $value
     */
    public function __construct(int $value)
    {
        if ($value instanceof CodedValue) {
            parent::__construct($value);
            return;
        }
        $values = array(
          self::status_aboriginal                       => 'Aboriginal but not Torres Strait Islander origin',
          self::status_torres_strait                    => 'Torres Strait Islander but not Aboriginal origin',
          self::status_both_aboriginal_torres_strait    => 'Both Aboriginal and Torres Strait Islander origin',
          self::status_neither_aboriginal_torres_strait => 'Neither Aboriginal nor Torres Strait Islander origin',
          self::status_unknown                          => 'Not stated/inadequately described'
        );
        if (array_key_exists((int)$value, $values) === false) {
            throw new \InvalidArgumentException("The ethnic group code {$value} is not allowed!");
        }
        $coded_value = new CodedValue ($value,
          $values[$value],
          '2.16.840.1.113883.3.879.291036',
          'METeOR Indigenous Status');
        parent::__construct($coded_value);
    }

    /**
     * @return string
     */
    public function getElementTag(): string
    {
        return 'ethnicGroupCode';
    }
}