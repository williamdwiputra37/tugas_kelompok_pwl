<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblBookCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_book_category' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'isbn' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'id_category' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addPrimaryKey('id_book_category', true);
        $this->forge->addForeignKey('isbn', 'tbl_book', 'isbn', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_category', 'tbl_category', 'id_category', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_book_category');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_book_category');
    }
}
