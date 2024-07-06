<?php

namespace App\Models;

use CodeIgniter\Model;

class Comment extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'comment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\Comment';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'created_by_user_id',
        'post_id',
        'comment',
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
        'post_id' => 'required|integer',
        'created_by_user_id' => 'required|integer',
        'comment' => 'required|string',
    ];
    protected $validationMessages   = [
        'comment' => [
            'required' => 'Tulis Komentar Anda!'
        ]
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