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

namespace PHPHealth\CDA\RIM\Entity;

use PHPHealth\CDA\Traits\AdministrativeGenderCodeTrait;
use PHPHealth\CDA\Traits\AsEntityIdentifierTrait;
use PHPHealth\CDA\Traits\BirthPlaceTrait;
use PHPHealth\CDA\Traits\BirthTimeTrait;
use PHPHealth\CDA\Traits\EthnicGroupTrait;
use PHPHealth\CDA\Traits\MultipleBirthsTrait;

/**
 * Class LivingSubject
 *
 * @package PHPHealth\CDA\RIM\Entity
 */
abstract class LivingSubject extends Entity
{
    use AdministrativeGenderCodeTrait;
    use BirthTimeTrait;
    use EthnicGroupTrait;
    use MultipleBirthsTrait;
    use BirthPlaceTrait;
    use AsEntityIdentifierTrait;

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if ($this->hasNames()) {
            $this->getNames()->setValueToElement($el, $doc);
        }
        $this->renderAdministrativeGenderCode($el, $doc)
          ->renderBirthTime($el, $doc)
          ->renderEthnicGroup($el, $doc)
          ->renderMultipleBirths($el, $doc)
          ->renderBirthPlace($el, $doc)
          ->renderAsEntityIdentifier($el, $doc);
        return $el;
    }

}
