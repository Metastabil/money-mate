<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model {
    protected $table            = 'Modules';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Name',
        'Description',
        'Enabled',
        'Deleted'
    ];
}
