<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\TransactionGroupModel;
use Exception;

class TransactionGroups extends BaseController {
    /**
     * @var TransactionGroupModel
     */
    private TransactionGroupModel $transactionGroupModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->transactionGroupModel = new TransactionGroupModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.TransactionGroups.Titles.Index')),
            'elements' => $this->transactionGroupModel->findAll()
        ];

        return view('Templates/Header', $data)
             . view('TransactionGroups/Index')
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
                if ($this->transactionGroupModel->insert($formData)) {
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

        return redirect()->route('transaction-groups');
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
                if ($this->transactionGroupModel->update($id, $formData)) {
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

        return redirect()->route('transaction-groups');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->transactionGroupModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Modules::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('transaction-groups');
    }

    /**
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->transactionGroupModel->find($id));
    }
}
