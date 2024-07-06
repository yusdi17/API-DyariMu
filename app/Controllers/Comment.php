<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Comment;

class CommentController extends BaseController
{
    use ResponseTrait;

    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment();
    }

    // Mengambil semua komentar berdasarkan post_id
    public function index($postId)
    {
        $comments = $this->commentModel->where('post_id', $postId)->findAll();
        return $this->respond($comments, 200);
    }

    // Menambahkan komentar baru
    public function create()
    {
        $data = $this->request->getJSON();
        $insertData = [
            'created_by_user_id' => $data->created_by_user_id,
            'post_id' => $data->post_id,
            'comment' => $data->comment,
        ];

        $this->commentModel->insert($insertData);
        return $this->respondCreated(['message' => 'Comment added successfully']);
    }

    // Mengupdate komentar
    public function update($id)
    {
        $data = $this->request->getJSON();
        $updateData = [
            'comment' => $data->comment,
        ];

        $this->commentModel->update($id, $updateData);
        return $this->respond(['message' => 'Comment updated successfully'], 200);
    }

    // Menghapus komentar
    public function delete($id)
    {
        $this->commentModel->delete($id);
        return $this->respondDeleted(['message' => 'Comment deleted successfully']);
    }
}