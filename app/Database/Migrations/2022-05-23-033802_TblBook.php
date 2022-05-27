<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblBook extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'isbn' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unsigned' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'unsigned' => true,
            ],
            'cover' => [
                'type' => 'TEXT',
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'DOUBLE',
            ],
            'quantity' => [
                'type' => 'INT',
                'constaint' => 11,
            ]
        ]);
        $this->forge->addPrimaryKey('id_book', true);
        $this->forge->createTable('tbl_book');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_book');
    }
}
