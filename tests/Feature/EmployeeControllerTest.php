<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Employee;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_employee_list()
    {
        Employee::factory()->count(3)->create();

        $response = $this->get(route('employees'));

        $response->assertStatus(200);
        $response->assertViewIs('employees');
        $response->assertViewHas('employees');
    }

    public function test_it_shows_create_employee_form()
    {
        $response = $this->get(route('employees.create'));

        $response->assertStatus(200);
        $response->assertViewIs('employee-form');
    }

    public function test_it_can_create_an_employee()
    {
        $employeeData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'telephone' => '1234567890',
            'address' => '123 Main St',
            'title' => 'Software Engineer',
        ];

        $response = $this->post(route('employees.store'), $employeeData);

        $response->assertRedirect(route('employees'));
        $this->assertDatabaseHas('employees', ['email' => 'johndoe@example.com']);
    }

    public function test_it_shows_edit_employee_form()
    {
        $employee = Employee::factory()->create();

        $response = $this->get(route('employees.edit', $employee->id));

        $response->assertStatus(200);
        $response->assertViewIs('employee-form');
        $response->assertViewHas('employee');
    }

    public function test_it_can_update_an_employee()
    {
        $employee = Employee::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);

        $updatedData = [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'telephone' => '9876543210',
            'address' => '456 Another St',
            'title' => 'Senior Developer',
        ];

        $response = $this->put(route('employees.update', $employee->id), $updatedData);

        $response->assertRedirect(route('employees'));
        $this->assertDatabaseHas('employees', ['email' => 'new@example.com']);
    }

    public function test_it_can_delete_an_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->delete(route('employees.destroy', $employee->id));

        $response->assertJson(['success' => true]);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}