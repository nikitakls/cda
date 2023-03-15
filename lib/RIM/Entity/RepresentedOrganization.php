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

namespace PHPHealth\CDA\RIM\Entity;

/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\StandardIndustryClassCode;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\Interfaces\DeterminerCodeInterface;
use PHPHealth\CDA\RIM\Extensions\AsEntityIdentifier;
use PHPHealth\CDA\RIM\Role\AsOrganizationPartOf;
use PHPHealth\CDA\Traits\AddrsTrait;
use PHPHealth\CDA\Traits\AsEntityIdentifierTrait;
use PHPHealth\CDA\Traits\ClassCodeTrait;
use PHPHealth\CDA\Traits\DeterminerCodeTrait;
use PHPHealth\CDA\Traits\IdsTrait;
use PHPHealth\CDA\Traits\NamesTrait;
use PHPHealth\CDA\Traits\TelecomsTrait;


/**
 * Class RepresentedOrganization
 *
 * @package PHPHealth\CDA\RIM\Entity
 */
class RepresentedOrganization extends AbstractElement implements ClassCodeInterface, DeterminerCodeInterface
{
    use IdsTrait;
    use NamesTrait;
    use TelecomsTrait;
    use AddrsTrait;
    use ClassCodeTrait;
    use AsEntityIdentifierTrait;


    use DeterminerCodeTrait;


    /** @var StandardIndustryClassCode */
    protected $standardIndustryClassCode;
    /** @var AsOrganizationPartOf */
    protected $asOrganizationPartOf;

    /**
     * RepresentedOrganization constructor.
     *
     * @param EntityName         $name
     * @param AsEntityIdentifier $as_entity_identifier
     */
    public function __construct($name = null, $as_entity_identifier = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::EntityClassOrganization)
          ->setClassCode(ClassCodeInterface::IDENTITY)
          ->setDeterminerCode('');
        if ($name && $name instanceof EntityName) {
            $this->addName($name);
        }
        if ($as_entity_identifier && $as_entity_identifier instanceof AsEntityIdentifier) {
            $this->setAsEntityIdentifier($as_entity_identifier);
        }
    }

    /**
     * @param EntityName $name
     *
     * @return self
     */
    public function addName(EntityName $name): self
    {
        $this->names[] = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getElementTag(): string
    {
        return 'representedOrganization';
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if ($this->hasIds()) {
            foreach ($this->getIds() as $id) {
                $el->appendChild($id->toDOMElement($doc));
            }
        }
        $this->renderIds($el, $doc);
        $this->renderNames($el, $doc);
        $this->renderTelecoms($el, $doc);
        $this->renderAddrs($el, $doc);


        if ($this->hasStandardIndustryClassCode()) {
            $el->appendChild($this->getStandardIndustryClassCode()->toDOMElement($doc));
        }
        $this->renderAsOrganizationPartOf($el, $doc);
        $this->renderAsEntityIdentifier($el, $doc);

        return $el;
    }


    /**
     * @return bool
     */
    public function hasStandardIndustryClassCode(): bool
    {
        return null !== $this->standardIndustryClassCode;
    }

    /**
     * @return StandardIndustryClassCode
     */
    public function getStandardIndustryClassCode(): StandardIndustryClassCode
    {
        return $this->standardIndustryClassCode;
    }

    /**
     * @param StandardIndustryClassCode $standardIndustryClassCode
     *
     * @return self
     */
    public function setStandardIndustryClassCode(StandardIndustryClassCode $standardIndustryClassCode): self
    {
        $this->standardIndustryClassCode = $standardIndustryClassCode;
        return $this;
    }

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     */
    public function renderAsOrganizationPartOf(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->hasAsOrganizationPartOf()) {
            $el->appendChild($this->getAsOrganizationPartOf()->toDOMElement($doc));
        }
    }

    /**
     * @return bool
     */
    public function hasAsOrganizationPartOf(): bool
    {
        return null !== $this->asOrganizationPartOf;
    }

    /**
     * @return AsOrganizationPartOf
     */
    public function getAsOrganizationPartOf(): AsOrganizationPartOf
    {
        return $this->asOrganizationPartOf;
    }

    /**
     * @param AsOrganizationPartOf $asOrganizationPartOf
     *
     * @return self
     */
    public function setAsOrganizationPartOf(AsOrganizationPartOf $asOrganizationPartOf): self
    {
        $this->asOrganizationPartOf = $asOrganizationPartOf;
        return $this;
    }


}