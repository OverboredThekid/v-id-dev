<?php

namespace App\Http\Livewire;

use App\Models\staff;
use App\Models\staff_prints;
use Livewire\WithFileUploads;
use Livewire\Component;

class StaffWizard extends Component
{

    use WithFileUploads;

    public $currentStep = 1;
    public $name, $email, $phone, $file, $is_active;
    public $successMessage = '';


    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:staff',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $this->currentStep = 2;
    }


    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'file' => 'required|image|max:5000',
        ]);

        $validatedData['name'] = $this->file->store('files', 'public');
        session()->flash('message', 'File successfully Uploaded.');

        $this->currentStep = 3;
    }


    public function submitForm()
    {
        $staffing = request()->file('file')->store('temp');
        $staff_prints = new staff_prints;
        $staff_prints->is_active = '0';
        $staff_prints->addMedia($this->file)->toMediaCollection('staff_print');

        staff::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => '1',
        ])->staff_prints()->save($staff_prints);



        $this->successMessage = 'ID Created Successfully.';

        $this->clearForm();

        $this->currentStep = 1;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function is_loggedin()
    {
        $staff_prints = new staff_prints;
        $staff_prints->is_active = '1';
        $staff_prints->addMedia($this->file)->toMediaCollection('staff_print');

        staff::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => '1',
        ])->staff_prints()->save($staff_prints);



        $this->successMessage = 'ID Created Successfully and Printed.';

        $this->clearForm();

        $this->currentStep = 1;

        // Open the new DB entry in a new tab
        $url = route('svg', $staff_prints->id);
        echo "<script>window.open('$url', '_blank');</script>";
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->file = '';
    }


    public function render()
    {
        return view('livewire.staff-wizard')->layout('layouts.wizard');
    }
}
