<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionTypeModel extends Model {
    protected $table            = 'TransactionTypes';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Name',
        'Description',
        'Deleted'
    ];
}
