<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model {
    protected $table            = 'Permissions';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Read',
        'Write',
        'ModuleID',
        'RoleID',
        'Deleted'
    ];
}
