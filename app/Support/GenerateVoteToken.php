<?php

namespace App\Support;

use App\Models\Voter;

class GenerateVoteToken
{
    /**
     * Decrypt the given value.
     */
    public static function generate(string $value): string
    {
        do {
            $emailPrefix = strstr($value, '@', true);
            $lettersOnly = preg_replace('/[^a-zA-Z]/', '', str_shuffle($emailPrefix));
            $lettersOnly = str_pad($lettersOnly, 3, 'X');

            $len = strlen($lettersOnly);
            $salt = $lettersOnly[0] . $lettersOnly[(int)($len / 2)] . $lettersOnly[$len - 1];

            $yearHex = str_pad(dechex((int) date('Y')), 4, '0', STR_PAD_LEFT);
            $randomString = substr(bin2hex(random_bytes(2)), 0, 4);

            $token = strtoupper("{$salt}-{$yearHex}-{$randomString}");
        } while (Voter::where('vote_token', AttributeEncryptor::encrypt($token))->exists());

        return $token;
    }
}

