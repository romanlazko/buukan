<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Romanlazko\Telegram\Models\TelegramChat;
use Romanlazko\Telegram\App\Bot;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function telegram_chat()
    {
        return $this->belongsTo(TelegramChat::class);
    }

    public function getResourceAttribute()
    {
        return collect([
            'client' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
            ],
        ]);
    }

    public function getAvatarAttribute()
    {
        if ($telegram_bot = $this->telegram_chat?->bot) {
            $bot = new Bot($telegram_bot->token);

            return $bot::getPhoto(['file_id' => $this->telegram_chat->photo]);
        }

        return $this->attributes['avatar'] ?? '/storage/img/public/preview.jpg';
    }
}
