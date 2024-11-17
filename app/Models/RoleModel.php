<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model {
    protected $table            = 'Roles';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Name',
        'Description',
        'Deleted'
    ];
}
