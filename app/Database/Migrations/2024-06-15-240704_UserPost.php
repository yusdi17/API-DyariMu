<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPost extends Migration
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
            'diary' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_post');
    }

    public function down()
    {
        $this->forge->dropTable('user_post');
    }
}
