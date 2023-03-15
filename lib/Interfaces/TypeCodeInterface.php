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
interface TypeCodeInterface
{
    // constants here; https://www.hl7.org/documentcenter/public_temp_5E82A090-1C23-BA17-0C40FB19E225248C/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/ParticipationType.html
    // and here: https://www.hl7.org/fhir/v3/ActRelationshipType/cs.html
    const ACT_CLASS_TEMPORALLY_PERTAINS              = '_ActClassTemporallyPertains';
    const ACT_RELATIONSHIP_ACCOUNTING                = '_ActRelationshipAccounting';
    const ACT_RELATIONSHIP_CONDITIONAL               = '_ActRelationshipConditional';
    const ACT_RELATIONSHIP_COST_TRACKING             = '_ActRelationshipCostTracking';
    const ACT_RELATIONSHIP_OBJECTIVE                 = '_ActRelationsipObjective';
    const ACT_RELATIONSHIP_POSTING                   = '_ActRelationshipPosting';
    const ACT_RELATIONSHIP_TEMPORALLY_PERTAINS_END   = '_ActRelationshipTemporallyPertainsEnd';
    const ACT_RELATIONSHIP_TEMPORALLY_PERTAINS_START = '_ActRelationshipTemporallyPertainsStart';
    const ACT_RELATIONSHIP_TYPE                      = 'ART';
    const ACTIVE_IMMUNIZATION_AGAINST                = 'ACTIMM';
    const ADJUNCTIVE_TREATMENT                       = 'ADJUNCT';
    const ADMITTER                                   = 'ADM';
    const ANALYTE                                    = 'ALY';
    const ARRIVAL                                    = 'ARR';
    const ASSIGNS_NAME                               = 'NAME';
    const ATTENDER                                   = 'ATND';
    const AUTHENTICATOR                              = 'AUTHEN';
    const AUTHOR                                     = 'AUT';
    const AUTHOR_ORIGINATOR                          = 'AUT';
    const AUTHORIZED_BY                              = 'AUTH';
    const BABY                                       = 'BBY';
    const BENEFICIARY                                = 'BEN';
    const BENEFIT                                    = 'BEN';
    const BLOCKS                                     = 'BLOCK';
    const CALLBACK_CONTACT                           = 'CALLBCK';
    const CATALYST                                   = 'CAT';
    const CAUSATIVE_AGENT                            = 'CAGNT';
    const CAUSE                                      = 'CAUS';
    const COMPLIES_WITH                              = 'COMPLY';
    const COMPONENT                                  = 'COMP';
    const CONCURRENT_WITH                            = 'CONCURRENT';
    const CONSULTANT                                 = 'CON';
    const CONSUMABLE                                 = 'CSM';
    const COVERAGE_TARGET                            = 'COV';
    const COVERED_BY                                 = 'COVBY';
    const CUSTODIAN                                  = 'CST';
    const DATA_ENTRY_PERSON                          = 'ENT';
    const DEPARTURE                                  = 'DEP';
    const DESTINATION                                = 'DST';
    const DEVICE                                     = 'DEV';
    const DIAGNOSES                                  = 'DIAG';
    const DIRECT_TARGET                              = 'DIR';
    const DISCHARGER                                 = 'DIS';
    const DISTRIBUTOR                                = 'DIST';
    const DOCUMENTS                                  = 'DOC';
    const DONOR                                      = 'DON';
    const EMERGENCY                                  = 'emergency';
    const ENDS_AFTER_END_OF                          = 'EAE';
    const ENDS_AFTER_START_OF                        = 'EAS';
    const ENDS_BEFORE_END                            = 'EBE';
    const ENDS_BEFORE_START_OF                       = 'EBS';
    const ENDS_CONCURRENT_WITH                       = 'ECW';
    const ENDS_CONCURRENT_WITH_START                 = 'ECWS';
    const ENDS_DURING                                = 'EDU';
    const ENTRY_LOCATION                             = 'ELOC';
    const EPISODE_LINK                               = 'ELNK';
    const ESCORT                                     = 'ESC';
    const EVALUATES_                                 = '(GOAL)	  GEVL';
    const EXACERBATED_BY                             = 'EXACBY';
    const EXCERPT_VERBATIM                           = 'VRXCRPT';
    const EXCERPTS                                   = 'XCRPT';
    const EXPOSURE_AGENT                             = 'EXPAGNT';
    const EXPOSURE_PARTICIPATION                     = 'EXPART';
    const EXPOSURE_SOURCE                            = 'EXPSRC';
    const EXPOSURE_TARGET                            = 'EXPTRGT';
    const FULFILLS                                   = 'FLFS';
    const GOAL_EVALUATION                            = 'GEVL';
    const GUARANTOR_PARTY                            = 'GUAR';
    const HAS_BASELINE                               = 'BSLN';
    const HAS_BOUNDED_SUPPORT                        = 'SPRTBND';
    const HAS_CHARGE                                 = 'CHRG';
    const HAS_COMPONENT                              = 'COMP';
    const HAS_CONTINUING_OBJECTIVE                   = 'OBJC';
    const HAS_CONTRA_INDICATION                      = 'CIND';
    const HAS_CONTROL_VARIABLE                       = 'CTRLV';
    const HAS_COST                                   = 'COST';
    const HAS_CREDIT                                 = 'CREDIT';
    const HAS_DEBIT                                  = 'DEBIT';
    const HAS_EXPLANATION                            = 'EXPL';
    const HAS_FINAL_OBJECTIVE                        = 'OBJF';
    const HAS_GENERALIZATION                         = 'GEN';
    const HAS_GOAL                                   = 'GOAL';
    const HAS_METADATA                               = 'META';
    const HAS_OPTION                                 = 'OPTN';
    const HAS_OUTCOME                                = 'OUTC';
    const HAS_PERTINENT_INFORMATION                  = 'PERT';
    const HAS_PRE_CONDITION                          = 'PRCN';
    const HAS_PREVIOUS_INSTANCE                      = 'PREV';
    const HAS_REASON                                 = 'RSON';
    const HAS_REFERENCE_VALUES                       = 'REFV';
    const HAS_RISK                                   = 'RISK';
    const HAS_SUBJECT                                = 'SUBJ';
    const HAS_SUPPORT                                = 'SPRT';
    const HAS_TRIGGER                                = 'TRIG';
    const HAS_VALUE                                  = 'VALUE';
    const HOLDER                                     = 'HLD';
    const IMMUNIZATION_AGAINST                       = 'IMM';
    const INDIRECT_TARGET                            = 'IND';
    const INFORMANT                                  = 'INF';
    const INFORMATION_RECIPIENT                      = 'IRCP';
    const INSTANTIATES_                              = '(MASTER)	  INST';
    const IS_APPENDAGE                               = 'APND';
    const IS_DERIVED_FROM                            = 'DRIV';
    const IS_ETIOLOGY_FOR                            = 'CAUS';
    const IS_MANIFESTATION_OF                        = 'MFST';
    const IS_OCCURRENCE_OF                           = 'v:ActRelationshipOccurrence';
    const IS_SEQUEL                                  = 'SEQL';
    const ITEMS_LOCATED                              = 'ITEMSLOC';
    const LEGAL_AUTHENTICATOR                        = 'LA';
    const LIMITED_BY                                 = 'LIMIT';
    const LOCATION                                   = 'LOC';
    const MAINTENANCE_TREATMENT                      = 'MTREAT';
    const MANIFESTATION                              = 'MFST';
    const MATCHES_                                   = '(TRIGGER)	  MTCH';
    const MITIGATES                                  = 'MITGT';
    const MODIFIES                                   = 'MOD';
    const NON_REUSABLE_DEVICE                        = 'NRD';
    const OCCURRENCE                                 = 'OCCR';
    const OCCURS_DURING                              = 'DURING';
    const ORIGIN                                     = 'ORG';
    const OVERLAPS_WITH                              = 'OVERLAP';
    const PALLIATES                                  = 'PALLTREAT';
    const PARTICIPATION                              = 'PART';
    const PARTICIPATION_ANCILLARY                    = '_ParticipationAncillary';
    const PARTICIPATION_INFORMATION_GENERATOR        = '_ParticipationInformationGenerator';
    const PASSIVE_IMMUNIZATION_AGAINST               = 'PASSIMM';
    const PERFORMER                                  = 'PRF';
    const PREVIOUS_INSTANCE                          = 'v:ActRelationshipHasPreviousInstance';
    const PRIMARY_INFORMATION_RECIPIENT              = 'PRCP';
    const PRIMARY_PERFORMER                          = 'PPRF';
    const PRODUCT                                    = 'PRD';
    const PROPHYLAXIS_OF                             = 'PRYLX';
    const PROVIDES_EVIDENCE_FOR                      = 'EVID';
    const RE_CHALLENGE                               = 'RCHAL';
    const RECEIVER                                   = 'RCV';
    const RECORD_TARGET                              = 'RCT';
    const RECOVERS                                   = 'RCVY';
    const REFERENCES_ORDER                           = 'OREF';
    const REFERRED_BY                                = 'REFB';
    const REFERRED_TO                                = 'REFT';
    const REFERRER                                   = 'REF';
    const REFERS_TO                                  = 'REFR';
    const RELIEVED_BY                                = 'RELVBY';
    const REMOTE                                     = 'RML';
    const REPLACES                                   = 'RPLC';
    const RESPONSIBLE_PARTY                          = 'RESP';
    const REUSABLE_DEVICE                            = 'RDV';
    const REVERSES                                   = 'REV';
    const SCHEDULES                                  = 'v:ActRelationshipSchedulesRequest';
    const SCHEDULES_REQUEST                          = 'SCH';
    const SECONDARY_PERFORMER                        = 'SPRF';
    const SPECIMEN                                   = 'SPC';
    const STARTS_AFTER_END_OF                        = 'SAE';
    const STARTS_AFTER_START_OF                      = 'SAS';
    const STARTS_BEFORE_END                          = 'SBE';
    const STARTS_BEFORE_START_OF                     = 'SBS';
    const STARTS_CONCURRENT_WITH                     = 'SCW';
    const STARTS_CONCURRENT_WITH_END                 = 'SCWE';
    const STARTS_DURING                              = 'SDU';
    const SUBJECT                                    = 'SBJ';
    const SUCCEEDS                                   = 'SUCC';
    const SUMMARIZED_BY                              = 'SUMM';
    const SYMPTOMATIC_RELIEF                         = 'SYMP';
    const THERAPEUTIC_AGENT                          = 'TPA';
    const TRACKER                                    = 'TRC';
    const TRANSCRIBER                                = 'TRANS';
    const TRANSFORMATION                             = 'XFRM';
    const TRANSLATOR                                 = 'translator';
    const TREATS                                     = 'TREAT';
    const UPDATES_                                   = '(CONDITION)	  UPDT';
    const URGENT_NOTIFICATION_CONTACT                = 'NOT';
    const USES                                       = 'USE';
    const VERIFIER                                   = 'VRF';
    const VIA                                        = 'VIA';
    const WITNESS                                    = 'WIT';
    /**
     *
     * @return string
     */
    const ParticipationType = array(
      '',
      self::PARTICIPATION,
      self::ADMITTER,
      self::ATTENDER,
      self::CALLBACK_CONTACT,
      self::CONSULTANT,
      self::DISCHARGER,
      self::ESCORT,
      self::REFERRER,
      self::AUTHOR_ORIGINATOR,
      self::INFORMANT,
      self::TRANSCRIBER,
      self::DATA_ENTRY_PERSON,
      self::WITNESS,
      self::CUSTODIAN,
      self::DIRECT_TARGET,
      self::ANALYTE,
      self::BABY,
      self::CATALYST,
      self::CONSUMABLE,
      self::THERAPEUTIC_AGENT,
      self::DEVICE,
      self::NON_REUSABLE_DEVICE,
      self::REUSABLE_DEVICE,
      self::DONOR,
      self::EXPOSURE_AGENT,
      self::EXPOSURE_PARTICIPATION,
      self::EXPOSURE_TARGET,
      self::EXPOSURE_SOURCE,
      self::PRODUCT,
      self::SUBJECT,
      self::SPECIMEN,
      self::INDIRECT_TARGET,
      self::BENEFICIARY,
      self::BENEFIT,
      self::CAUSATIVE_AGENT,
      self::COVERAGE_TARGET,
      self::GUARANTOR_PARTY,
      self::HOLDER,
      self::RECORD_TARGET,
      self::RECEIVER,
      self::INFORMATION_RECIPIENT,
      self::URGENT_NOTIFICATION_CONTACT,
      self::PRIMARY_INFORMATION_RECIPIENT,
      self::REFERRED_BY,
      self::REFERRED_TO,
      self::TRACKER,
      self::LOCATION,
      self::DESTINATION,
      self::ENTRY_LOCATION,
      self::ORIGIN,
      self::REMOTE,
      self::VIA,
      self::PERFORMER,
      self::DISTRIBUTOR,
      self::PRIMARY_PERFORMER,
      self::SECONDARY_PERFORMER,
      self::RESPONSIBLE_PARTY,
      self::VERIFIER,
      self::AUTHENTICATOR,
      self::LEGAL_AUTHENTICATOR,
    );
    /**
     * @link http://cdatools.org/javadoc/org/openhealthtools/mdht/uml/hl7/vocab/ActRelationshipType.html
     * @link https://www.hl7.org/documentcenter/public_temp_C6FFC8C1-1C23-BA17-0C31210DCA97528F/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/ActRelationshipType.html
     * @var array
     */
    const ActRelationshipType = array(
      self::ACT_RELATIONSHIP_TYPE,
      self::HAS_COMPONENT,
      self::ARRIVAL,
      self::HAS_CONTROL_VARIABLE,
      self::DEPARTURE,
      self::HAS_OUTCOME,
      self::HAS_GOAL,
      self::HAS_RISK,
      self::ACT_RELATIONSHIP_OBJECTIVE,
      self::HAS_CONTINUING_OBJECTIVE,
      self::HAS_FINAL_OBJECTIVE,
      self::HAS_PERTINENT_INFORMATION,
      self::AUTHORIZED_BY,
      self::IS_ETIOLOGY_FOR,
      self::COVERED_BY,
      self::IS_DERIVED_FROM,
      self::EPISODE_LINK,
      self::PROVIDES_EVIDENCE_FOR,
      self::EXACERBATED_BY,
      self::HAS_EXPLANATION,
      self::ITEMS_LOCATED,
      self::LIMITED_BY,
      self::HAS_METADATA,
      self::IS_MANIFESTATION_OF,
      self::ASSIGNS_NAME,
      self::HAS_PREVIOUS_INSTANCE,
      self::PREVIOUS_INSTANCE,
      self::REFERS_TO,
      self::USES,
      self::HAS_REFERENCE_VALUES,
      self::RELIEVED_BY,
      self::HAS_SUPPORT,
      self::HAS_BOUNDED_SUPPORT,
      self::HAS_SUBJECT,
      self::SUMMARIZED_BY,
      self::ACT_CLASS_TEMPORALLY_PERTAINS,
      self::OCCURS_DURING,
      self::OVERLAPS_WITH,
      self::ACT_RELATIONSHIP_TEMPORALLY_PERTAINS_END,
      self::ENDS_AFTER_END_OF,
      self::ENDS_AFTER_START_OF,
      self::ENDS_DURING,
      self::ENDS_BEFORE_END,
      self::ENDS_BEFORE_START_OF,
      self::ENDS_CONCURRENT_WITH,
      self::CONCURRENT_WITH,
      self::ENDS_CONCURRENT_WITH_START,
      self::ACT_RELATIONSHIP_TEMPORALLY_PERTAINS_START,
      self::STARTS_AFTER_END_OF,
      self::STARTS_AFTER_START_OF,
      self::STARTS_DURING,
      self::STARTS_BEFORE_END,
      self::STARTS_BEFORE_START_OF,
      self::STARTS_CONCURRENT_WITH,
      self::CONCURRENT_WITH,
      self::STARTS_CONCURRENT_WITH_END,
      self::ACT_RELATIONSHIP_ACCOUNTING,
      self::ACT_RELATIONSHIP_COST_TRACKING,
      self::HAS_CHARGE,
      self::HAS_COST,
      self::ACT_RELATIONSHIP_POSTING,
      self::HAS_CREDIT,
      self::HAS_DEBIT,
      self::IS_SEQUEL,
      self::IS_APPENDAGE,
      self::HAS_BASELINE,
      self::COMPLIES_WITH,
      self::DOCUMENTS,
      self::FULFILLS,
      self::OCCURRENCE,
      self::IS_OCCURRENCE_OF,
      self::REFERENCES_ORDER,
      self::SCHEDULES_REQUEST,
      self::SCHEDULES,
      self::HAS_GENERALIZATION,
      self::EVALUATES_,
      self::INSTANTIATES_,
      self::MODIFIES,
      self::MATCHES_,
      self::HAS_OPTION,
      self::RE_CHALLENGE,
      self::REVERSES,
      self::REPLACES,
      self::SUCCEEDS,
      self::UPDATES_,
      self::EXCERPTS,
      self::EXCERPT_VERBATIM,
      self::TRANSFORMATION,
      self::HAS_VALUE,
      self::ACT_RELATIONSHIP_CONDITIONAL,
      self::HAS_CONTRA_INDICATION,
      self::HAS_PRE_CONDITION,
      self::HAS_REASON,
      self::BLOCKS,
      self::DIAGNOSES,
      self::IMMUNIZATION_AGAINST,
      self::ACTIVE_IMMUNIZATION_AGAINST,
      self::PASSIVE_IMMUNIZATION_AGAINST,
      self::MITIGATES,
      self::RECOVERS,
      self::PROPHYLAXIS_OF,
      self::TREATS,
      self::ADJUNCTIVE_TREATMENT,
      self::MAINTENANCE_TREATMENT,
      self::PALLIATES,
      self::SYMPTOMATIC_RELIEF,
      self::HAS_TRIGGER,
    );

    const x_EncounterParticipant = array(
      self::ADMITTER,
      self::ATTENDER,
      self::CONSULTANT,
      self::DISCHARGER,
      self::REFERRER
    );
    /**
     * @link https://www.hl7.org/documentcenter/public_temp_C6F00267-1C23-BA17-0C395F2F3F44E368/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/vs_ActRelationshipType.html#x_ActRelationshipEntryRelationship
     */
    const x_ActRelationshipEntryRelationship = array(
      self::CAUSE,
      self::COMPONENT,
      self::GOAL_EVALUATION,
      self::MANIFESTATION,
      self::REFERS_TO,
      self::HAS_REASON,
      self::STARTS_AFTER_START_OF,
      self::HAS_SUPPORT,
      self::HAS_SUBJECT,
      self::EXCERPTS
    );
    const SpecimenType                       = array(
      '',
      self::SPECIMEN
    );

    /**
     * @var array
     * @link http://cdatools.org/javadoc/org/openhealthtools/mdht/uml/hl7/vocab/ActRelationshipHasComponent.html
     */
    const ActRelationshipHasComponent    = array(
      '',
      self::ARRIVAL,
      self::COMPONENT,
      self::HAS_CONTROL_VARIABLE,
      self::DEPARTURE
    );
    const ParticipationPhysicalPerformer = array(
      '',
      self::PERFORMER
    );

    const x_ActRelationshipEntry = array(
      '',
      self::CAUSE,
      self::COMPONENT,
      self::GOAL_EVALUATION,
      self::REFERS_TO,
      self::HAS_REASON,
      self::STARTS_AFTER_START_OF,
      self::HAS_SUPPORT,
      self::HAS_SUBJECT,
      self::EXCERPTS
    );
    const x_InformationRecipient = array(
      '',
      self::PRIMARY_INFORMATION_RECIPIENT,
      self::TRACKER
    );

    public function getTypeCode(): string;
}
