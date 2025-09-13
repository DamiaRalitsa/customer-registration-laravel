<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'cst_id';
    public $timestamps = false;
    
    protected $fillable = [
        'cst_id',
        'nationality_id',
        'cst_name',
        'cst_dob',
        'cst_phonenum',
        'cst_email'
    ];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'nationality_id');
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'cst_id', 'cst_id');
    }
}