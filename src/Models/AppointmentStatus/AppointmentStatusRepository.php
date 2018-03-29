<?php

namespace Application\Models\AppointmentStatus;

use Application\Models\BaseRepository;

class AppointmentStatusRepository extends BaseRepository
{
    CONST TYPE_NOBODY = 0;

    CONST TYPE_LAWYER = 1;

    CONST TYPE_BOTH = 2;

    CONST NAME_AWAITING = 'awaiting';

    CONST NAME_APPROVED = 'approved';

    CONST NAME_MODIFIED = 'modified';

    CONST NAME_CANCEL = 'cancel';

    protected $table = 'appointment_statuses';

    protected $primaryKey = 'status_id';

    protected $entityClass = AppointmentStatusEntity::class;

    public function findByName($name = self::NAME_CANCEL)
    {
        $this->query = 'SELECT *
            FROM '. $this->table.
            ' where system_name = :name';

    return $this->run(['name' => $name])->fetchObject($this->entityClass);
    }

    public function forLawyer()
    {
        // to do
    }
}
