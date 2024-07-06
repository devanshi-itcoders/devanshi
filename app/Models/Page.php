<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Page extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'status'
    ];

    public $sortable = [ 'id','title', 'slug'];

}
