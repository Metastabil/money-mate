<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table            = 'Users';
    protected $primaryKey       = 'ID';
    protected $allowedFields    = [
        'Username',
        'Password',
        'RoleID',
        'Deleted'
    ];
}
