<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPost extends Models
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_post';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\UserPost';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'diary',
        'judul',
        'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id' => 'required|integer',
        'diary' => 'required|string',
        'judul' => 'required|string|max_length[255]',
    ];
    protected $validationMessages   = [
        'user_id' => [
            'required' => 'User ID diperlukan.',
            'integer' => 'User ID harus berupa angka.',
        ],
        'diary' => [
            'required' => 'Tulis cerita anda!',
        ],
        'judul' => [
            'required' => 'Judul diperlukan.',
            'max_length' => 'Judul tidak boleh lebih dari 255 karakter.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

}
