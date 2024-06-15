<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostLike extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'post_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('post_id', 'user_post', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('post_like');
    }

    public function down()
    {
        $this->forge->dropTable('post_like');
    }
}