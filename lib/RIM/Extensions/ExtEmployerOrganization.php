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

use PHPHealth\CDA\DataType\Name\EntityName;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\RIM\Role\AsOrganizationPartOf;

/**
 * Class ExtEmployerOrganization
 *
 * @package PHPHealth\CDA\RIM\Extensions
 */
class ExtEmployerOrganization extends AbstractElement
{
    /** @var EntityName */
    protected $name;

    /** @var AsOrganizationPartOf */
    protected $as_organization_part_of;

    /**
     * ExtEmployerOrganization constructor.
     *
     * @param EntityName           $name
     * @param AsOrganizationPartOf $as_organization_part_of
     */
    public function __construct(EntityName $name, AsOrganizationPartOf $as_organization_part_of)
    {
        $this->setName($name)
          ->setAsOrganizationPartOf($as_organization_part_of);
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->getName()->setValueToElement($el, $doc);
        $el->appendChild($this->getAsOrganizationPartOf()->toDOMElement($doc));
        return $el;
    }

    /**
     * @return EntityName
     */
    public function getName(): EntityName
    {
        return $this->name;
    }

    /**
     * @param EntityName $name
     *
     * @return ExtEmployerOrganization
     */
    public function setName(EntityName $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return AsOrganizationPartOf
     */
    public function getAsOrganizationPartOf(): AsOrganizationPartOf
    {
        return $this->as_organization_part_of;
    }

    /**
     * @param AsOrganizationPartOf $as_organisation_part_of
     *
     * @return ExtEmployerOrganization
     */
    public function setAsOrganizationPartOf(AsOrganizationPartOf $as_organisation_part_of): self
    {
        $this->as_organization_part_of = $as_organisation_part_of;
        return $this;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'ext:employerOrganization';
    }
}