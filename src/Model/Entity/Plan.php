<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity.
 *
 * @property int $id
 * @property int $state
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $employee_id
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Item[] $items
 * @property \App\Model\Entity\NotePlan[] $note_plans
 */
class Plan extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
