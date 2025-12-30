<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'name',
        'email',
        'phone',
        'category_id',
        'title',
        'description',
        'photo',
        'status',
        'admin_note'
    ];

    // Relasi: 1 complaint milik 1 category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
