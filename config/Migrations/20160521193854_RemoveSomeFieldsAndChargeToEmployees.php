<?php
use Migrations\AbstractMigration;

class RemoveSomeFieldsAndChargeToEmployees extends AbstractMigration
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
        $table = $this->table('employees');
        $table->removeColumn('username');
        $table->removeColumn('password');
        $table->removeColumn('email');
        $table->removeColumn('name');
        $table->addColumn('charge', 'string', [
           'default' => null,
           'limit' => 255,
           'null' => false,
       ])
       ->update();
    }
}
