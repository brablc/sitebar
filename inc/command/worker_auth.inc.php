<?php

class SB_CommandWindowWorker extends SB_CommandWindowBase
{
    function mandatoryLogIn()
    {
        return array('username','pass');
    }

    function buildLogIn()
    {
        $fields = array();

        $lang = SB_reqChk('lang')?SB_reqVal('lang'):$this->um->getParam('user','lang');

        SB_SetLanguage($lang);

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$lang, 'onChange'=>'this.form.submit()');

        $fields['Username'] = array('name'=>'username');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Remember Me'] = array('name'=>'expires','type'=>'select',
            '_options'=>'_buildExpirationList');

        if (SB_reqChk('forward'))
        {
            $fields['--hidden1--'] = array('name'=>'forward','value'=>SB_reqVal('forward'));
        }

        if ($this->showWithErrors)
        {
            $fields['Reset Password'] = array('type'=>'addbutton');
        }

        return $fields;
    }

    function _buildExpirationList()
    {
        $expiration = array
        (
            'Until I close browser' =>0,
            '12 hours' =>60*60*12,
            '6 days'   =>60*60*24*6,
            '1 month'  =>60*60*24*30,
            'Maximum session time' => $this->um->getParam('config','max_session_time'),
        );

        foreach ($expiration as $label => $value)
        {
            if ($value > $this->um->getParam('config','max_session_time'))
            {
                break;
            }

            echo '<option value="' . $value. '">' . SB_T($label). "</option>\n";
        }
    }

    function commandLogIn()
    {
        if (!$this->checkCookie())
        {
            $this->goBack();
            return;
        }

        $expires = min(SB_reqVal('expires'),$this->um->getParam('config','max_session_time'));

        if (!$this->um->login(SB_reqVal('username'), SB_reqVal('pass'), $expires))
        {
            $this->goBack();
            return;
        }

        // This should handle login from translator.php, we should avoid external redirect
        if (SB_reqChk('forward') && strpos(SB_reqVal('forward'),'/') === false)
        {
            header('Location: '.SB_reqVal('forward'));
            exit;
        }

        if (SB_reqChk('bookmarklet'))
        {
            $this->command = 'Add Bookmark';
            $this->fields = $this->buildAddBookmark();
        }
        else
        {
            $this->reload = true;
            $this->close = true;
        }
    }

    function commandLogOut()
    {
        $this->um->logout();
        $this->reload = true;
        $this->close = true;
    }
}