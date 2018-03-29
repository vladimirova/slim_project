<?php

namespace Application\Models\User;


use Application\Models\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $entityClass = UserEntity::class;

    public function login($email, $password)
    {
        $this->query = 'SELECT * FROM '. $this->table. ' WHERE email = :email AND password = :password;';

        $statement = $this->run(compact('email', 'password'));

        return $statement->fetchObject(UserEntity::class);
    }

    public function lawyers()
    {
        $this->query = 'SELECT u.*, r.system_name
            FROM users u 
            JOIN roles r
            on u.role_id = r.role_id
            where r.system_name = :lawyer';

        $statement = $this->run(['lawyer' => 'lawyer']);

        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->entityClass);
    }
}
