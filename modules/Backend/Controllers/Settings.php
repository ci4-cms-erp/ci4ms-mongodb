<?php namespace Modules\Backend\Controllers;

use MongoDB\BSON\ObjectId;

class Settings extends BaseController
{
    public function index()
    {
        $this->defData['settings'] = $this->commonModel->getOne('settings');
        return view('Modules\Backend\Views\settings', $this->defData);
    }

    public function compInfosPost()
    {
        $valData = ([
            'cName' => ['label' => 'Şirket Adı', 'rules' => 'required'],
            'cUrl' => ['label' => 'Site Linki', 'rules' => 'required|valid_url'],
            'cAddress' => ['label' => 'Şirket Adresi', 'rules' => 'required'],
            'cPhone' => ['label' => 'Şirket Telefonu', 'rules' => 'required'],
            'cMail' => ['label' => 'Şirket Maili', 'rules' => 'required|valid_email'],
        ]);

        if (!empty($this->request->getPost('cSlogan')))
            $valData['cSlogan'] = ['label' => 'Slogan', 'rules' => 'required'];
        if (!empty($this->request->getPost('cGSM')))
            $valData['cGSM'] = ['label' => 'Şirket GSM', 'rules' => 'required'];
        if (!empty($this->request->getPost('cMap')))
            $valData['cMap'] = ['label' => 'Google Map iframe linki', 'rules' => 'required'];
        if ($this->request->getFile('cLogo')->isValid() == true)
            $valData['cLogo'] = ['label' => 'Şirket Logosu', 'rules' => 'uploaded[cLogo]|max_size[cLogo,2048]|is_image[cLogo]'];

        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $data = ['siteName' => $this->request->getPost('cName'),
            'siteURL' => $this->request->getPost('cUrl'),
            'companyAddress' => $this->request->getPost('cAddress'),
            'companyPhone' => $this->request->getPost('cPhone'),
            'companyEMail' => $this->request->getPost('cMail')
        ];
        if (!empty($this->request->getPost('cSlogan')))
            $data['slogan'] = $this->request->getPost('cSlogan');
        if (!empty($this->request->getPost('cGSM')))
            $data['companyGSM'] = $this->request->getPost('cGSM');
        if (!empty($this->request->getPost('cMap')))
            $data['map_iframe'] = $this->request->getPost('cMap');

        $settings = $this->commonModel->getOne('settings');
        $result = $this->commonModel->updateOne('settings', ['_id' => new ObjectId($settings->_id)], $data);
        //logo günceleme
        if ($this->request->getFile('cLogo')->isValid() == true) {
            if (!empty($settings->logo)) {
                helper('filesystem');
                if (delete_files(WRITEPATH . 'uploads/' . $settings->logo))
                    log_message('notice', 'eski logo silindi.');
                else
                    log_message('error', 'eski logo silinemedi.');
            }

            $file = $this->request->getFile('cLogo');
            $fResult = $file->move(WRITEPATH . 'uploads');
            if ($fResult === true)
                $result = $this->commonModel->updateOne('settings', ['_id' => new ObjectId($settings->_id)], ['logo' => $file->getName()]);
            else
                return redirect()->back()->with('message', 'Şirket logoso Güncellenemedi.');
        }

        if ((bool)$result === false)
            return redirect()->back()->withInput()->with('error', 'Şirket Bilgileri Güncellenemedi.');
        else
            return redirect()->back()->with('message', 'Şirket Bilgileri Güncellendi.');
    }

    public function socialMediaPost()
    {
        $valData = (['socialNetwork' => ['label' => 'Sosyal medya adı veya linki boş bırakılamaz', 'rules' => 'required']]);
        $error = [];
        $socialNetwork = $this->request->getPost('socialNetwork');
        foreach ($socialNetwork as $key => $item) {
            $socialNetwork[$key]['link'] = trim($item['link']);
            $socialNetwork[$key]['smName'] = strtolower(trim($item['smName']));
            if (filter_var($item['link'], FILTER_VALIDATE_URL) === false) {
                $error['link'] = 'Sosyal Medya Linki URL olmalıdır !';
                unset($socialNetwork[$key]);
            }
            if (!empty($error))
                return redirect()->back()->withInput()->with('errors', $error);
            if (!is_string($item['smName'])) {
                $error['snName'] = 'Sosyal Medya Adı yazı değeri olmalıdır !';
                unset($socialNetwork[$key]);
            }
            if (empty($item['link']) || empty($item['smName'])) {
                $error = ['Sosyal Medya Adı boş bırakılamaz !'];
                unset($socialNetwork[$key]);
            }
        }

        if (!empty($error))
            return redirect()->back()->withInput()->with('errors', $error);
        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $settings = $this->commonModel->getOne('settings');
        $result = $this->commonModel->updateOne('settings', ['_id' => new ObjectId($settings->_id)], ['socialNetwork' => $socialNetwork]);

        if ((bool)$result === false)
            return redirect()->back()->withInput()->with('error', 'Şirket Sosyal Medya Bilgileri Güncellenemedi.');
        else
            return redirect()->back()->with('message', 'Şirket Sosyal Medya Bilgileri Güncellendi.');
    }

    public function mailSettingsPost()
    {
        $valData = [
            'mServer' => ['label' => 'Mail Server', 'rules' => 'required'],
            'mPort' => ['label' => 'Mail Port', 'rules' => 'required|is_natural_no_zero'],
            'mAddress' => ['label' => 'Mail Adresi', 'rules' => 'required|valid_email'],
            'mPwd' => ['label' => 'Mail Şifresi', 'rules' => 'required']
        ];

        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $data = ['mailServer' => $this->request->getPost('mServer'),
            'mailPort' => $this->request->getPost('mPort'),
            'mailAddress' => $this->request->getPost('mAddress'),
            'mailPassword' => $this->request->getPost('mPwd'),
            'mailProtocol'=>$this->request->getPost('mProtocol'),
            'mailTLS' => false];
        if ($this->request->getPost('mTls'))
            $data['mailTLS'] = true;
        $settings = $this->commonModel->getOne('settings');
        $result = $this->commonModel->updateOne('settings', ['_id' => new ObjectId($settings->_id)], $data);
        if ((bool)$result === false)
            return redirect()->back()->withInput()->with('error', 'Şirket Sosyal Medya Bilgileri Güncellenemedi.');
        else
            return redirect()->back()->with('message', 'Şirket Sosyal Medya Bilgileri Güncellendi.');
    }

    public function loginSettingsPost(){
        $valData = [
            'loginBlockMin' => ['label' => 'Engellme Süresi', 'rules' => 'required|is_natural_no_zero|less_than[180]|greater_than[10]'],
            'loginCounter' => ['label' => 'Deneme Sayısı', 'rules' => 'required|is_natural_no_zero|less_than[20]|greater_than[2]'],
        ];

        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $data = [
            'loginBlockIsActive' => ($this->request->getPost('loginIsActive') == 'on') ? true : false,
            'loginBlockMin' => $this->request->getPost('loginBlockMin'),
            'loginBlockAttemptsCounter' => $this->request->getPost('loginCounter'),
        ];
        $settings = $this->commonModel->getOne('settings');
        $result = $this->commonModel->updateOne('settings', ['_id' => new ObjectId($settings->_id)], $data);
        if ((bool)$result === false)
            return redirect()->back()->withInput()->with('error', 'Şirket Sosyal Medya Bilgileri Güncellenemedi.');
        else
            return redirect()->back()->with('message', 'Şirket Sosyal Medya Bilgileri Güncellendi.');
    }
}
