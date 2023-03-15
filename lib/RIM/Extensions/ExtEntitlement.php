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

namespace PHPHealth\CDA\RIM\Extensions;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */


use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\ExtCodeTrait;
use PHPHealth\CDA\Traits\ExtEffectiveTimeTrait;
use PHPHealth\CDA\Traits\ExtIdTrait;
use PHPHealth\CDA\Traits\ExtParticipantTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;

/**
 * Class ExtEntitlement
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class ExtEntitlement extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use ClassCodeTrait;
    use MoodCodeTrait;
    use ExtIdTrait;
    use ExtCodeTrait;
    use ExtEffectiveTimeTrait;
    use ExtParticipantTrait;

    /**
     * ExtEntitlement constructor.
     *
     * @param null $ext_id
     * @param null $ext_code
     * @param null $ext_effective_time
     * @param null $ext_participant
     */
    public function __construct(
      $ext_id = null,
      $ext_code = null,
      $ext_effective_time = null,
      $ext_participant = null
    ) {
        $this->setAcceptableClassCodes(['', ClassCodeInterface::COVERAGE])
          ->setAcceptableMoodCodes(['', MoodCodeInterface::EVENT])
          ->setClassCode(ClassCodeInterface::COVERAGE)
          ->setMoodCode(MoodCodeInterface::EVENT);
        if ($ext_id && $ext_id instanceof ExtId) {
            $this->setExtId($ext_id);
        }
        if ($ext_code && $ext_code instanceof ExtCode) {
            $this->setExtCode($ext_code);
        }
        if ($ext_effective_time && $ext_effective_time instanceof ExtEffectiveTime) {
            $this->setExtEffectiveTime($ext_effective_time);
        }
        if ($ext_participant && $ext_participant instanceof ExtParticipant) {
            $this->setExtParticipant($ext_participant);
        }
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderExtId($el, $doc)
          ->renderExtCode($el, $doc)
          ->renderExtEffectiveTime($el, $doc)
          ->renderExtParticipant($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'ext:entitlement';
    }

}