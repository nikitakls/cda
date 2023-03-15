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

namespace PHPHealth\CDA\Component\SingleComponent;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Entry;
use PHPHealth\CDA\Elements\Html\Text;
use PHPHealth\CDA\Elements\Html\Title;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\MoodCodeInterface;
use PHPHealth\CDA\Traits\AuthorTrait;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\CodeTrait;
use PHPHealth\CDA\Traits\ConfidentialityCodeTrait;
use PHPHealth\CDA\Traits\EntriesTrait;
use PHPHealth\CDA\Traits\ExtCoverage2Trait;
use PHPHealth\CDA\Traits\IdTrait;
use PHPHealth\CDA\Traits\InformantsTrait;
use PHPHealth\CDA\Traits\LanguageCodeTrait;
use PHPHealth\CDA\Traits\MoodCodeTrait;
use PHPHealth\CDA\Traits\SingleComponentTrait;
use PHPHealth\CDA\Traits\SubjectTrait;
use PHPHealth\CDA\Traits\TextTrait;
use PHPHealth\CDA\Traits\TitleTrait;

/**
 * Class Section
 *
 * @package PHPHealth\CDA\Component\SingleComponent
 */
class Section extends AbstractElement implements ClassCodeInterface, MoodCodeInterface
{
    use AuthorTrait;
    use CodeTrait;
    use ConfidentialityCodeTrait;
    use EntriesTrait;
    use IdTrait;
    use LanguageCodeTrait;
    use SingleComponentTrait;
    use SubjectTrait;
    use TextTrait;
    use TitleTrait;
    use InformantsTrait;
    use ExtCoverage2Trait;
    use ClassCodeTrait;
    use MoodCodeTrait;

    /** @noinspection ArrayTypeOfParameterByDefaultValueInspection */

    /**
     * Section constructor.
     *
     * @param Id    $id
     * @param Code  $code
     * @param Title $title
     * @param Text  $text
     * @param       $entry
     */
    public function __construct($id = null, $code = null, $title = null, $text = null, $entry = [])
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::ActClass)
          ->setAcceptableMoodCodes(MoodCodeInterface::ActMood)
          ->setClassCode(ClassCodeInterface::DOCUMENT_SECTION)
          ->setMoodCode(MoodCodeInterface::EVENT);

        $this->entries = [];

        if ($id && $id instanceof Id) {
            $this->setId($id);
        }
        if ($code && $code instanceof Code) {
            $this->setCode($code);
        }

        if ($title && $title instanceof Title) {
            $this->setTitle($title);
        }

        if ($text && $text instanceof Text) {
            $this->setText($text);
        }
        if ($entry) {
            if (\is_array($entry)) {
                $this->setEntries($entry);
            } elseif ($entry instanceof Entry) {
                $this->addEntry($entry);
            }
        }
    }


    /**
     * @return self
     */
    public function clearEntries(): self
    {
        $this->entries = array();
        return $this;
    }

    /**
     * create an entry, which is already bound to the current section
     *
     * @return Entry
     */
    public function createEntry(): Entry
    {
        $entry = new Entry();
        $this->addEntry($entry);
        return $entry;
    }


    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderId($el, $doc)
          ->renderCode($el, $doc)
          ->renderTitle($el, $doc)
          ->renderText($el, $doc)
          ->renderConfidentialityCode($el, $doc)
          ->renderLanguageCode($el, $doc)
          ->renderSubject($el, $doc)
          ->renderAuthor($el, $doc)
          ->renderInformants($el, $doc)
          ->renderEntries($el, $doc)
          ->renderComponents($el, $doc)
          ->renderExtCoverage2($el, $doc);
        return $el;
    }


    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'section';
    }

}