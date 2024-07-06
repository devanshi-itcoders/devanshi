<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Configuration extends Model
{
    use HasFactory;
    use Sortable;
    protected $fillable = [
        'configkey',
        'configvalue',
        'description',
        'status',
    ];


    public $sortable = ['id', 'configkey', 'configvalue'];
}
