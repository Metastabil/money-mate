<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ModuleModel;
use Exception;

class Modules extends BaseController {
    /**
     * @var ModuleModel
     */
    private ModuleModel $moduleModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->moduleModel = new ModuleModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.Users.Titles.Index')),
            'elements' => $this->moduleModel->findAll()
        ];

        return view('Templates/Header', $data)
             . view('Modules/Index')
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
                'Description' => esc($this->request->getPost('description')),
                'Enabled' => (bool)$this->request->getPost('enabled')
            ];

            try {
                if ($this->moduleModel->insert($formData)) {
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

        return redirect()->route('modules');
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
                'Description' => esc($this->request->getPost('description')),
                'Enabled' => (bool)$this->request->getPost('enabled')
            ];
            try {
                if ($this->moduleModel->update($id, $formData)) {
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

        return redirect()->route('modules');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->moduleModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Modules::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('modules');
    }

    /**
     * Called by JavaScript fetch request
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->moduleModel->find($id));
    }
}
