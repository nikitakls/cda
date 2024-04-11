<?php
/**
 * The MIT License
 *
 * Copyright 2016 julien.
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

/**
 * @author julien
 */
class N3ConfidentialityCode extends ConfidentialityCode
{
    // 	<confidentialityCode code="R" displayName="Restricted" codeSystem="2.16.840.1.113883.5.25" codeSystemName="Confidentiality"/>

    const CODE_SYSTEM      = '1.2.643.5.1.13.13.99.2.285';
    const CODE_SYSTEM_NAME = 'Уровень конфиденциальности документа';

    const RESTRICTED          = 'Restricted';
    const RESTRICTED_KEY      = 'R';
    const NORMAL              = 'Normal';
    const NORMAL_KEY          = 'N';
    const VERY_RESTRICTED     = 'Very Restricted';
    const VERY_RESTRICTED_KEY = 'V';

    /**
     * @param $key
     * @param $displayName
     *
     * @return \PHPHealth\CDA\DataType\Code\CodedValue
     */
    public static function create($key, $displayName): CodedValue
    {
        switch ($key){
            case 1:
                $displayName = 'Обычный';
                $code = self::NORMAL_KEY;
                break;
            case 2:
                $displayName = 'Ограниченный';
                $code = self::RESTRICTED;
                break;
            case 3:
                $displayName = 'Крайне ограниченный';
                $code = self::VERY_RESTRICTED_KEY;
                break;
            default:
                $code = $key;
        }

        $cv = new CodedValue(
           $code,
          $displayName,
          self::CODE_SYSTEM,
          self::CODE_SYSTEM_NAME
        );
        $cv->setCodeSystemVersion('1.1');
        return $cv;
    }
}
