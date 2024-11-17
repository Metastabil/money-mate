<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionGroupModel extends Model{
    protected $table            = 'TransactionGroups';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Name',
        'Description',
        'Deleted'
    ];
}
