<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'by_user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeFilter($query, array $filters){
        return $query->when(
            $filters['title'] ?? false,
            fn ($query, $value) => $query->where('title', 'LIKE', '%' . $value . '%')
        )
        ->when(
            $filters['due_date'] ?? false,
            fn ($query, $value) => $query->whereDate('due_date', '>=', $value)
        )
        ->when(
            $filters['user_id'] ?? false,
            fn ($query, $value) => $query->whereHas('users', fn ($q) => $q->where('user_id', $value))
        );
    }
}
