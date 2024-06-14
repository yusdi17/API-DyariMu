<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'created_by_user_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'post_id' => [
                'type' => 'INT',
                'usigned' => true,
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);


        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('created_by_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('post_id', 'user_post', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('comment');
    }

    public function down()
    {
        $this->forge->dropTable('comment');
    }
}
