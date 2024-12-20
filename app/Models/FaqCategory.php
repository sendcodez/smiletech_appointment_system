<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'faq_category';
    protected $fillable = [
        'name'
    ];
    public function faqs()
{
    return $this->hasMany(Faq::class);
}

}
