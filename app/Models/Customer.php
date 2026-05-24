<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'm_customer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_nama',
        'customer_npwp',
        'customer_alamat',
        'customer_kontak',
        'customer_email',
        'customer_status',
    ];
}
