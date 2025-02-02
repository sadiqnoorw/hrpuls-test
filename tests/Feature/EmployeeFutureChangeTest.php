<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Repositories\EmployeeFutureChangeRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EmployeeFutureChangeTest extends TestCase
{
    use RefreshDatabase;

    protected $employee;
    protected $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a fake employee
        $this->employee = Employee::factory()->create();
        
        // Mock repository
        $this->repositoryMock = $this->mock(EmployeeFutureChangeRepositoryInterface::class);
    }

    #[Test]
    public function it_shows_the_future_change_form()
    {
        $response = $this->get(route('future-changes.create', $this->employee->id));
        
        $response->assertStatus(200);
        $response->assertViewIs('future-change-form');
        $response->assertViewHas('employee', $this->employee);
    }

    #[Test]
    public function it_stores_a_future_change_successfully()
    {
        $this->repositoryMock->shouldReceive('create')->once();
        
        $response = $this->post(route('future-changes.store', $this->employee->id), [
            'name' => 'Updated Name',
            'email' => 'newemail@example.com',
            
            'address' => 'New Address',
            'title' => 'New Title',
            'effective_date' => now()->addDays(5)->toDateString(),
        ]);

        $response->assertRedirect(route('employees'));
        $response->assertSessionHas('success', 'Future change scheduled successfully.');
    }

    #[Test]
    public function it_returns_an_error_if_no_changes_are_made()
    {
        $response = $this->post(route('future-changes.store', $this->employee->id), [
            'name' => $this->employee->name,
            'email' => $this->employee->email,
            'telephone' => $this->employee->telephone,
            'address' => $this->employee->address,
            'title' => $this->employee->title,
            'effective_date' => now()->addDays(5)->toDateString(),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'No changes detected. Please modify at least one field.');
    }
}