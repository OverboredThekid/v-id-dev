<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory, HasUlids;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'is_active',
    ];

    public function staff_prints()
    {
        return $this->hasOne(staff_prints::class, 'staff_id');
    }

    protected $casts = [
        'is_admin' => 'boolean',
    ];


    public static function boot() {
        parent::boot();
        self::deleting(function($staff) { // before delete() method call this
             $staff->staff_prints()->each(function($staff_print) {
                $staff_print->delete(); // <-- direct deletion
             });
             // do the rest of the cleanup...
        });
    }


}
