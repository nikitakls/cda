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

namespace PHPHealth\CDA\Interfaces;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */
interface XSITypeInterface
{
    // see this ref for examples and definitions of constants
    // https://www.hl7.org/documentcenter/public_temp_913B5997-1C23-BA17-0C52145C9F9C0422/wg/inm/datatypes-its-xml20050714.htm#dtimpl-PPD
    // note that not all codes are implemented - as per the specs

    const BOOLEAN                             = 'BL';
    const CHARACTER_STRING                    = 'ST';
    const CODED_SIMPLE_VALUE                  = 'CS';
    const CONCEPT_DESCRIPTOR                  = 'CD';
    const ENCAPSULATED_DATA                   = 'ED';
    const INTEGER                             = 'INT';
    const INTERVAL_PHYSICAL_QUANTITY          = 'IVL_PQ';
    const INTERVAL_TIMESTAMP                  = 'IVL_TS';
    const PARAMETRIC_PROBABILITY_DISTRIBUTION = 'PPD';
    const PERSON_NAME                         = 'PN';
    const PHYSICAL_QUANTITY                   = 'PQ';
    const RATIO                               = 'RTO';
    const TIMESTAMP                           = 'TS';
    const PERIODIC_TIME_INTERVAL              = 'PIVL_TS';
    const EVENT_RELATED_TIME_INTERVAL         = 'EIVL';

    const xsi_types = array(
      '',
      self::BOOLEAN,
      self::CHARACTER_STRING,
      self::CODED_SIMPLE_VALUE,
      self::CONCEPT_DESCRIPTOR,
      self::ENCAPSULATED_DATA,
      self::INTEGER,
      self::INTERVAL_TIMESTAMP,
      self::INTERVAL_PHYSICAL_QUANTITY,
      self::PARAMETRIC_PROBABILITY_DISTRIBUTION,
      self::PERSON_NAME,
      self::PHYSICAL_QUANTITY,
      self::TIMESTAMP,
      self::PERIODIC_TIME_INTERVAL,
      self::EVENT_RELATED_TIME_INTERVAL,
      self::RATIO,
    );

    public function getXSIType(): string;

}