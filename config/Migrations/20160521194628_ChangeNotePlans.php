<?php
use Migrations\AbstractMigration;

class ChangeNotePlans extends AbstractMigration
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
        $table = $this->table('note_plans');
        $table->addColumn('plan_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->removeColumn('id_plan');
        $table->update();
    }
}
