<?php

namespace App\Models;

use App\Events\ChatCreated;
use App\Events\ChatUpdated;
use App\Events\ChatDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'id_user',
        'id_doctor',
        'id_channel',
        'last_message',
    ];

    protected $dispatchesEvents =[
        'created' => ChatCreated::class,
        'updated' => ChatUpdated::class,
        'deleted' => ChatDeleted::class,
    ];


}
