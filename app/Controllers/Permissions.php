<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\PermissionModel;
use Exception;

class Permissions extends BaseController {
    /**
     * @var PermissionModel
     */
    private PermissionModel $permissionModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->permissionModel = new PermissionModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.Permissions.Titles.Index')),
            'elements' => $this->permissionModel->findAll()
        ];

        return view('Templates/Header', $data)
             . view('Permissions/Index')
             . view('Templates/Footer');
    }

    /**
     * @return RedirectResponse
     */
    public function create() :RedirectResponse {
        $formData = [
            'Read' => (bool)$this->request->getPost('read'),
            'Write' => (bool)$this->request->getPost('write'),
            'ModuleID' => (int)$this->request->getPost('module'),
            'RoleID' => (int)$this->request->getPost('role')
        ];

        try {
            if ($this->permissionModel->insert($formData)) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Modules::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('permissions');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function update(int $id) :RedirectResponse {
        $formData = [
            'Read' => (bool)$this->request->getPost('read'),
            'Write' => (bool)$this->request->getPost('write'),
            'ModuleID' => (int)$this->request->getPost('module'),
            'RoleID' => (int)$this->request->getPost('role')
        ];

        try {
            if ($this->permissionModel->update($id, $formData)) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Modules::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('permissions');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->permissionModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Modules::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('permissions');
    }

    /**
     * Called by JavaScript fetch request
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->permissionModel->find($id));
    }
}
