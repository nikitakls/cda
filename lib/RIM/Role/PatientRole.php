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

namespace PHPHealth\CDA\RIM\Role;

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


use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Helper\ItemsEntities;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\ProviderOrganisationTrait;
use PHPHealth\CDA\RIM\Entity\Patient;
use PHPHealth\CDA\Traits\AddrsTrait;
use PHPHealth\CDA\Traits\CustomTrait;
use PHPHealth\CDA\Traits\PatientTrait;
use PHPHealth\CDA\Traits\TelecomsTrait;

class PatientRole extends Role
{
    use PatientTrait;
    use AddrsTrait;
    use TelecomsTrait;
    use ProviderOrganisationTrait;
    use CustomTrait;

    /**
     * PatientRole constructor.
     *
     * @param Id      $id
     * @param Patient $patient
     */
    public function __construct(
      Id $id,
      Patient $patient
    ) {
        $this
          ->setAcceptableClassCodes(ClassCodeInterface::RoleClassRoot)
          ->setPatient($patient)
          ->addId($id);
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
        if($this->hasItems(ItemsEntities::IDENTITY_DOC)){
            foreach ($this->getItems(ItemsEntities::IDENTITY_DOC) as $item) {
                $el->appendChild($item->toDOMElement($doc));
            }
        }
        if($this->hasItems(ItemsEntities::INSURACE_POLICY)){
            foreach ($this->getItems(ItemsEntities::INSURACE_POLICY) as $item) {
                $el->appendChild($item->toDOMElement($doc));
            }
        }

        if ($this->hasAddrs()) {
            foreach ($this->getAddrs() as $addr) {
                $el->appendChild($addr->toDOMElement($doc));
            }
        }
        if ($this->hasTelecoms()) {
            foreach ($this->getTelecoms() as $telecom) {
                $el->appendChild($telecom->toDOMElement($doc));
            }
        }
        $el->appendChild($this->getPatient()->toDOMElement($doc));

        if($this->hasProviderOrganisation()){
            $el->appendChild($this->getProviderOrgranisation()->toDOMElement($doc));
        }

        return $el;
    }



    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'patientRole';
    }
}
