<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_category' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('id_category', true);
        $this->forge->createTable('tbl_category');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_category');
    }
}
