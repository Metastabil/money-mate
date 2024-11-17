<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\UserModel;
use Exception;

class Users extends BaseController {
    /**
     * @var UserModel
     */
    private UserModel $userModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->userModel = new UserModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.Users.Titles.Index')),
            'elements' => $this->userModel->findAll()
        ];

        return view('Templates/Header', $data)
             . view('Users/Index')
             . view('Templates/Footer');
    }

    /**
     * @return RedirectResponse
     */
    public function create() :RedirectResponse {
        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if ($this->validate($validationRules)) {
            $formData = [
                'Username' => esc($this->request->getPost('username')),
                'Password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'RoleID' => (int)$this->request->getPost('role')
            ];

            try {
                if ($this->userModel->insert($formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in Users::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('users');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function update(int $id) :RedirectResponse {
        $validationRules = [
            'username' => 'required'
        ];

        if ($this->validate($validationRules)) {
            $formData = [
                'Username' => esc($this->request->getPost('username')),
                'Password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'RoleID' => (int)$this->request->getPost('role')
            ];

            try {
                if ($this->userModel->update($id, $formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in Users::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('users');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->userModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Users::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('users');
    }

    /**
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->userModel->find($id));
    }
}
