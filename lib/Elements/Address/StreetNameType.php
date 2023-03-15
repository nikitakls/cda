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

namespace PHPHealth\CDA\Elements\Address;

use PHPHealth\CDA\Elements\AbstractSimpleElement;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */
class StreetNameType extends AbstractSimpleElement
{
    const Alley     = 'Ally';
    const Arcade    = 'Arc';
    const Avenue    = 'Ave';
    const Boulevard = 'Bvd';
    const Bypass    = 'Bypa';
    const Circuit   = 'Cct';
    const Close     = 'Cl';
    const Corner    = 'Crn';
    const Court     = 'Ct';
    const Crescent  = 'Cres';
    const CulDeSac  = 'Cds';
    const Drive     = 'Dr';
    const Esplanade = 'Esp';
    const Green     = 'Grn';
    const Grove     = 'Gr';
    const Highway   = 'Hwy';
    const Junction  = 'Jnc';
    const Lane      = 'Lane';
    const Link      = 'Link';
    const Mews      = 'Mews';
    const Parade    = 'Pde';
    const Place     = 'Pl';
    const Ridge     = 'Rdge';
    const Road      = 'Rd';
    const Square    = 'Sq';
    const Street    = 'St';
    const Terrace   = 'Tce';


    public function __construct(string $value)
    {
        $acceptable_values = array(
          self::Alley,
          self::Arcade,
          self::Avenue,
          self::Boulevard,
          self::Bypass,
          self::Circuit,
          self::Close,
          self::Corner,
          self::Court,
          self::Crescent,
          self::CulDeSac,
          self::Drive,
          self::Esplanade,
          self::Green,
          self::Grove,
          self::Highway,
          self::Junction,
          self::Lane,
          self::Link,
          self::Mews,
          self::Parade,
          self::Place,
          self::Ridge,
          self::Road,
          self::Square,
          self::Street,
          self::Terrace,
        );
        if (\in_array($value, $acceptable_values, true) === false) {
            throw new \InvalidArgumentException("The street type value of $value is not acceptable!");
        }
        parent::__construct($value);
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'streetNameType';
    }
}
