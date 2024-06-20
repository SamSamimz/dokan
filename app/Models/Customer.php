<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchases() :HasMany {
        return $this->hasMany(Sale::class);
    }

    public function dues() :HasMany {
        return $this->hasMany(Due::class);
    }

    
}
