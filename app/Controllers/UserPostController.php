<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserPost;
use CodeIgniter\API\ResponseTrait;

class UserPostController extends ResourceController
{
    protected $modelName = 'App\Models\UserPost';
    protected $format = 'json';

    use ResponseTrait;
    public function index()
    {
        $model = new UserPost();
        $data = $model->findAll();

        return $this->respond($data, 200);
    }

    public function create()
    {
        helper(['form', 'url']);

        $model = new UserPost();

        // Mengambil data dari request POST
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'diary' => $this->request->getPost('diary'),
            'judul' => $this->request->getPost('judul'),
        ];

        // Validasi data
        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Menyimpan data ke dalam database
        if ($model->save($data)) {
            return $this->respondCreated($data, 'Post berhasil dibuat');
        } else {
            return $this->failServerError('Gagal menyimpan data');
        }
    }

    public function getAllPosts()
{
    $model = new UserPost();
    $posts = $model->findAll();
    return $this->respond($posts);
}

public function delete($id = null)
{
    $model = new UserPost();

    if (!$model->find($id)) {
        return $this->failNotFound('Post not found');
    }

    $model->delete($id);

    return $this->respondDeleted(['message' => 'Post deleted successfully']);
}

public function update($id = null)
{
    $data = $this->request->getJSON(); // Mengambil data JSON dari body request

    // Validasi data
    if (!$this->validate([
        'judul' => 'required',
        'diary' => 'required'
    ])) {
        return $this->failValidationErrors($this->validator->getErrors());
    }

    // Pastikan postingan dengan $id ada dalam database
    $post = $this->model->find($id);
    if (!$post) {
        return $this->failNotFound('Postingan tidak ditemukan');
    }

    // Update data postingan
    $updatedData = [
        'judul' => $data->judul,
        'diary' => $data->diary
        // Tambahkan kolom lain yang perlu diupdate
    ];

    $this->model->update($id, $updatedData);

    return $this->respondUpdated([
        'message' => 'Postingan berhasil diperbarui',
        'data' => $updatedData
    ]);
}



}