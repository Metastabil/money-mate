<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\TransactionTypeModel;
use Exception;

class TransactionTypes extends BaseController {
    /**
     * @var TransactionTypeModel
     */
    private TransactionTypeModel $transactionTypeModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->transactionTypeModel = new TransactionTypeModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.TransactionTypes.Titles.Index')),
            'elements' => $this->transactionTypeModel->findAll()
        ];

        return view('Templates/Header', $data)
             . view('TransactionTypes/Index')
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
                if ($this->transactionTypeModel->insert($formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in TransactionTypes::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('transaction-types');
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
                if ($this->transactionTypeModel->update($id, $formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in TransactionTypes::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('transaction-types');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->transactionTypeModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Transactions::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('transaction-types');
    }

    /**
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->transactionTypeModel->find($id));
    }
}
