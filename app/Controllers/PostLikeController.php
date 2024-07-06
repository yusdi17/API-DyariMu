<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class PostLikeController extends ResourceController
{
    protected $modelName = 'App\Models\Like';
    protected $format    = 'json';

    public function likePost()
    {
        $post_id = $this->request->getPost('post_id');
        $user_id = $this->request->getPost('user_id');

        if (!$this->validate([
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
        ])) {
            return $this->fail($this->validator->getErrors());
        }

        $likeData = [
            'post_id' => $post_id,
            'user_id' => $user_id,
        ];

        if ($this->model->where($likeData)->first()) {
            return $this->fail('Sudah Memberikan Like');
        }

        $this->model->save($likeData);
        return $this->respondCreated(['message' => 'Berhasil Memberikan Like']);
    }
}