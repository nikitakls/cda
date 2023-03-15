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
 * Interface ContextControlCodeInterface
 *
 * @package PHPHealth\CDA
 * @link    https://www.hl7.org/documentcenter/public_temp_9577B56D-1C23-BA17-0CCEC6F5EEE9E169/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/ContextControl.html
 */
interface ContextControlCodeInterface
{

    const CONTEXT_CONTROL_ADDITIVE        = '_ContextControlAdditive';
    const ADDITIVE_NON_PROPAGATING        = 'AN';
    const ADDITIVE_PROPAGATING            = 'AP';
    const CONTEXT_CONTROL_NON_PROPAGATING = '_ContextControlNonPropagating';
    const OVERRIDING_NON_PROPAGATING      = 'ON';
    const CONTEXT_CONTROL_OVERRIDING      = '_ContextControlOverriding';
    const OVERRIDING_PROPAGATING          = 'OP';

    const ContextControl = array(
      self::ADDITIVE_NON_PROPAGATING,
      self::ADDITIVE_PROPAGATING,
      self::OVERRIDING_NON_PROPAGATING,
      self::OVERRIDING_PROPAGATING
    );

    // the only value used in CDAs
    const CDA = array('', self::OVERRIDING_PROPAGATING);

    /**
     * @return string
     */
    public function getContextControlCode(): string;

    /**
     * @param string $context_control_code
     *
     * @return mixed
     */
    public function setContextControlCode(string $context_control_code);
}