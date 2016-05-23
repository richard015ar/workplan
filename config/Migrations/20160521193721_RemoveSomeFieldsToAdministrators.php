<?php
use Migrations\AbstractMigration;

class RemoveSomeFieldsToAdministrators extends AbstractMigration
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
        $table = $this->table('administrators');
        $table->removeColumn('username');
        $table->removeColumn('password');
        $table->removeColumn('email');
        $table->removeColumn('name');
    }
}
