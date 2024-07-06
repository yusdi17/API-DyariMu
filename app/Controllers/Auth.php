<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class Auth extends ResourceController
{
    protected $modelName = "App\Models\UserModel";
    protected $format    = "json";
    use ResponseTrait;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        $model = new UserModel();

        // Ambil data dari request POST
        $data = $this->request->getPost();

        // Buat instance entity User dan isi dengan data dari request
        $user = new \App\Entities\User();
        $user->fill($data);

        // Validasi data
        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Simpan data ke dalam database menggunakan model
        if ($model->save($user)) {
            // Ambil user_id dari pengguna yang baru terdaftar
            $userId = $model->insertID();

            // Simpan user_id di sesi
            session()->set('user_id', $userId);

            return $this->respondCreated($user, 'Pendaftaran berhasil');
        } else {
            return $this->failServerError('Gagal menyimpan data');
        }
    }

    public function login()
{
    // Ambil data dari request POST
    $data = $this->request->getPost();

    // Validasi data
    if (!$this->validate([
        'username' => 'required',
        'password' => 'required'
    ])) {
        return $this->failValidationErrors($this->validator->getErrors());
    }

    // Ambil username dan password dari data POST
    $username = $data['username'];
    $password = $data['password'];

    // Cari user berdasarkan username
    $user = $this->userModel->where('username', $username)->first();

    // Jika user tidak ditemukan
    if (!$user) {
        return $this->failNotFound('User not found');
    }

    // Verifikasi password (tanpa hashing)
    if ($password !== $user->password) {
        return $this->failUnauthorized('Invalid password');
    }

    $session = session();
    $session->set('user_id', $user->id);


    // Jika berhasil, siapkan data response
    $responseData = [
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email,
        'created_at' => $user->created_at
        // Tambahan data lain yang diperlukan
    ];

    return $this->respond($responseData, ResponseInterface::HTTP_OK);
}


    
}
