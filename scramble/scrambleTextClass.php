<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/30/2018
 * Time: 7:09 AM
 */

namespace App;

class scrambleTextClass {

    protected $text;

    public function scrambleReverse($text)
    {
        $matches     = [];
        $result_word = '';
        if (preg_match_all('/\p{P}*\w*\p{P}*\w*\p{P}*\s*/', $text, $matches)) {
            $result = $text;
            $flag   = 0;

            foreach ($matches[0] as $key => $word) {
                $stringLength = strlen($word); // Length of each words
                $trimmed_word = trim($word); // Separating each words
                $characters        = str_split($trimmed_word); // Splitting each letter

                // First letter formation
                $first_letter  = '';
                while (sizeof($characters) > 0 && preg_match('/[a-zA-Z0-9]/', $characters[0]) === 0) {
                    $first_letter .= $characters[0];
                    array_shift($characters);
                }

                // Last letter formation
                $last_letter = '';
                while (sizeof($characters) > 0 && preg_match('/[a-zA-Z0-9]/', end($characters)) === 0) {
                    $last_letter = end($characters) . $last_letter;
                    array_pop($characters);
                }

                // If words greater that 3 then only shuffle happens
                if (sizeof($characters) > 3) {

                    $char_bw_first_last = [];
                    $punctuationMark    = [];

                    foreach ($characters as $index => $chars) {

                        if (!preg_match('/[a-zA-Z0-9]/', $chars)) {
                            // If any punctuation mark found save it and its index
                            $punctuationMark[$index] = $chars;
                            continue;
                        }

                        // Ignore first and last characters
                        if ($index > 0 && $index < (sizeof($characters) - 1)) {
                            // Save characters in between first and last letters
                            $char_bw_first_last[] = $chars;
                        }

                    }

                    // Shuffle an array of characters between first and last letters
                    shuffle($char_bw_first_last);

                    // Concat First letter, shuffled letters and last letter
                    $result_letters = $characters[0] . implode('', $char_bw_first_last) . $characters[sizeof($characters) - 1];

                    // Replace punctuation from concat letters
                    foreach ($punctuationMark as $index => $chars) {
                        $result_letters = substr_replace($result_letters, $chars, $index, 0);
                    }

                    $result_letters = $first_letter . $result_letters . $last_letter;
                }
                else {
                    // for words 3 characters or less
                    $result_letters = $first_letter . implode('', $characters) . $last_letter;
                }

                $result = substr_replace($result, $result_letters, $flag, strlen($result_letters));

                $flag += $stringLength;
            }

            $scrambleReverse = $result;
        }
        else {
            $scrambleReverse = '';
        }

        return $scrambleReverse;
    }

    public function scrambleForward($text)
    {
        $scrambleForward = $text;
        return $scrambleForward;
    }
}