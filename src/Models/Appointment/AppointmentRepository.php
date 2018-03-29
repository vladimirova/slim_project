<?php

namespace Application\Models\Appointment;

use Application\Models\BaseRepository;
use Application\Models\AppointmentStatus\AppointmentStatusRepository;

class AppointmentRepository extends BaseRepository
{
    protected $table = 'appointments';

    protected $primaryKey = 'appointment_id';

    protected $entityClass = AppointmentEntity::class;

    public function fetchByUser($id)
    {
        $result = [];

        $this->query = 'SELECT a.*, h.*, s.*, u.*
            FROM appointments a 
            JOIN appointment_statuses s
            on a.status_id = s.status_id
            JOIN appointment_slots h
            on a.hour_id = h.hour_id
            JOIN users u
            on a.lawyer_id = u.user_id
            where a.user_id = :user';

        $statement = $this->run(['user' => $id]);

        while (($row = $statement->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $result[] = new $this->entityClass($row);
        }

        return $result;
    }

    public function checkIfExists($appointment)
    {
        $result = [];

        $this->query = 'SELECT *
            FROM '. $this->table. ' a 
            JOIN appointment_statuses s
            ON a.status_id = s.status_id 
            WHERE lawyer_id = :lawyer_id
            AND hour_id = :hour_id
            AND date = :date
            AND s.system_name != :status';

        $statement = $this->run([
            'lawyer_id' => $appointment->getLawyerId(),
            'hour_id' => $appointment->getHourId(),
            'date' => $appointment->getDate(),
            'status' => AppointmentStatusRepository::NAME_CANCEL,
        ]);

        while (($row = $statement->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $result[] = new $this->entityClass($row);
        }

        return $result;
    }

    public function fetchByLawyer($id)
    {
        $result = [];

        $this->query = 'SELECT a.*, h.*, s.*, u.*
            FROM appointments a
            JOIN appointment_statuses s
            on a.status_id = s.status_id
            JOIN appointment_slots h
            on a.hour_id = h.hour_id
            JOIN users u
            on a.user_id = u.user_id
            where a.lawyer_id = :lawyer';

        $statement = $this->run(['lawyer' => $id]);

        while (($row = $statement->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $result[] = new $this->entityClass($row);
        }

        return $result;
    }
}
