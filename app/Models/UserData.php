<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserData extends Model
{
    use HasFactory;

    protected $table = 'users_data';

    protected $fillable = [
        'user_id',
        'profit',
        'growth',
        'orders',
        'customers'
    ];

    public function getData(int $userId)
    {

        return UserData::select('profit','growth','orders','customers')->where('user_id', $userId)->get();

    }

    public function createData(int $userId) : UserData
    {
        $userData = UserData::create([
            'user_id' => $userId,
            'profit' => 23523,
            'growth' => 1721,
            'orders' => 3685,
            'customers' => 269,
        ]);

        return $userData;
    }
}
