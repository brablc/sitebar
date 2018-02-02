<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2005-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software: you can redistribute it and/or modify      *
 *  it under the terms of the GNU Affero General Public License as published  *
 *  by the Free Software Foundation, either version 3 of the License, or      *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU Affero General Public License for more details.                       *
 *                                                                            *
 *  You should have received a copy of the GNU Affero General Public License  *
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 ******************************************************************************/

require_once('./inc/errorhandler.inc.php');
require_once('./inc/database.inc.php');
require_once('./inc/usermanager.inc.php');
require_once('./inc/page.inc.php');

class SB_Token extends SB_ErrorHandler
{
    var $db;
    var $um;

    var $username;
    var $token;

    function __construct()
    {
        $this->db =& SB_Database::staticInstance();
        $this->um =& SB_UserManager::staticInstance();
    }

    static function & staticInstance()
    {
        static $token;

        if (!$token)
        {
            $token = new SB_Token();
        }

        return $token;
    }

    function createVerifyToken($uid)
    {
        return $this->createToken('verify', $uid, 60*60*24*3);
    }

    function createResetToken($uid)
    {
        return $this->createToken('reset', $uid, 60*60*24);
    }

    function createToken($type, $uid, $expires)
    {
        $user = $this->um->getUser($uid);
        $token = $this->generateTokenCode();

        // Delete all existing tokens
        $this->db->delete('sitebar_token', array( 'uid' => $uid ));

        // Create the token of the desired type
        $this->db->insert('sitebar_token', array
        (
            'uid' => $uid,
            'type' => $type,
            'issued' => array('now'=>null),
            'expires' => time()+$expires,
            'token' => $token,
        ));

        return SB_Page::absBaseUrl().'token.php?'.$uid.'='.$token;
    }

    function generateTokenCode()
    {
        $size = 8;

        # The list of characters that can appear in a randomly generated password.
        # Note that users can put any character into a password they choose
        # themselves.
        $tkchars = '-_@$^*';

        for ($i=0; $i<=9; $i++)
        {
            $tkchars .= $i;
        }
        for ($i=ord('A'); $i<=ord('Z'); $i++)
        {
            $tkchars .= chr($i).strtolower(chr($i));
        }

        $token = "";

        $tkcharslen = strlen($tkchars)-1;
        for ($i=0 ; $i<$size ; $i++ )
        {
            $token .= $tkchars{rand(0,$tkcharslen)};
        }
        return $token;
    }

    /**
    * If the token is invalid, then all tokens for the given username will be invalidated.
    */
    function validate($uid, $token, $redirect=false)
    {
        // Select the right token
        $rset = $this->db->select(null, 'sitebar_token', array
        (
            'uid' => $uid,
            '^1' => 'AND',
            'token' => $token,
            '^2' => 'AND expires>=' . time(),
        ));
        $tokenRec = $this->db->fetchRecord($rset);

        if ($tokenRec)
        {
            $user = $this->um->getUser($uid);

            switch ($tokenRec['type'])
            {
            case 'verify':

                // Delete all existing tokens for this user now
                $this->invalidateTokens($uid);

                $this->db->update('sitebar_user', array('verified'=> 1), array('uid'=>$user['uid']));

                if ($this->um->getParam('config', 'users_must_verify_email'))
                {
                    $paraName = 'usermanager::signup_info_verified';
                    $paraAtt = array($user['username'],SB_Page::absBaseUrl());

                    if ($this->um->getParam('config', 'users_must_be_approved') && !$user['approved'])
                    {
                        $paraName = 'usermanager::signup_approval_verified';
                        $paraAtt[] = $this->um->getApproveUserUrl($user['username']);
                        $paraAtt[] = $this->um->getRejectUserUrl($user['username']);
                        $paraAtt[] = $this->um->getPendingUsersUrl();
                    }

                    $this->um->mailToAdmins(
                        'SiteBar: New SiteBar User Verified E-mail',
                        $paraName, $paraAtt);
                }

                if ($redirect)
                {
                    // No &amp; - it does not go to HTML, it is HTTP redirect
                    SB_redirect('command.php?command=Email+Verified&do=yes&uid='.$uid);
                }
                break;

            case 'reset':
                if ($redirect)
                {
                    // No &amp; - it does not go to HTML, it is HTTP redirect
                    SB_redirect('command.php?command=New+Password&uid='.$uid.'&token='.$token);
                }
                break;
            }

            return true;
        }

        if ($redirect)
        {
            // No &amp; - it does not go to HTML, it is HTTP redirect
            SB_redirect('command.php?command=Invalid+Token&do=yes');
        }

        return false;
    }

    function invalidateTokens($uid)
    {
        // Delete all existing tokens for this user now
        $this->db->delete('sitebar_token', array( 'uid' => $uid ));
    }
}
?>
