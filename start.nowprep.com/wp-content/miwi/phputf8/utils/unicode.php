<?php

function utf8_to_unicode($str) {
    $mState = 0;     // cached expected number of octets after the current octet
                     // until the beginning of the next UTF8 character sequence
    $mUcs4  = 0;     // cached Unicode character
    $mBytes = 1;     // cached expected number of octets in the current sequence

    $out = array();

    $len = strlen($str);

    for($i = 0; $i < $len; $i++) {

        $in = ord($str{$i});

        if ( $mState == 0) {

            // When mState is zero we expect either a US-ASCII character or a
            // multi-octet sequence.
            if (0 == (0x80 & ($in))) {
                // US-ASCII, pass straight through.
                $out[] = $in;
                $mBytes = 1;

            } else if (0xC0 == (0xE0 & ($in))) {
                // First octet of 2 octet sequence
                $mUcs4 = ($in);
                $mUcs4 = ($mUcs4 & 0x1F) << 6;
                $mState = 1;
                $mBytes = 2;

            } else if (0xE0 == (0xF0 & ($in))) {
                // First octet of 3 octet sequence
                $mUcs4 = ($in);
                $mUcs4 = ($mUcs4 & 0x0F) << 12;
                $mState = 2;
                $mBytes = 3;

            } else if (0xF0 == (0xF8 & ($in))) {
                // First octet of 4 octet sequence
                $mUcs4 = ($in);
                $mUcs4 = ($mUcs4 & 0x07) << 18;
                $mState = 3;
                $mBytes = 4;

            } else if (0xF8 == (0xFC & ($in))) {

                $mUcs4 = ($in);
                $mUcs4 = ($mUcs4 & 0x03) << 24;
                $mState = 4;
                $mBytes = 5;

            } else if (0xFC == (0xFE & ($in))) {
                // First octet of 6 octet sequence, see comments for 5 octet sequence.
                $mUcs4 = ($in);
                $mUcs4 = ($mUcs4 & 1) << 30;
                $mState = 5;
                $mBytes = 6;

            } else {

                trigger_error(
                        'utf8_to_unicode: Illegal sequence identifier '.
                            'in UTF-8 at byte '.$i,
                        E_USER_WARNING
                    );
                return FALSE;

            }

        } else {

            // When mState is non-zero, we expect a continuation of the multi-octet
            // sequence
            if (0x80 == (0xC0 & ($in))) {

                // Legal continuation.
                $shift = ($mState - 1) * 6;
                $tmp = $in;
                $tmp = ($tmp & 0x0000003F) << $shift;
                $mUcs4 |= $tmp;

                if (0 == --$mState) {

                    /*
                    * Check for illegal sequences and codepoints.
                    */
                    // From Unicode 3.1, non-shortest form is illegal
                    if (((2 == $mBytes) && ($mUcs4 < 0x0080)) ||
                        ((3 == $mBytes) && ($mUcs4 < 0x0800)) ||
                        ((4 == $mBytes) && ($mUcs4 < 0x10000)) ||
                        (4 < $mBytes) ||
                        // From Unicode 3.2, surrogate characters are illegal
                        (($mUcs4 & 0xFFFFF800) == 0xD800) ||
                        // Codepoints outside the Unicode range are illegal
                        ($mUcs4 > 0x10FFFF)) {

                        trigger_error(
                                'utf8_to_unicode: Illegal sequence or codepoint '.
                                    'in UTF-8 at byte '.$i,
                                E_USER_WARNING
                            );

                        return FALSE;

                    }

                    if (0xFEFF != $mUcs4) {
                        // BOM is legal but we don't want to output it
                        $out[] = $mUcs4;
                    }

                    //initialize UTF8 cache
                    $mState = 0;
                    $mUcs4  = 0;
                    $mBytes = 1;
                }

            } else {

                trigger_error(
                        'utf8_to_unicode: Incomplete multi-octet '.
                        '   sequence in UTF-8 at byte '.$i,
                        E_USER_WARNING
                    );

                return FALSE;
            }
        }
    }
    return $out;
}

function utf8_from_unicode($arr) {
    ob_start();

    foreach (array_keys($arr) as $k) {

        # ASCII range (including control chars)
        if ( ($arr[$k] >= 0) && ($arr[$k] <= 0x007f) ) {

            echo chr($arr[$k]);

        # 2 byte sequence
        } else if ($arr[$k] <= 0x07ff) {

            echo chr(0xc0 | ($arr[$k] >> 6));
            echo chr(0x80 | ($arr[$k] & 0x003f));

        # Byte order mark (skip)
        } else if($arr[$k] == 0xFEFF) {

            // nop -- zap the BOM

        # Test for illegal surrogates
        } else if ($arr[$k] >= 0xD800 && $arr[$k] <= 0xDFFF) {

            // found a surrogate
            trigger_error(
                'utf8_from_unicode: Illegal surrogate '.
                    'at index: '.$k.', value: '.$arr[$k],
                E_USER_WARNING
                );

            return FALSE;

        # 3 byte sequence
        } else if ($arr[$k] <= 0xffff) {

            echo chr(0xe0 | ($arr[$k] >> 12));
            echo chr(0x80 | (($arr[$k] >> 6) & 0x003f));
            echo chr(0x80 | ($arr[$k] & 0x003f));

        # 4 byte sequence
        } else if ($arr[$k] <= 0x10ffff) {

            echo chr(0xf0 | ($arr[$k] >> 18));
            echo chr(0x80 | (($arr[$k] >> 12) & 0x3f));
            echo chr(0x80 | (($arr[$k] >> 6) & 0x3f));
            echo chr(0x80 | ($arr[$k] & 0x3f));

        } else {

            trigger_error(
                'utf8_from_unicode: Codepoint out of Unicode range '.
                    'at index: '.$k.', value: '.$arr[$k],
                E_USER_WARNING
                );

            // out of range
            return FALSE;
        }
    }

    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
