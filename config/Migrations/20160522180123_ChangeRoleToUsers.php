<?php
use Migrations\AbstractMigration;

class ChangeRoleToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('role', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->removeColumn('role_id');
        $table->update();
    }
}
