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

namespace PHPHealth\CDA\RIM\Role;

use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\RIM\Entity\ManufacturedLabeledDrug;
use PHPHealth\CDA\RIM\Entity\ManufacturedMaterial;
use PHPHealth\CDA\RIM\Entity\Organization;

/**
 * Class ManufacturedProduct
 *
 * @package PHPHealth\CDA\RIM\Role
 */
class ManufacturedProduct extends Role
{

    /** @var ManufacturedLabeledDrug */
    protected $manufacturedLabeledDrug;
    /** @var ManufacturedMaterial */
    protected $manufacturedMaterial;

    /** @var Organization */
    protected $manufacturerOrganization;
    protected $manufacturedDrugOrOther;

    /**
     * ManufacturedProduct constructor.
     *
     * @param null $drug
     */
    public function __construct($drug = null)
    {
        $this->setAcceptableClassCodes(ClassCodeInterface::RoleClassManufacturedProduct)
          ->setClassCode(ClassCodeInterface::MANUFACTURED_PRODUCT);
        if ($drug instanceof ManufacturedLabeledDrug) {
            $this->setManufacturedLabeledDrug($drug);
        } elseif ($drug instanceof ManufacturedMaterial) {
            $this->setManufacturedMaterial($drug);
        }
    }


    /**
     * @return bool
     */
    public function hasManufacturedDrugOrOther(): bool
    {
        return null !== $this->manufacturedDrugOrOther;
    }

    /**
     * @param \DOMDocument $doc
     *
     * @return \DOMElement
     */
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->renderIds($el, $doc);
        if ($this->hasManufacturedLabeledDrug()) {
            $el->appendChild($this->getManufacturedLabeledDrug()->toDOMElement($doc));
        } elseif ($this->hasManufacturedMaterial()) {
            $el->appendChild($this->getManufacturedMaterial()->toDOMElement($doc));
        }
        if ($this->hasManufacturerOrganization()) {
            $el->appendChild($this->getManufacturerOrganization()->toDOMElement($doc));
        }
        return $el;
    }

    /**
     * @return bool
     */
    public function hasManufacturedLabeledDrug(): bool
    {
        return null !== $this->manufacturedLabeledDrug;
    }

    /**
     * @return ManufacturedLabeledDrug
     */
    public function getManufacturedLabeledDrug(): ManufacturedLabeledDrug
    {
        return $this->manufacturedLabeledDrug;
    }

    /**
     * @param ManufacturedLabeledDrug $manufacturedLabeledDrug
     *
     * @return ManufacturedProduct
     */
    public function setManufacturedLabeledDrug(ManufacturedLabeledDrug $manufacturedLabeledDrug): self
    {
        $this->manufacturedLabeledDrug = $manufacturedLabeledDrug;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasManufacturedMaterial(): bool
    {
        return null !== $this->manufacturedMaterial;
    }

    /**
     * @return ManufacturedMaterial
     */
    public function getManufacturedMaterial(): ManufacturedMaterial
    {
        return $this->manufacturedMaterial;
    }

    /**
     * @param ManufacturedMaterial $manufacturedMaterial
     *
     * @return ManufacturedProduct
     */
    public function setManufacturedMaterial(ManufacturedMaterial $manufacturedMaterial): self
    {
        $this->manufacturedMaterial = $manufacturedMaterial;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasManufacturerOrganization(): bool
    {
        return null !== $this->manufacturerOrganization;
    }

    /**
     * @return Organization
     */
    public function getManufacturerOrganization(): Organization
    {
        return $this->manufacturerOrganization;
    }

    /**
     * @param Organization $manufacturerOrganization
     */
    public function setManufacturerOrganization(Organization $manufacturerOrganization)
    {
        $this->manufacturerOrganization = $manufacturerOrganization;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'manufacturedProduct';
    }
}
