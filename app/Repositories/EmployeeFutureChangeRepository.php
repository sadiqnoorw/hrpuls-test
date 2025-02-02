<?php

namespace App\Repositories;

use App\Models\EmployeeFutureChange;

class EmployeeFutureChangeRepository implements EmployeeFutureChangeRepositoryInterface
{
    public function create(array $data): EmployeeFutureChange
    {
        return EmployeeFutureChange::create($data);
    }
}
