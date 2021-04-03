<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class RealEstateType extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'real_estate_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_english',
        'name_arabic',
        'name_kurdish',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function typeRealEstates()
    {
        return $this->hasMany(RealEstate::class, 'type_id', 'id');
    }
}
