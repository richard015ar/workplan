<?php
use Migrations\AbstractMigration;

class DeleteLastLoginFromAdministratorsAndEmployees extends AbstractMigration
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
        $table->removeColumn('last_login');
        $table->update();
    }
}
