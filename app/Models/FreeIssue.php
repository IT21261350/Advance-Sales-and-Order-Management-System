<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeIssue extends Model
{
    use HasFactory;

    protected $table = 'freeissues';

    protected $fillable = [
        'fIssue',
        'type',
        'pro',
        'fPro',
        'pQuan',
        'fQuan',
        'lLimit',
        'uLimit'
    ];

}
