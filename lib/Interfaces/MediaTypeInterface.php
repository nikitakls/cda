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

namespace PHPHealth\CDA\Interfaces;


interface MediaTypeInterface
{
    const APPLICATION_DICOM         = 'application/dicom';
    const APPLICATION_MSWORD        = 'application/msword';
    const APPLICATION_PDF           = 'application/pdf';
    const AUDIO_BASIC               = 'audio/basic';
    const AUDIO_K32ADPCM            = 'audio/k32adpcm';
    const AUDIO_MPEG                = 'audio/mpeg';
    const IMAGE_G3FAX               = 'image/g3fax';
    const IMAGE_GIF                 = 'image/gif';
    const IMAGE_JPEG                = 'image/jpeg';
    const IMAGE_PNG                 = 'image/png';
    const IMAGE_TIFF                = 'image/tiff';
    const MODEL_VRML                = 'model/vrml';
    const MULTIPART_XHL7_CDA_LEVEL1 = 'multipart/x-hl7-cda-level1';
    const TEXT_HTML                 = 'text/html';
    const TEXT_PLAIN                = 'text/plain';
    const TEXT_RTF                  = 'text/rtf';
    const TEXT_SGML                 = 'text/sgml';
    const TEXT_X_HL7_FT             = 'text/x-hl7-ft';
    const TEXT_XML                  = 'text/xml';
    const VIDEO_MPEG                = 'video/mpeg';
    const VIDEO_XAVI                = 'video/x-avi';

    const ApplicationMediaType = array(
      self::APPLICATION_DICOM,
      self::APPLICATION_MSWORD,
      self::APPLICATION_PDF
    );
    const AudioMediaType       = array(
      self::AUDIO_BASIC,
      self::AUDIO_K32ADPCM,
      self::AUDIO_MPEG
    );
    const ImageMediaType       = array(
      self::IMAGE_G3FAX,
      self::IMAGE_GIF,
      self::IMAGE_JPEG,
      self::IMAGE_PNG,
      self::IMAGE_TIFF
    );
    const ModelMediaType       = array(
      self::MODEL_VRML
    );
    const MultipartMediaType   = array(
      self::MULTIPART_XHL7_CDA_LEVEL1
    );
    const TextMediaType        = array(
      self::TEXT_HTML,
      self::TEXT_PLAIN,
      self::TEXT_RTF,
      self::TEXT_SGML,
      self::TEXT_X_HL7_FT,
      self::TEXT_XML
    );
    const VideoMediaType       = array(
      self::VIDEO_MPEG,
      self::VIDEO_XAVI
    );

    const AllMediaTypes = array(
      self::APPLICATION_DICOM,
      self::APPLICATION_MSWORD,
      self::APPLICATION_PDF,
      self::AUDIO_BASIC,
      self::AUDIO_K32ADPCM,
      self::AUDIO_MPEG,
      self::IMAGE_G3FAX,
      self::IMAGE_GIF,
      self::IMAGE_JPEG,
      self::IMAGE_PNG,
      self::IMAGE_TIFF,
      self::MODEL_VRML,
      self::MULTIPART_XHL7_CDA_LEVEL1,
      self::TEXT_HTML,
      self::TEXT_PLAIN,
      self::TEXT_RTF,
      self::TEXT_SGML,
      self::TEXT_X_HL7_FT,
      self::TEXT_XML,
      self::VIDEO_MPEG,
      self::VIDEO_XAVI
    );

    /** @return string */
    public function getMediaType(): string;

    public function setMediaType(string $media_type);

}