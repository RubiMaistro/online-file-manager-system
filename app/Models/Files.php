<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Files extends Model
{

    use Sortable;

    protected $table = "files";
    protected $primaryKey = "id";

    protected $fillable = ['name', 'file'];

    public $sortable = ['Name', 'Filename', 'Size', 'Created', 'Modified'];
}
