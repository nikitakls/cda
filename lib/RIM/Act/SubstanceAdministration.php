<?php
/**
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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

namespace PHPHealth\CDA\RIM\Act;

use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\RIM\Participation\Consumable;
use PHPHealth\CDA\Traits\ApproachSiteCodesTrait;
use PHPHealth\CDA\Traits\ConsumableTrait;
use PHPHealth\CDA\Traits\DoseQuantityTrait;
use PHPHealth\CDA\Traits\EffectiveTimesTrait;
use PHPHealth\CDA\Traits\RateQuantityTrait;
use PHPHealth\CDA\Traits\RouteCodeTrait;

/**
 * Class SubstanceAdministration
 *
 * @package PHPHealth\CDA\RIM\Act
 */
class SubstanceAdministration extends Act
{

    use EffectiveTimesTrait;
    use RouteCodeTrait;
    use ApproachSiteCodesTrait;
    use DoseQuantityTrait;
    use RateQuantityTrait;
    use ConsumableTrait;

    /**
     * SubstanceAdministration constructor.
     *
     * @link https://www.hl7.org/documentcenter/public_temp_F5125FF9-1C23-BA17-0C1A72EC817E8760/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/ActClass.html
     *
     * @param null $consumable
     */
    public function __construct($consumable = null)
    {
        parent::__construct();
        if ($consumable instanceof Consumable) {
            $this->setConsumable($consumable);
        }
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setClassCode(ClassCodeInterface::SUBSTANCE_ADMINISTRATION)
          ->setMoodCode(MoodCodeInterface::EVENT);
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc)
          ->renderText($el, $doc)
          ->renderStatusCode($el, $doc)
          ->renderEffectiveTimes($el, $doc)
          ->renderRouteCode($el, $doc)
          ->renderDoseQuantity($el, $doc)
          ->renderConsumable($el, $doc)
          ->renderEntryRelationships($el, $doc)
          ->renderPreconditions($el, $doc);
        return $el;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'substanceAdministration';
    }

}
