<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $table = 'family_list';
    protected $primaryKey = 'ft_id';
    public $timestamps = false;
    
    protected $fillable = [
        'ft_id',
        'cst_id',
        'ft_relation',
        'ft_name',
        'ft_dob'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cst_id', 'cst_id');
    }
}