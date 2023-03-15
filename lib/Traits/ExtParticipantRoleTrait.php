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


namespace PHPHealth\CDA\Traits;


use PHPHealth\CDA\RIM\Extensions\ExtParticipantRole;

/**
 * Trait ExtParticipantRoleTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait ExtParticipantRoleTrait
{
    /** @var ExtParticipantRole */
    private $ext_participant_role;

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return self
     */
    public function renderExtParticipantRole(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasExtParticipantRole()) {
            $el->appendChild($this->getExtParticipantRole()->toDOMElement($doc));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasExtParticipantRole(): bool
    {
        return null !== $this->ext_participant_role;
    }

    /**
     * @return ExtParticipantRole
     */
    public function getExtParticipantRole(): ExtParticipantRole
    {
        return $this->ext_participant_role;
    }

    /**
     * @param ExtParticipantRole $ext_participant_role
     *
     * @return self
     */
    public function setExtParticipantRole(ExtParticipantRole $ext_participant_role): self
    {
        $this->ext_participant_role = $ext_participant_role;
        return $this;
    }

}