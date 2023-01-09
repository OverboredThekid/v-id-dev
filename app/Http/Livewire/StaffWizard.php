<?php

namespace App\Http\Livewire;

use App\Models\staff;
use App\Models\staff_prints;
use Livewire\WithFileUploads;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Livewire\TemporaryUploadedFile;


class StaffWizard extends Component
{

    use WithFileUploads;

    public $currentStep = 1;
    public $name, $email, $phone, $file, $is_active;
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

        // Convert the base64 data to a TemporaryUploadedFile object
        $file = Image::make($this->imageData)->encode('jpg');
        $temp_path = public_path('tmp/' . time() . '.jpg');
        $file->save($temp_path);
        $file = new TemporaryUploadedFile($temp_path, 'image.jpg', 'image/jpeg', null, true);

        $staff_prints = new staff_prints;
        $staff_prints->is_active = '0';
        $staff_prints->addMedia($file)->toMediaCollection('staff_print');

        staff::firstOrCreate([
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

        staff::firstOrCreate([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => '1',
        ])->staff_prints()->save($staff_prints);

        $this->successMessage = 'ID Created Successfully and Printed.';

        $this->clearForm();

        $this->currentStep = 1;

        // Open the new DB entry in a new tab
        $this->url = route('svg', $staff_prints->staff->id);

        // Get the URL of the new DB entry
        $url = route('svg', $staff_prints->id);

        // Open the URL in a new tab
        $this->dispatchBrowserEvent('open-new-tab', $url);
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
