<?php
use Migrations\AbstractMigration;

class AddUserToNotes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('note_employees');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->removeColumn('id_administrator');
        $table->update();

        $table = $this->table('note_items');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->removeColumn('administrator_id');
        $table->update();

        $table = $this->table('note_plans');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->removeColumn('id_administrator');
        $table->update();

        $table = $this->table('plans');
        $table->addColumn('employee_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->removeColumn('id_employee');
        $table->update();
    }
}
