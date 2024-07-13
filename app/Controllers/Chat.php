<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Chat extends ResourceController
{
    protected $modelName="App\Models\ModelChat";
    protected $format="json";

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->fail("Data tidak ditemukan");
        }
        return $this->respond($this->model->find($id));
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        log_message('info', 'Data received: ' . json_encode($data)); // Tambahkan log ini untuk memeriksa data yang diterima
        $chat = new \App\Entities\Chat();
        $chat->fill($data);
    
        if(!$this->validate($this->model->validationRules, $this->model->validationMessages)) {
            return $this->fail($this->validator->getErrors());
        }
        
        if ($this->model->save($chat)) {
            return $this->respondCreated($data, "Pesan Berhasil Dikirim");
        } else {
            return $this->fail('Gagal menyimpan data');
        }
    }

    public function update($id = null)
    {
        //
    }

    public function delete($id = null)
    {

    }
}