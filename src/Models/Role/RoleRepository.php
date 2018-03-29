<?php

namespace Application\Models\Role;


use Application\Models\BaseRepository;

class RoleRepository extends BaseRepository
{
    protected $table = 'roles';

    protected $primaryKey = 'role_id';
}
