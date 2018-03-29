<?php
namespace Application\Models\AppointmentHour;

use Application\Models\BaseRepository;

class AppointmentHourRepository extends BaseRepository
{
    protected $table = 'appointment_slots';

    protected $primaryKey = 'hour_id';

    protected $entityClass = AppointmentHourEntity::class;

}
