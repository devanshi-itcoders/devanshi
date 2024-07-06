<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Image extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title',
        'description',
        'btn_text',
        'btn_link',
        'image',
        'is_daily_darshan',
        'is_gallery',
        'is_pages',
        'is_home_slider',
        'status'
    ];
    public $sortable = [ 'id','title', 'slug'];

}
