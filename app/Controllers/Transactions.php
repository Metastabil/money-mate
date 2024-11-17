<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\TransactionModel;
use Exception;

class Transactions extends BaseController {
    /**
     * @var TransactionModel
     */
    private TransactionModel $transactionModel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->transactionModel = new TransactionModel();

        service('request')->setLocale('de');
    }

    /**
     * @return string
     */
    public function index() :string {
        $data = [
            'title' => esc(lang('App.DE.Transactions.Titles.Index')),
            'elements' => $this->transactionModel->findAll()
        ];

        return view('Templates/Header', $data)
            . view('Transactions/Index')
            . view('Templates/Footer');
    }

    /**
     * @return RedirectResponse
     */
    public function create() :RedirectResponse {
        $validationRules = [ 'date' => 'required' ];

        if ($this->validate($validationRules)) {
            $formData = [
                'Date' => esc($this->request->getPost('name')),
                'Annotation' => esc($this->request->getPost('description')),
                'TransactionTypeID' => (int)$this->request->getPost('transaction-type'),
                'TransactionGroupID' => (int)$this->request->getPost('transaction-group'),
                'UserID' => (int)$this->session->get('user')['id']
            ];

            try {
                if ($this->transactionModel->insert($formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in Transactions::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('transactions');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function update(int $id) :RedirectResponse {
        $validationRules = [ 'date' => 'required' ];

        if ($this->validate($validationRules)) {
            $formData = [
                'Date' => esc($this->request->getPost('name')),
                'Annotation' => esc($this->request->getPost('description')),
                'TransactionTypeID' => (int)$this->request->getPost('transaction-type'),
                'TransactionGroupID' => (int)$this->request->getPost('transaction-group')
            ];

            try {
                if ($this->transactionModel->update($id, $formData)) {
                    $this->setMessage('success', esc(lang('App.DE.Messages.Saved')));
                }
            }
            catch (Exception $exception) {
                if (ENVIRONMENT !== 'production') {
                    die('Error in Transactions::create(); Message: ' . $exception->getMessage());
                }

                $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
            }
        }

        return redirect()->route('transactions');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id) :RedirectResponse {
        try {
            if ($this->transactionModel->update($id, ['Deleted' => 1])) {
                $this->setMessage('success', esc(lang('App.DE.Messages.Deleted')));
            }
        }
        catch (Exception $exception) {
            if (ENVIRONMENT !== 'production') {
                die('Error in Transactions::create(); Message: ' . $exception->getMessage());
            }

            $this->setMessage('error', esc(lang('App.DE.Messages.Error')));
        }

        return redirect()->route('transactions');
    }

    /**
     * @param int $id
     * @return void
     */
    public function getByID(int $id) :void {
        echo toJSON($this->transactionModel->find($id));
    }
}
