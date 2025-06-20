<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'subject',
        'message',
        'lang',
    ];
}
