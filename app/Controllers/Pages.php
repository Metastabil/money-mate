<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\UserModel;
use Exception;

class Pages extends BaseController {
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();

        service('request')->setLocale('de');
    }

    public function login() :RedirectResponse|string {
        $data = [
            'title' => esc(lang('App.DE.Pages.Titles.Login'))
        ];

        $validationRules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if ($this->validate($validationRules)) {
            $username = esc($this->request->getPost('username'));
            $password = $this->request->getPost('password');
            $user = $this->userModel->where('username', $username)->first();

            if (!empty($user) && password_verify($password, $user['Password'])) {
                $this->session->set('user', [
                    'id' => $user['ID'],
                    'username' => $user['Username']
                ]);

                return redirect()->route('transactions');
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.UnknownCredentials')));

            return redirect()->route('login');
        }

        return view('Pages/Login', $data);
    }
}