<?php

namespace App\Models\Admin;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['full_name', 'short_name', 'description', 'email', 'footer_text', 'phone_number'];

}
