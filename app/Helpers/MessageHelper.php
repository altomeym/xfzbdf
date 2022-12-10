<?php

namespace App\Helpers;

use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;

/**
 * This is a helper class for messages
 */
class MessageHelper
{
   
    // mail box types according to script
    public static function mailBoxFolder($label)
    {
        $arr = [
            1 => 'INBOX',
            2 => 'INBOX.Spam',
            3 => 'INBOX.Drafts',
            4 => 'INBOX.Spams',
            5 => 'INBOX.Trash',
        ];

        if($label > 0 && $label < 6){
            return $arr[$label];
        }

        return $label;
            // 1 inbox, 2 sent, 3 drafts, 4 spams, 5 trash,
    }

    // get all email array from string
    public static function getEmailArrayFromString($sString = '')
    {
        $sPattern = '/[\._\p{L}\p{M}\p{N}-]+@[\._\p{L}\p{M}\p{N}-]+/u';
        preg_match_all($sPattern, $sString, $aMatch);
        $aMatch = array_keys(array_flip(current($aMatch)));

        return $aMatch;
    }

    public static function makeConnection($username, $password)
    {
        $cm = new ClientManager('config/imap.php');
        
        return $client = $cm->make([
            'host'          => 'tiejet.net',
            'port'          => env('IMAP_PORT', 993),
            'encryption'    => env('IMAP_ENCRYPTION', 'ssl'),
            'validate_cert' => env('IMAP_VALIDATE_CERT', false),
            'protocol'      => env('IMAP_PROTOCOL', 'imap'),
            'username'      => $username,
            'password'      => $password,
            'options' => [
                'fetch_order' => 'desc',
            ]
        ]);
    }
}
