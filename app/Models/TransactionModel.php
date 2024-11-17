<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model {
    protected $table            = 'Transactions';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Date',
        'Annotation',
        'TransactionTypeID',
        'TransactionGroupID',
        'UserID',
        'Deleted'
    ];
}
