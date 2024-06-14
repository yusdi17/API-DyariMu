<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserProfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'nama_depan' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'nama_belakang' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'profile_picture' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_profile');
    }

    public function down()
    {
        $this->forge->dropTable('user_profile');
    }
}
