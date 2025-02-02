<?php

namespace Tests\Unit\Repositories;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EmployeeRepositoryTest extends TestCase
{
    use RefreshDatabase; // Ensures a clean database for each test

    protected EmployeeRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new EmployeeRepository();
    }

    #[Test]
    public function it_can_fetch_all_employees()
    {
        Employee::factory()->count(5)->create();

        $employees = $this->repository->all();

        $this->assertCount(5, $employees);
    }

    #[Test]
    public function it_can_paginate_employees()
    {
        Employee::factory()->count(15)->create();

        $paginated = $this->repository->paginate(5);

        $this->assertCount(5, $paginated);
        $this->assertTrue($paginated->hasMorePages());
    }

    #[Test]
    public function it_can_find_an_employee_by_id()
    {
        $employee = Employee::factory()->create();

        $found = $this->repository->find($employee->id);

        $this->assertNotNull($found);
        $this->assertEquals($employee->id, $found->id);
    }

    #[Test]
    public function it_returns_null_if_employee_not_found()
    {
        $found = $this->repository->find(999);

        $this->assertNull($found);
    }

    #[Test]
    public function it_can_create_an_employee()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'telephone' => '+1234567890',
            'address' => '123 Street, City',
            'title' => 'Software Engineer'
        ];

        $employee = $this->repository->create($data);

        $this->assertDatabaseHas('employees', $data);
        $this->assertInstanceOf(Employee::class, $employee);
    }

     #[Test]
    public function it_can_update_an_employee()
    {
        $employee = Employee::factory()->create([
            'name' => 'Old Name',
        ]);

        $updated = $this->repository->update($employee->id, ['name' => 'New Name']);

        $this->assertTrue($updated);
        $this->assertDatabaseHas('employees', ['id' => $employee->id, 'name' => 'New Name']);
    }

     #[Test]
    public function it_can_delete_an_employee()
    {
        $employee = Employee::factory()->create();

        $deleted = $this->repository->delete($employee->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}