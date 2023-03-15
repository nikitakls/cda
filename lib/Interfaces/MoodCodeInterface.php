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

namespace PHPHealth\CDA\Interfaces;

/**
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
interface MoodCodeInterface
{
    const ACT_REQUEST         = '_ActMoodActRequest';
    const APPOINTMENT         = 'APT';
    const APPOINTMENT_REQUEST = 'ARQ';
    const COMPLETION_TRACK    = '_ActMoodCompletionTrack';
    const CRITERION           = 'CRT';
    const DEFINITION          = 'DEF';
    const DESIRE              = '_ActMoodDesire';
    const EVENT               = 'EVN';
    const EVENT_CRITERION     = 'EVN.CRT';
    const EXPECTATION         = 'EXPEC';
    const GOAL                = 'GOL';
    const INTENT              = 'INT';
    const OPTION              = 'OPT';
    const PERMISSION          = 'PERM';
    const PERMISSION_REQUEST  = 'PERMRQ';
    const POTENTIAL           = '_ActMoodPotential';
    const PREDICATE           = '_ActMoodPredicate';
    const PROMISE             = 'PRMS';
    const PROPOSAL            = 'PRP';
    const RECOMMENDATION      = 'RMD';
    const REQUEST             = 'RQO';
    const RESOURCE_SLOT       = 'SLOT';
    const RISK                = 'RSK';

    /**
     * @link http://cdatools.org/javadoc/org/openhealthtools/mdht/uml/hl7/vocab/x_DocumentProcedureMood.html
     */
    const x_DocumentProcedureMood = array(
      '',
      self::APPOINTMENT,
      self::APPOINTMENT_REQUEST,
      self::DEFINITION,
      self::EVENT,
      self::INTENT,
      self::PROMISE,
      self::PROPOSAL,
      self::REQUEST,
    );

    /**
     * @link https://www.hl7.org/documentcenter/public_temp_C4F87DD3-1C23-BA17-0C229BA0B2EC24AF/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/vs_ActMood.html
     * @link https://www.hl7.org/documentcenter/public_temp_C4F87DD3-1C23-BA17-0C229BA0B2EC24AF/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/ActMood.html
     */
    const x_DocumentActMood = array(
      '',
      self::COMPLETION_TRACK,
      self::EVENT,
      self::INTENT,
      self::PROMISE,
      self::APPOINTMENT,
      self::DESIRE,
      self::PROPOSAL,
      self::RECOMMENDATION,
      self::ACT_REQUEST,
      self::APPOINTMENT_REQUEST,
      self::PERMISSION_REQUEST,
      self::REQUEST,
      self::POTENTIAL,
      self::DEFINITION,
      self::PERMISSION,
      self::RESOURCE_SLOT,
      self::PREDICATE,
      self::CRITERION,
      self::EVENT_CRITERION,
      self::EXPECTATION,
      self::GOAL,
      self::RISK,
      self::OPTION,
      self::PROPOSAL
    );

    /**
     * @link http://cdatools.org/javadoc/org/openhealthtools/mdht/uml/hl7/vocab/ActMood.html
     */
    const ActMood = array(
      '',
      self::APPOINTMENT,
      self::APPOINTMENT_REQUEST,
      self::DEFINITION,
      self::EVENT,
      self::EVENT_CRITERION,
      self::GOAL,
      self::INTENT,
      self::OPTION,
      self::PERMISSION,
      self::PERMISSION_REQUEST,
      self::PROMISE,
      self::PROPOSAL,
      self::REQUEST
    );

    const x_DocumentEncounterMood = array(
      '',
      self::APPOINTMENT,
      self::APPOINTMENT_REQUEST,
      self::EVENT,
      self::INTENT,
      self::PROMISE,
      self::PROPOSAL,
      self::REQUEST
    );
    /**
     * @link https://ehealthsuisse.ihe-europe.net/CDAGenerator/voc/XActMoodDocumentObservation.html
     */
    const x_ActMoodDocumentObservation = array(
      '',
      self::DEFINITION,
      self::EVENT,
      self::GOAL,
      self::INTENT,
      self::PROMISE,
      self::PROPOSAL,
      self::REQUEST
    );
    // https://www.hl7.org/documentcenter/public_temp_FB380663-1C23-BA17-0C710E7FD3D30E76/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/vs_ActMood.html
    const x_DocumentSubstanceMood = array(
      self::EVENT,
      self::INTENT,
      self::PROMISE,
      self::PROPOSAL,
      self::REQUEST
    );

    public function getMoodCode(): string;
}
