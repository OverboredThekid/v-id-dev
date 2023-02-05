<?php

namespace App\Http\Livewire;

use App\Models\staff;
use App\Models\staff_prints;
use Livewire\WithFileUploads;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Livewire\TemporaryUploadedFile;


class StaffWizard extends Component
{

    use WithFileUploads;

    public $currentStep = 1;
    public $name, $email, $phone, $file, $is_active, $id_count;
    public $successMessage = '';
    public $url;
    public $imageData;

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $this->currentStep = 2;
        $this->successMessage = '';
    }

    public function sendBase64Image($data)
    {
        $this->imageData = $data;
        $this->currentStep = 3;
    }

    private function saveStaffData()
    {
        $staff = staff::firstOrCreate(['email' => $this->email], [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => '1',
        ]);
    
        $staff->refresh();
        $staff->id_count = $staff->id_count + 1;
        $staff->save();

        $staff_prints = new staff_prints;
        $staff_prints->is_active = '0';
        $staff_prints->addMediaFromBase64($this->imageData)->toMediaCollection('staff_print');
        $staff->staff_prints()->save($staff_prints);
    
        $this->successMessage = 'ID Created Successfully.';
        $this->clearForm();
        $this->currentStep = 1;
    
        return $staff_prints;
    }
    


    public function submitForm()
    {
        $staff_prints = $this->saveStaffData();
    }

    public function is_loggedin()
    {
        $staff_prints = $this->saveStaffData(1);

        // Open the new DB entry in a new tab
        $this->url = route('svg', $staff_prints->staff->id);

        // Get the URL of the new DB entry
        $url = route('svg', $staff_prints->id);

        // Open the URL in a new tab
        $this->dispatchBrowserEvent('open-new-tab', $url);
    }




    public function back($step)
    {
        $this->currentStep = $step;
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
