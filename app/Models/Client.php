<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Romanlazko\Telegram\Models\TelegramChat;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\App\Bot;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'social_media' => 'object'
    ];

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
        if ($this->telegram_chat) {
            $bot = new Bot($this->telegram_bot->token);

            return $bot::getPhoto(['file_id' => $this->telegram_chat->photo]);
        }

        return $this->attributes['avatar'] ?? 'img/public/preview.jpg';
    }

    public function telegram_bot()
    {
        return $this->telegram_chat->bot();
    }

    public function getChatIdAttribute()
    {
        return $this->telegram_chat?->chat_id ?? null;
    }
}
