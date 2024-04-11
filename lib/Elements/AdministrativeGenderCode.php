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

use PHPHealth\CDA\DataType\Code\CodedValue;

/**
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class AdministrativeGenderCode extends Code
{
    const sex_male                   = 'male';
    const sex_female                 = 'female';
    const sex_intersex_indeterminate = 'I';
    const sex_not_stated_described   = 'N';

    /**
     * AdministrativeGenderCode constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        if ($value instanceof CodedValue) {
            parent::__construct($value);
            return;
        }

        parent::__construct(self::getCodedValueFromString($value));
    }

    /**
     * @param string $code
     *
     * @return CodedValue
     */
    public static function getCodedValueFromString(string $code): CodedValue
    {
        $uppercase_code = strtolower($code);
        $codes          = array(
          self::sex_male                   => 'Мужской',
          self::sex_female                 => 'Женский',
          self::sex_intersex_indeterminate => 'Intersex or Indeterminate',
          self::sex_not_stated_described   => 'Не указано',
        );
        $numCodes = [
            self::sex_male                   => 1,
            self::sex_female                 => 2,
            self::sex_not_stated_described   => 3,
        ];
        if (array_key_exists($uppercase_code, $codes) === false) {
            throw new \InvalidArgumentException("The sex value $code is not valid!");
        }
        return (new CodedValue(
          $numCodes[$uppercase_code],
          $codes[$uppercase_code],
          '1.2.643.5.1.13.13.11.1040',
          'Классификатор половой принадлежности'))->setCodeSystemVersion('2.1');
    }

    /**
     * @return string
     */
    public function getElementTag(): string
    {
        return 'administrativeGenderCode';
    }
}
