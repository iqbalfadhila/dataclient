<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pkf',
        'nama_client',
        'alamat',
        'email',
        'nama_pic',
        'nomor_hp',
    ];

    /**
     * Generate unique PKF ID
     */
    public static function generatePkfId()
    {
        $count = self::count() + 1;
        return 'PKF-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
