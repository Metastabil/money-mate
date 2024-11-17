<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\RoleModel;
use Exception;

class Roles extends BaseController {
    /**
     * @var RoleModel
     */
    private RoleModel $roleModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->roleModel = new RoleModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.Roles.Titles.Index')),
            'elements' => $this->roleModel->findAll()
        ];

        return view('Templates/Header', $data)
             . view('Roles/Index')
             . view('Templates/Footer');
    }

    /**
     * @return RedirectResponse
     */
    public function create() :RedirectResponse {
        $validationRules = [ 'name' => 'required' ];

        if ($this->validate($validationRules)) {
            $formData = [
                'Name' => esc($this->request->getPost('name')),
                'Description' => esc($this->request->getPost('description'))
            ];

            try {
                if ($this->roleModel->insert($formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in Modules::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('roles');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function update(int $id) :RedirectResponse {
        $validationRules = [ 'name' => 'required' ];

        if ($this->validate($validationRules)) {
            $formData = [
                'Name' => esc($this->request->getPost('name')),
                'Description' => esc($this->request->getPost('description'))
            ];
            try {
                if ($this->roleModel->update($id, $formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in Modules::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('roles');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->roleModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Modules::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('roles');
    }

    /**
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->roleModel->find($id));
    }
}
