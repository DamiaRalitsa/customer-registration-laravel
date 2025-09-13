<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table = 'nationality';
    protected $primaryKey = 'nationality_id';
    public $timestamps = false;
    
    protected $fillable = [
        'nationality_id',
        'nationality_name', 
        'nationality_code'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'nationality_id', 'nationality_id');
    }
}