<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UserProfile;

class Profile extends BaseController
{
    use ResponseTrait;

    public function create()
    {
        $validation = \Config\Services::validation();
        $request = $this->request;
        $rules = [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'bio' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Get user ID from authentication or session, for example
        $userId = 1; // Replace with your actual logic to get user ID

        // Prepare data to insert into database
        $data = [
            'user_id' => $userId,
            'nama_depan' => $request->getPost('nama_depan'),
            'nama_belakang' => $request->getPost('nama_belakang'),
            'bio' => $request->getPost('bio'),
        ];

        // Save data to database
        $userProfileModel = new UserProfile();
        $userProfileModel->insert($data);

        // Respond with success message or data
        return $this->respondCreated(['message' => 'Profile created successfully']);
    }

    public function show($userId)
    {
        $userProfileModel = new UserProfile();
        $profile = $userProfileModel->where('user_id', $userId)->first();

        if ($profile) {
            $data = [
                'nama_depan' => $profile['nama_depan'],
                'nama_belakang' => $profile['nama_belakang'],
                'bio' => $profile['bio'],
            ];

            // Mengembalikan respons JSON
            return $this->respond($data);
        } else {
            return $this->failNotFound('Profile not found');
        }
    }
}