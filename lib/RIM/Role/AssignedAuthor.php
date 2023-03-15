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
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */

use PHPHealth\CDA\Elements\Address\Addr;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\Interfaces\ClassCodeInterface;
use PHPHealth\CDA\RIM\Entity\AssignedPerson;
use PHPHealth\CDA\Traits\AddrsTrait;
use PHPHealth\CDA\Traits\AsEntityIdentifierTrait;
use PHPHealth\CDA\Traits\AssignedPersonTrait;
use PHPHealth\CDA\Traits\AuthoringDeviceTrait;
use PHPHealth\CDA\Traits\OccupationTrait;
use PHPHealth\CDA\Traits\RepresentedOrganizationTrait;
use PHPHealth\CDA\Traits\TelecomsTrait;

/**
 * Class AssignedAuthor
 *
 * @package PHPHealth\CDA\RIM\Role
 */
class AssignedAuthor extends Role
{
    use AddrsTrait;
    use TelecomsTrait;
    use AssignedPersonTrait;
    use RepresentedOrganizationTrait;
    use AsEntityIdentifierTrait;
    use OccupationTrait;
    use AuthoringDeviceTrait;

    /**
     *
     * @param Id        $id
     * @param Code      $occupation
     * @param Addr|null $addr
     * @param array     $telecoms
     * @param null      $assigned_person
     */
    public function __construct(
      $id = null,
      $occupation = null,
      $addr = null,
      array $telecoms = [],
      $assigned_person = null
    ) {
        if ($id instanceof Id) {
            $this->addId($id);
        }

        if ($occupation instanceof Code) {
            $this->setOccupation($occupation);
        }

        if ($addr instanceof Addr) {
            $this->addAddr($addr);
        }

        if ($telecoms) {
            $this->setTelecoms($telecoms);
        }
        if ($assigned_person instanceof AssignedPerson) {
            $this->setAssignedPerson($assigned_person);
        }
        $this->setAcceptableClassCodes(ClassCodeInterface::RoleClassAssociative)
          ->setClassCode(ClassCodeInterface::ASSIGNED);
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
        $this->renderOccupation($el, $doc);
        $this->renderAddrs($el, $doc);
        $this->renderTelecoms($el, $doc);
        if ($this->hasAssignedPerson()) {
            $this->renderAssignedPerson($el, $doc);
        } elseif ($this->hasAssignedAuthoringDevice()) {
            $this->renderAssignedAuthoringDevice($el, $doc);
        }
        if ($this->hasRepresentedOrganization()) {
            $this->renderRepresentedOrganization($el, $doc);
        }
        return $el;
    }

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'assignedAuthor';
    }
}
