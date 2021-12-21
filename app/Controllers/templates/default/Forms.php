<?php

namespace App\Controllers\templates\default;

use App\Libraries\CommonLibrary;

class Forms extends \App\Controllers\BaseController
{
    //TODO: php maili kısmı yazılacak.
    public function contactForm_post()
    {
        dd($_POST);
        $commonLibrary = new CommonLibrary();
        $mailResult = $commonLibrary->phpMailer($email, $fullname,
            [['mail' => 'bertugozer1994@gmail.com']],
            $email, $email,
            'İletişim Formu - '.$phone,
            $message
        );
        if ($mailResult === true) return redirect()->route($redirect)->with('message', 'Mesajınız tarafımıza iletildi. En kısa zamanda geri dönüş sağlanacaktır');
        else return redirect()->back()->withInput()->with('error', $mailResult);
    }
}
