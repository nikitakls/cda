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
 * Interface ClassCodeInterface
 *
 * @package PHPHealth\CDA
 */
interface ClassCodeInterface
{


    const ACCESS                                                     = 'ACCESS';
    const ACCESSION                                                  = 'ACSN';
    const ACCOMMODATION                                              = 'ACCM';
    const ACCOUNT                                                    = 'ACCT';
    const ACQUISITION_EXPOSURE                                       = 'AEXPOS';
    const ACT                                                        = 'ACT';
    const ACT_CLASS_ROI                                              = '_ActClassROI';
    const ACTION                                                     = 'ACTN';
    const ACTIVE_INGREDIENT                                          = 'ACTI';
    const ACTIVE_INGREDIENT_BASIS_OF_STRENGTH                        = 'ACTIB';
    const ACTIVE_INGREDIENT_MOIETY_IS_BASIS_OF_STRENGTH              = 'ACTIM';
    const ACTIVE_INGREDIENT_REFERENCE_SUBSTANCE_IS_BASIS_OF_STRENGTH = 'ACTIR';
    const ACTIVE_MOIETY                                              = 'ACTM';
    const ADDITIVE                                                   = 'ADTV';
    const ADJACENCY                                                  = 'ADJY';
    const ADJUVANT                                                   = 'ADJV';
    const ADMINISTERABLE_MATERIAL                                    = 'ADMM';
    const AFFILIATE                                                  = 'AFFL';
    const AGENT                                                      = 'AGNT';
    const ALIQUOT                                                    = 'ALQT';
    const ANIMAL                                                     = 'ANM';
    const ANM                                                        = 'ANM';
    const ASSIGNED                                                   = 'ASSIGNED';
    const ASSIGNED_ENTITY                                            = 'ASSIGNED';
    const BASE                                                       = 'BASE';
    const BATTERY                                                    = 'BATTERY';
    const BIO_SEQUENCE                                               = 'SEQ';
    const BIO_SEQUENCE_VARIATION                                     = 'SEQVAR';
    const BIRTHPLACE                                                 = 'BIRTHPL';
    const BOUNDED_ROI                                                = 'ROIBND';
    const CARE_PROVISION                                             = 'PCPR';
    const CAREGIVER                                                  = 'CAREGIVER';
    const CASE_SUBJECT                                               = 'CASEBJ';
    const CATEGORY                                                   = 'CATEGORY';
    const CDA_LEVEL_ONE_CLINICAL_DOCUMENT                            = 'CDALVLONE';
    const CERTIFICATE_REPRESENTATION                                 = 'CER';
    const CHEMICAL_SUBSTANCE                                         = 'CHEM';
    const CHILD                                                      = 'CHILD';
    const CITIZEN                                                    = 'CIT';
    const CITY                                                       = 'CITY';
    const CLAIMANT                                                   = 'CLAIM';
    const CLASS_DEVICE                                               = 'DEV';
    const CLASS_HAS_GENERALIZATION                                   = 'GEN';
    const CLASS_HOLDER                                               = 'HOLD';
    const CLASS_SPECIMEN                                             = 'SPEC';
    const CLASS_THERAPEUTIC_AGENT                                    = 'THER';
    const CLINICAL_DOCUMENT                                          = 'DOCCLIN';
    const CLINICAL_RESEARCH_INVESTIGATOR                             = 'CRINV';
    const CLINICAL_RESEARCH_SPONSOR                                  = 'CRSPNSR';
    const CLINICAL_TRIAL                                             = 'CLNTRL';
    const CLINICAL_TRIAL_TIME_POINT_EVENT                            = 'CTTEVENT';
    const CLINICAL_TRIAL_TIMEPOINT_EVENT                             = 'CTTEVENT';
    const CLUSTER                                                    = 'CLUSTER';
    const COLOR_ADDITIVE                                             = 'COLR';
    const COMMISSIONING_PARTY                                        = 'COMPAR';
    const COMPOSITION                                                = 'COMPOSITION';
    const COMPOSITION_ATTESTABLE_UNIT                                = 'COMPOSITION';
    const CONCERN                                                    = 'CONC';
    const CONDITION                                                  = 'CON';
    const CONDITION_NODE                                             = 'CNOD';
    const CONNECTION                                                 = 'CONC';
    const CONSENT                                                    = 'CONS';
    const CONTACT                                                    = 'CON';
    const CONTAINER                                                  = 'CONT';
    const CONTAINER_REGISTRATION                                     = 'CONTREG';
    const CONTAMINANT_INGREDIENT                                     = 'CNTM';
    const CONTENT                                                    = 'CONT';
    const CONTINUITY                                                 = 'CONY';
    const CONTRACT                                                   = 'CNTRCT';
    const CONTROL_ACT                                                = 'CACT';
    const CORRELATED_OBSERVATION_SEQUENCES                           = 'OBSCOR';
    const COUNTRY                                                    = 'COUNTRY';
    const COUNTY                                                     = 'COUNTY';
    const COVERAGE                                                   = 'COV';
    const COVERAGE_SPONSOR                                           = 'SPNSR';
    const COVERED_PARTY                                              = 'COVPTY';
    const CREDENTIALED_ENTITY                                        = 'CRED';
    const DEDICATED_SERVICE_DELIVERY_LOCATION                        = 'DSDLOC';
    const DEPENDENT                                                  = 'DEPEN';
    const DETECTED_ISSUE                                             = 'ALRT';
    const DETERMINANT_PEPTIDE                                        = 'DETPOL';
    const DIAGNOSTIC_IMAGE                                           = 'DGIMG';
    const DISCIPLINARY_ACTION                                        = 'DISPACT';
    const DISTRIBUTED_MATERIAL                                       = 'DST';
    const DOCUMENT                                                   = 'DOC';
    const DOCUMENT_BODY                                              = 'DOCBODY';
    const DOCUMENT_SECTION                                           = 'DOCSECT';
    const ELECTRONIC_HEALTH_RECORD                                   = 'EHR';
    const EMERGENCY_CONTACT                                          = 'ECON';
    const EMPLOYEE                                                   = 'EMP';
    const EMPLOYMENT                                                 = 'EMP';
    const ENCOUNTER                                                  = 'ENC';
    const ENTITY                                                     = 'ENT';
    const ENTRY                                                      = 'ENTRY';
    const EQUIVALENT_ENTITY                                          = 'EQUIV';
    const EVENT_LOCATION                                             = 'EXLOC';
    const EXPOSED_ENTITY                                             = 'EXPR';
    const EXPOSURE                                                   = 'EXPOS';
    const EXPOSURE_AGENT_CARRIER                                     = 'EXPAGTCAR';
    const EXPOSURE_VECTOR                                            = 'EXPVECTOR';
    const EXPRESSION_LEVEL                                           = 'EXP';
    const EXTRACT                                                    = 'EXTRACT';
    const FINANCIAL_ADJUDICATION                                     = 'ADJUD';
    const FINANCIAL_CONTRACT                                         = 'FCNTRCT';
    const FINANCIAL_TRANSACTION                                      = 'XACT';
    const FLAVOR_ADDITIVE                                            = 'FLVR';
    const FOLDER                                                     = 'FOLDER';
    const FOMITE                                                     = 'FOMITE';
    const FOOD                                                       = 'FOOD';
    const GENOMIC_OBSERVATION                                        = 'GEN';
    const GROUP                                                      = 'RGRP';
    const GROUPER                                                    = 'GROUPER';
    const GUARANTOR                                                  = 'GUAR';
    const GUARANTOR_ROLE                                             = 'GUAR';
    const GUARDIAN                                                   = 'GUARD';
    const HAS_GENERIC                                                = 'GRIC';
    const HEALTH_CHART                                               = 'HLTHCHRT';
    const HEALTH_CHART_ENTITY                                        = 'HCE';
    const HEALTHCARE_PROVIDER                                        = 'PROV';
    const HELD_ENTITY                                                = 'HLD';
    const HOLD                                                       = 'HOLD';
    const IDENTIFIED_ENTITY                                          = 'IDENT';
    const IDENTITY                                                   = 'IDENT';
    const IMAGING_MODALITY                                           = 'MODDV';
    const INACTIVE_INGREDIENT                                        = 'IACT';
    const INCIDENT                                                   = 'INC';
    const INCIDENTAL_SERVICE_DELIVERY_LOCATION                       = 'ISDLOC';
    const INDIVIDUAL                                                 = 'INDIV';
    const INFORM                                                     = 'INFRM';
    const INFORMATION                                                = 'INFO';
    const INGREDIENT                                                 = 'INGR';
    const INSTANCE                                                   = 'INST';
    const INVESTIGATION                                              = 'INVSTG';
    const INVESTIGATION_SUBJECT                                      = 'INVSBJ';
    const INVOICE_ELEMENT                                            = 'INVE';
    const INVOICE_PAYOR                                              = 'PAYOR';
    const ISOLATE                                                    = 'ISLT';
    const JURISDICTIONAL_POLICY                                      = 'JURISPOL';
    const LICENSED_ENTITY                                            = 'LIC';
    const LIVING_SUBJECT                                             = 'LIV';
    const LOCATED_ENTITY                                             = 'LOCE';
    const LOCUS                                                      = 'LOC';
    const MAINTAINED_ENTITY                                          = 'MNT';
    const MANUFACTURED_MATERIAL                                      = 'MMAT';
    const MANUFACTURED_PRODUCT                                       = 'MANU';
    const MATERIAL                                                   = 'MAT';
    const MECHANICAL_INGREDIENT                                      = 'MECH';
    const MEMBER                                                     = 'MBR';
    const MICROORGANISM                                              = 'MIC';
    const MILITARY_PERSON                                            = 'MIL';
    const MOLECULAR_BOND                                             = 'BOND';
    const MONITORING_PROGRAM                                         = 'MPROT';
    const NAMED_INSURED                                              = 'NAMED';
    const NATION                                                     = 'NAT';
    const NEXT_OF_KIN                                                = 'NOK';
    const NON_PERSON_LIVING_SUBJECT                                  = 'NLIV';
    const NOTARY_PUBLIC                                              = 'NOT';
    const NURSE                                                      = 'NURS';
    const NURSE_PRACTITIONER                                         = 'NURPRAC';
    const OBSERVATION                                                = 'OBS';
    const OBSERVATION_SERIES                                         = 'OBSSER';
    const ORGANISATION                                               = 'ORG';
    const ORGANIZATIONAL_POLICY                                      = 'ORGPOL';
    const ORGANIZER                                                  = 'ORGANIZER';
    const OUTBREAK                                                   = 'OUTBR';
    const OVERLAY_ROI                                                = 'ROIOVL';
    const OWNED_ENTITY                                               = 'OWN';
    const PART                                                       = 'PART';
    const PATIENT                                                    = 'PAT';
    const PAYEE                                                      = 'PAYEE';
    const PERSON                                                     = 'PSN';
    const PERSONAL_RELATIONSHIP                                      = 'PRS';
    const PHENOTYPE                                                  = 'PHN';
    const PHYSICIAN                                                  = 'PHYS';
    const PHYSICIAN_ASSISTANT                                        = 'PA';
    const PLACE                                                      = 'PLC';
    const PLACE_OF_DEATH                                             = 'DEATHPLC';
    const PLANT                                                      = 'PLNT';
    const POLICY                                                     = 'POLICY';
    const POLICY_HOLDER                                              = 'POLHOLD';
    const POLYPEPTIDE                                                = 'POL';
    const POSITION                                                   = 'POS';
    const POSITION_ACCURACY                                          = 'POSACC';
    const POSITION_COORDINATE                                        = 'POSCOORD';
    const PRESERVATIVE                                               = 'PRSV';
    const PROCEDURE                                                  = 'PROC';
    const PROGRAM_ELIGIBLE                                           = 'PROG';
    const PRONE                                                      = 'PRN';
    const PROVINCE                                                   = 'PROVINCE';
    const PSN                                                        = 'PSN';
    const PUBLIC_HEALTH_CASE                                         = 'HCASE';
    const PUBLIC_INSTITUTION                                         = 'PUB';
    const QUALIFICATION                                              = 'QUAL';
    const QUALIFIED_ENTITY                                           = 'QUAL';
    const RECORD_CONTAINER                                           = 'CONTAINER';
    const RECORD_ORGANIZER                                           = '_ActClassRecordOrganizer';
    const REGISTRATION                                               = 'REG';
    const REGULATED_PRODUCT                                          = 'RGPR';
    const RESEARCH_SUBJECT                                           = 'RESBJ';
    const RETAILED_MATERIAL                                          = 'RET';
    const REVERSE_TRENDELENBURG                                      = 'RTRD';
    const REVIEW                                                     = 'REV';
    const RIGHT_LATERAL_DECUBITUS                                    = 'RLD'; // lying on right side
    const ROLE                                                       = 'ROL';
    const ROLE_CLASS_ASSOCIATIVE                                     = '_RoleClassAssociative';
    const ROLE_CLASS_MUTUAL_RELATIONSHIP                             = '_RoleClassMutualRelationship';
    const ROLE_CLASS_ONTOLOGICAL                                     = '_RoleClassOntological';
    const ROLE_CLASS_PARTITIVE                                       = '_RoleClassPartitive';
    const ROLE_CLASS_PASSIVE                                         = '_RoleClassPassive';
    const ROLE_CLASS_RELATIONSHIP_FORMAL                             = '_RoleClassRelationshipFormal';
    const SAME                                                       = 'SAME';
    const SCOPE_OF_PRACTICE_POLICY                                   = 'SCOPOL';
    const SELF                                                       = 'SELF';
    const SEMI_FOWLER                                                = 'SFWL'; // A semi-sitting position in bed with the head of the bed elevated approximately 45 degrees.
    const SERVICE_DELIVERY_LOCATION                                  = 'SDLOC';
    const SIGNING_AUTHORITY_OR_OFFICER                               = 'SGNOFF';
    const SITTING                                                    = 'SIT';
    const SPECIMEN_COLLECTION                                        = 'SPECCOLLECT';
    const SPECIMEN_OBSERVATION                                       = 'SPCOBS';
    const SPECIMEN_TREATMENT                                         = 'SPCTRT';
    const STABILIZER                                                 = 'STBL';
    const STANDARD_OF_PRACTICE_POLICY                                = 'STDPOL';
    const STANDING                                                   = 'STN';
    const STATE                                                      = 'STATE';
    const STATE_OR_PROVINCE                                          = 'PROVINCE';
    const STATE_TRANSITION_CONTROL                                   = 'STC';
    const STORAGE                                                    = 'STORE';
    const STORED_ENTITY                                              = 'STOR';
    const STUDENT                                                    = 'STD';
    const SUBJECT_PHYSICAL_POSITION                                  = '_SubjectPhysicalPosition';
    const SUBSCRIBER                                                 = 'SUBSCR';
    const SUBSTANCE_ADMINISTRATION                                   = 'SBADM';
    const SUBSTANCE_EXTRACTION                                       = 'SBEXT';
    const SUBSTITUTION                                               = 'SUBST';
    const SUBSUMED_BY                                                = 'SUBY';
    const SUBSUMER                                                   = 'SUBS';
    const SUPINE                                                     = 'SUP';
    const SUPPLY                                                     = 'SPLY';
    const TERRITORY_OF_AUTHORITY                                     = 'TERR';
    const TOPIC                                                      = 'TOPIC';
    const TRANSFER                                                   = 'TRFR';
    const TRANSMISSION_EXPOSURE                                      = 'TEXPOS';
    const TRANSPORTATION                                             = 'TRNS';
    const TRENDELENBURG                                              = 'TRD';
    const UNDERWRITER                                                = 'UNDWRT';
    const USED_ENTITY                                                = 'USED';
    const VERIFICATION                                               = 'VERIF';
    const WARRANTED_PRODUCT                                          = 'WRTE';
    const WORKING_LIST                                               = 'LIST';
    /**
     * @link https://www.hl7.org/fhir/v3/ActClass/cs.html
     */
    const ActClass = array(
      '',
      self::ACT,
      self::COMPOSITION,
      self::DOCUMENT,
      self::CLINICAL_DOCUMENT,
      self::CDA_LEVEL_ONE_CLINICAL_DOCUMENT,
      self::RECORD_CONTAINER,
      self::CATEGORY,
      self::DOCUMENT_BODY,
      self::DOCUMENT_SECTION,
      self::TOPIC,
      self::EXTRACT,
      self::ELECTRONIC_HEALTH_RECORD,
      self::FOLDER,
      self::GROUPER,
      self::CLUSTER,
      self::ACCOMMODATION,
      self::ACCOUNT,
      self::ACCESSION,
      self::FINANCIAL_ADJUDICATION,
      self::CONTROL_ACT,
      self::ACTION,
      self::INFORMATION,
      self::STATE_TRANSITION_CONTROL,
      self::CONTRACT,
      self::FINANCIAL_CONTRACT,
      self::COVERAGE,
      self::CONCERN,
      self::PUBLIC_HEALTH_CASE,
      self::OUTBREAK,
      self::CONSENT,
      self::CONTAINER_REGISTRATION,
      self::CLINICAL_TRIAL_TIMEPOINT_EVENT,
      self::DISCIPLINARY_ACTION,
      self::EXPOSURE,
      self::ACQUISITION_EXPOSURE,
      self::TRANSMISSION_EXPOSURE,
      self::INCIDENT,
      self::INFORM,
      self::INVOICE_ELEMENT,
      self::MONITORING_PROGRAM,
      self::OBSERVATION,
      self::BOUNDED_ROI,
      self::OVERLAY_ROI,
      self::DETECTED_ISSUE,
      self::BATTERY,
      self::CLINICAL_TRIAL,
      self::DIAGNOSTIC_IMAGE,
      self::GENOMIC_OBSERVATION,
      self::DETERMINANT_PEPTIDE,
      self::EXPRESSION_LEVEL,
      self::LOCUS,
      self::PHENOTYPE,
      self::BIO_SEQUENCE,
      self::BIO_SEQUENCE_VARIATION,
      self::INVESTIGATION,
      self::OBSERVATION_SERIES,
      self::CORRELATED_OBSERVATION_SEQUENCES,
      self::POSITION,
      self::POSITION_ACCURACY,
      self::POSITION_COORDINATE,
      self::SPECIMEN_OBSERVATION,
      self::VERIFICATION,
      self::CARE_PROVISION,
      self::ENCOUNTER,
      self::POLICY,
      self::JURISDICTIONAL_POLICY,
      self::ORGANIZATIONAL_POLICY,
      self::SCOPE_OF_PRACTICE_POLICY,
      self::STANDARD_OF_PRACTICE_POLICY,
      self::PROCEDURE,
      self::SUBSTANCE_ADMINISTRATION,
      self::SUBSTANCE_EXTRACTION,
      self::SPECIMEN_COLLECTION,
      self::REGISTRATION,
      self::REVIEW,
      self::SPECIMEN_TREATMENT,
      self::SUPPLY,
      self::STORAGE,
      self::SUBSTITUTION,
      self::TRANSFER,
      self::TRANSPORTATION,
      self::FINANCIAL_TRANSACTION,
      self::ENTRY,
      self::ORGANIZER
    );

    /**
     * @link http://cdatools.org/javadoc/org/openhealthtools/mdht/uml/hl7/vocab/x_ActClassDocumentEntryAct.html
     * @link https://www.hl7.org/documentcenter/public_temp_C49CF1F7-1C23-BA17-0C2D88313E773B37/standards/vocabulary/vocabulary_tables/infrastructure/vocabulary/vs_ActClass.html#ActClassConsent
     */
    const x_ActClassDocumentEntryAct = array(
      '',
      self::ACCOMMODATION,
      self::ACT,
      self::CONSENT,
      self::CLINICAL_TRIAL_TIME_POINT_EVENT,
      self::INCIDENT,
      self::INFORM,
      self::CARE_PROVISION,
      self::REGISTRATION,
      self::SPECIMEN_TREATMENT
    );

    const EntityClassRoot = array(
      '',
      self::ENTITY,
      self::HEALTH_CHART_ENTITY,
      self::LIVING_SUBJECT,
      self::NON_PERSON_LIVING_SUBJECT,
      self::ANIMAL,
      self::MICROORGANISM,
      self::PLANT,
      self::PERSON,
      self::MATERIAL,
      self::CHEMICAL_SUBSTANCE,
      self::FOOD,
      self::MANUFACTURED_MATERIAL,
      self::CONTAINER,
      self::CLASS_HOLDER,
      self::CLASS_DEVICE,
      self::CERTIFICATE_REPRESENTATION,
      self::IMAGING_MODALITY,
      self::ORGANISATION,
      self::PUBLIC_INSTITUTION,
      self::STATE,
      self::NATION,
      self::PLACE,
      self::CITY,
      self::COUNTRY,
      self::COUNTY,
      self::STATE_OR_PROVINCE,
      self::GROUP,
    );

    /**
     * https://www.hl7.org/fhir/v3/RoleClassRoot/vs.html
     */


    const RoleClassRoot = array(
      '',
      self::ROLE,
      self::ROLE_CLASS_ASSOCIATIVE,
      self::ROLE_CLASS_MUTUAL_RELATIONSHIP,
      self::ROLE_CLASS_RELATIONSHIP_FORMAL,
      self::AFFILIATE,
      self::AGENT,
      self::ASSIGNED_ENTITY,
      self::COMMISSIONING_PARTY,
      self::SIGNING_AUTHORITY_OR_OFFICER,
      self::CONTACT,
      self::EMERGENCY_CONTACT,
      self::NEXT_OF_KIN,
      self::GUARDIAN,
      self::CITIZEN,
      self::COVERED_PARTY,
      self::CLAIMANT,
      self::NAMED_INSURED,
      self::DEPENDENT,
      self::INDIVIDUAL,
      self::SUBSCRIBER,
      self::PROGRAM_ELIGIBLE,
      self::CLINICAL_RESEARCH_INVESTIGATOR,
      self::CLINICAL_RESEARCH_SPONSOR,
      self::EMPLOYEE,
      self::MILITARY_PERSON,
      self::GUARANTOR,
      self::INVESTIGATION_SUBJECT,
      self::CASE_SUBJECT,
      self::RESEARCH_SUBJECT,
      self::LICENSED_ENTITY,
      self::NOTARY_PUBLIC,
      self::HEALTHCARE_PROVIDER,
      self::PATIENT,
      self::PAYEE,
      self::INVOICE_PAYOR,
      self::POLICY_HOLDER,
      self::QUALIFIED_ENTITY,
      self::COVERAGE_SPONSOR,
      self::STUDENT,
      self::UNDERWRITER,
      self::CAREGIVER,
      self::PERSONAL_RELATIONSHIP,
      self::SELF,
      self::ROLE_CLASS_PASSIVE,
      self::ACCESS,
      self::ADJACENCY,
      self::CONNECTION,
      self::MOLECULAR_BOND,
      self::CONTINUITY,
      self::ADMINISTERABLE_MATERIAL,
      self::BIRTHPLACE,
      self::PLACE_OF_DEATH,
      self::DISTRIBUTED_MATERIAL,
      self::RETAILED_MATERIAL,
      self::EVENT_LOCATION,
      self::SERVICE_DELIVERY_LOCATION,
      self::DEDICATED_SERVICE_DELIVERY_LOCATION,
      self::INCIDENTAL_SERVICE_DELIVERY_LOCATION,
      self::EXPOSED_ENTITY,
      self::HELD_ENTITY,
      self::HEALTH_CHART,
      self::IDENTIFIED_ENTITY,
      self::MANUFACTURED_PRODUCT,
      self::CLASS_THERAPEUTIC_AGENT,
      self::MAINTAINED_ENTITY,
      self::OWNED_ENTITY,
      self::REGULATED_PRODUCT,
      self::TERRITORY_OF_AUTHORITY,
      self::USED_ENTITY,
      self::WARRANTED_PRODUCT,
      self::ROLE_CLASS_ONTOLOGICAL,
      self::EQUIVALENT_ENTITY,
      self::SAME,
      self::SUBSUMED_BY,
      self::CLASS_HAS_GENERALIZATION,
      self::HAS_GENERIC,
      self::INSTANCE,
      self::SUBSUMER,
      self::ROLE_CLASS_PARTITIVE,
      self::CONTENT,
      self::EXPOSURE_AGENT_CARRIER,
      self::EXPOSURE_VECTOR,
      self::FOMITE,
      self::INGREDIENT,
      self::ACTIVE_INGREDIENT,
      self::ACTIVE_INGREDIENT_BASIS_OF_STRENGTH,
      self::ACTIVE_INGREDIENT_MOIETY_IS_BASIS_OF_STRENGTH,
      self::ACTIVE_INGREDIENT_REFERENCE_SUBSTANCE_IS_BASIS_OF_STRENGTH,
      self::ADJUVANT,
      self::ADDITIVE,
      self::BASE,
      self::CONTAMINANT_INGREDIENT,
      self::INACTIVE_INGREDIENT,
      self::COLOR_ADDITIVE,
      self::FLAVOR_ADDITIVE,
      self::PRESERVATIVE,
      self::STABILIZER,
      self::MECHANICAL_INGREDIENT,
      self::LOCATED_ENTITY,
      self::STORED_ENTITY,
      self::MEMBER,
      self::PART,
      self::ACTIVE_MOIETY,
      self::CLASS_SPECIMEN,
      self::ALIQUOT,
      self::ISOLATE,
    );

    const RoleClassManufacturedProduct = array(
      '',
      self::MANUFACTURED_PRODUCT,
      self::CLASS_THERAPEUTIC_AGENT
    );

    const RoleClassAssignedEntity = array(
      '',
      self::CHILD,
      self::CREDENTIALED_ENTITY,
      self::NURSE_PRACTITIONER,
      self::NURSE,
      self::PHYSICIAN_ASSISTANT,
      self::PHYSICIAN,
      self::ROLE,
      self::ROLE_CLASS_ASSOCIATIVE,
      self::ROLE_CLASS_MUTUAL_RELATIONSHIP,
      self::CAREGIVER,
      self::PERSONAL_RELATIONSHIP,
      self::ROLE_CLASS_RELATIONSHIP_FORMAL,
      self::AFFILIATE,
      self::AGENT,
      self::ASSIGNED_ENTITY,
      self::COMMISSIONING_PARTY,
      self::SIGNING_AUTHORITY_OR_OFFICER,
      self::CONTACT,
      self::EMERGENCY_CONTACT,
      self::NEXT_OF_KIN,
      self::GUARDIAN,
      self::CITIZEN,
      self::COVERED_PARTY,
      self::CLAIMANT,
      self::NAMED_INSURED,
      self::DEPENDENT,
      self::INDIVIDUAL,
      self::SUBSCRIBER,
      self::PROGRAM_ELIGIBLE,
      self::CLINICAL_RESEARCH_INVESTIGATOR,
      self::CLINICAL_RESEARCH_SPONSOR,
      self::EMPLOYEE,
      self::MILITARY_PERSON,
      self::GUARANTOR,
      self::GUARANTOR_ROLE,
      self::INVESTIGATION_SUBJECT,
      self::CASE_SUBJECT,
      self::RESEARCH_SUBJECT,
      self::LICENSED_ENTITY,
      self::NOTARY_PUBLIC,
      self::HEALTHCARE_PROVIDER,
      self::PATIENT,
      self::PAYEE,
      self::INVOICE_PAYOR,
      self::POLICY_HOLDER,
      self::QUALIFIED_ENTITY,
      self::COVERAGE_SPONSOR,
      self::STUDENT,
      self::UNDERWRITER,
      self::ROLE_CLASS_PASSIVE,
      self::ACCESS,
      self::ADJACENCY,
      self::CONNECTION,
      self::MOLECULAR_BOND,
      self::CONTINUITY,
      self::ADMINISTERABLE_MATERIAL,
      self::BIRTHPLACE,
      self::PLACE_OF_DEATH,
      self::DISTRIBUTED_MATERIAL,
      self::RETAILED_MATERIAL,
      self::EXPOSED_ENTITY,
      self::HELD_ENTITY,
      self::HEALTH_CHART,
      self::IDENTIFIED_ENTITY,
      self::MANUFACTURED_PRODUCT,
      self::CLASS_THERAPEUTIC_AGENT,
      self::MAINTAINED_ENTITY,
      self::OWNED_ENTITY,
      self::REGULATED_PRODUCT,
      self::SERVICE_DELIVERY_LOCATION,
      self::DEDICATED_SERVICE_DELIVERY_LOCATION,
      self::INCIDENTAL_SERVICE_DELIVERY_LOCATION,
      self::TERRITORY_OF_AUTHORITY,
      self::USED_ENTITY,
      self::WARRANTED_PRODUCT,
      self::ROLE_CLASS_ONTOLOGICAL,
      self::EQUIVALENT_ENTITY,
      self::SAME,
      self::SUBSUMED_BY,
      self::CLASS_HAS_GENERALIZATION,
      self::HAS_GENERIC,
      self::INSTANCE,
      self::SUBSUMER,
      self::ROLE_CLASS_PARTITIVE,
      self::CONTENT,
      self::EXPOSURE_AGENT_CARRIER,
      self::EXPOSURE_VECTOR,
      self::FOMITE,
      self::INGREDIENT,
      self::ACTIVE_INGREDIENT,
      self::ACTIVE_INGREDIENT_BASIS_OF_STRENGTH,
      self::ACTIVE_INGREDIENT_MOIETY_IS_BASIS_OF_STRENGTH,
      self::ACTIVE_INGREDIENT_REFERENCE_SUBSTANCE_IS_BASIS_OF_STRENGTH,
      self::ADJUVANT,
      self::ADDITIVE,
      self::BASE,
      self::INACTIVE_INGREDIENT,
      self::COLOR_ADDITIVE,
      self::FLAVOR_ADDITIVE,
      self::PRESERVATIVE,
      self::STABILIZER,
      self::MECHANICAL_INGREDIENT,
      self::LOCATED_ENTITY,
      self::STORED_ENTITY,
      self::MEMBER,
      self::PART,
      self::ACTIVE_MOIETY,
      self::CLASS_SPECIMEN,
      self::ALIQUOT,
      self::ISOLATE,
    );

    /**
     * @link
     */
    const EntityClass = array(
      '',
      self::ENTITY,
      self::HEALTH_CHART_ENTITY,
      self::LIVING_SUBJECT,
      self::NON_PERSON_LIVING_SUBJECT,
      self::ANIMAL,
      self::MICROORGANISM,
      self::PLANT,
      self::PERSON,
      self::MATERIAL,
      self::CHEMICAL_SUBSTANCE,
      self::FOOD,
      self::MANUFACTURED_MATERIAL,
      self::CONTAINER,
      self::CLASS_HOLDER,
      self::CLASS_DEVICE,
      self::CERTIFICATE_REPRESENTATION,
      self::IMAGING_MODALITY,
      self::ORGANISATION,
      self::PUBLIC_INSTITUTION,
      self::STATE,
      self::NATION,
      self::PLACE,
      self::CITY,
      self::COUNTRY,
      self::COUNTY,
      self::STATE,
      self::GROUP,
    );

    /**
     * see processable/coreschemas/voc.xsd
     */
    const EntityClassManufacturedMaterial = array(
      '',
      self::MATERIAL,
      self::MANUFACTURED_MATERIAL,
      self::CHEMICAL_SUBSTANCE,
      self::FOOD,
      self::CONTAINER,
      self::CERTIFICATE_REPRESENTATION,
      self::IMAGING_MODALITY
    );
    const EntityClassDevice               = array(
      '',
      self::CLASS_DEVICE
    );
    const EntityClassOrganization         = array(
      '',
      self::PUBLIC_INSTITUTION,
      self::ORGANISATION,
      self::IDENTIFIED_ENTITY
    );

    const RoleClassAssociative = array(
      '',
      self::CAREGIVER,
      self::PERSONAL_RELATIONSHIP,
      self::ACCESS,
      self::BIRTHPLACE,
      self::EXPOSED_ENTITY,
      self::HELD_ENTITY,
      self::HEALTH_CHART,
      self::IDENTITY,
      self::MAINTAINED_ENTITY,
      self::OWNED_ENTITY,
      self::REGULATED_PRODUCT,
      self::TERRITORY_OF_AUTHORITY,
      self::WARRANTED_PRODUCT,
      self::ASSIGNED
    );

    /**
     * @link http://cdatools.org/javadoc/org/openhealthtools/mdht/uml/hl7/vocab/x_ActClassDocumentEntryOrganizer.html
     *
     */
    const x_ActClassDocumentEntryOrganizer = array(
      self::BATTERY,
      self::CLUSTER
    );

    const RoleClassSpecimen = array(
      '',
      self::CLASS_SPECIMEN
    );

    const ActClassObservation = array(
      '',
      self::OBSERVATION,
      self::ACT,
      self::ACCOMMODATION,
      self::ACCOUNT,
      self::ACCESSION,
      self::ADJUVANT,
      self::CONSENT,
      self::CONTAINER_REGISTRATION,
      self::CLINICAL_TRIAL_TIMEPOINT_EVENT,
      self::DISCIPLINARY_ACTION,
      self::ENCOUNTER,
      self::INCIDENT,
      self::INFORM,
      self::INVOICE_ELEMENT,
      self::WORKING_LIST,
      self::MONITORING_PROGRAM,
      self::CARE_PROVISION,
      self::PROCEDURE,
      self::REGISTRATION,
      self::REVIEW,
      self::SUBSTANCE_ADMINISTRATION,
      self::SPECIMEN_TREATMENT,
      self::SUBSTITUTION,
      self::TRANSPORTATION,
      self::VERIFICATION,
      self::FINANCIAL_TRANSACTION
    );
    /**
     * @link https://docs.microsoft.com/en-us/healthvault/reference/datatypes/clinical-document-architecture-(cda)#x_InformationRecipientRole
     */
    const x_InformationRecipientRole = [
      '',
      self::ASSIGNED,
      self::HEALTH_CHART,
    ];
    /**
     * @link http://hl7.ihelse.net/hl7v3/infrastructure/vocabulary/ActClass.html
     */
    const ActClassRoot = [
      '',
      self::ACCOMMODATION,
      self::ACCOUNT,
      self::ACCESSION,
      self::ACT,
      self::ACTION,
      self::FINANCIAL_ADJUDICATION,
      self::ACQUISITION_EXPOSURE,
      self::DETECTED_ISSUE,
      self::BATTERY,
      self::CONTROL_ACT,
      self::PUBLIC_HEALTH_CASE,
      self::CATEGORY,
      self::CDA_LEVEL_ONE_CLINICAL_DOCUMENT,
      self::CLINICAL_TRIAL,
      self::CLUSTER,
      self::CONDITION_NODE,
      self::CONTRACT,
      self::COMPOSITION,
      self::CONDITION,
      self::CONSENT,
      self::CONTAINER,
      self::CONTAINER_REGISTRATION,
      self::COVERAGE,
      self::CLINICAL_TRIAL_TIME_POINT_EVENT,
      self::DETERMINANT_PEPTIDE,
      self::DIAGNOSTIC_IMAGE,
      self::DISCIPLINARY_ACTION,
      self::DOCUMENT,
      self::DOCUMENT_BODY,
      self::CLINICAL_DOCUMENT,
      self::DOCUMENT_SECTION,
      self::ELECTRONIC_HEALTH_RECORD,
      self::ENCOUNTER,
      self::EXPRESSION_LEVEL,
      self::EXPOSURE,
      self::EXTRACT,
      self::FINANCIAL_CONTRACT,
      self::FOLDER,
      self::GENOMIC_OBSERVATION,
      self::GROUPER,
      self::INCIDENT,
      self::INFORMATION,
      self::INFORM,
      self::INVOICE_ELEMENT,
      self::INVESTIGATION,
      self::JURISDICTIONAL_POLICY,
      self::WORKING_LIST,
      self::LOCUS,
      self::MONITORING_PROGRAM,
      self::OBSERVATION,
      self::CORRELATED_OBSERVATION_SEQUENCES,
      self::OBSERVATION_SERIES,
      self::ORGANIZATIONAL_POLICY,
      self::OUTBREAK,
      self::CARE_PROVISION,
      self::PHENOTYPE,
      self::POLYPEPTIDE,
      self::POLICY,
      self::POSITION,
      self::POSITION_ACCURACY,
      self::POSITION_COORDINATE,
      self::PRONE,
      self::PROCEDURE,
      self::REGISTRATION,
      self::REVIEW,
      self::RIGHT_LATERAL_DECUBITUS,
      self::BOUNDED_ROI,
      self::OVERLAY_ROI,
      self::REVERSE_TRENDELENBURG,
      self::SUBSTANCE_ADMINISTRATION,
      self::SCOPE_OF_PRACTICE_POLICY,
      self::BIO_SEQUENCE,
      self::BIO_SEQUENCE_VARIATION,
      self::SEMI_FOWLER,
      self::SITTING,
      self::SPECIMEN_OBSERVATION,
      self::SPECIMEN_TREATMENT,
      self::SPECIMEN_COLLECTION,
      self::SUPPLY,
      self::STATE_TRANSITION_CONTROL,
      self::STANDARD_OF_PRACTICE_POLICY,
      self::STANDING,
      self::STORAGE,
      self::SUBSTITUTION,
      self::SUPINE,
      self::TRANSMISSION_EXPOSURE,
      self::TOPIC,
      self::TRENDELENBURG,
      self::TRANSFER,
      self::TRANSPORTATION,
      self::VERIFICATION,
      self::FINANCIAL_TRANSACTION,
    ];

    /** @return string */
    public function getClassCode(): string;
}
