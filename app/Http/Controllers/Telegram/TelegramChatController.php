<?php
namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\TelegramChat;

class TelegramChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company, TelegramBot $telegram_bot)
    {
        $telegram = new Telegram($telegram_bot->token);

        $chats = TelegramChat::search($request->search)
            ->where('telegram_bot_id', $telegram->getBotId())
            ->orderByDesc('updated_at')
            ->paginate(20);

        $chats_collection = $chats->map(function ($chat) use ($telegram){
            $last_message           = $chat->messages()->latest()->limit(1)->first();
            $chat->last_message     = Str::limit($last_message?->text ?? $last_message?->caption, 60);
            $chat->photo            = $telegram::getPhoto(['file_id' => $chat->photo]);
            return $chat;
        });

        return view('admin.company.telegram.chat.index', compact([
            'company',
            'telegram_bot',
            'chats',
            'chats_collection'
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, TelegramBot $telegram_bot, TelegramChat $chat)
    {
        $telegram = new Telegram($telegram_bot->token);

        $chat->photo = $telegram::getPhoto(['file_id' => $chat->photo]);

        $messages = $chat->messages()
            ->orderBy('id', 'DESC')
            ->with(['user', 'callback_query', 'callback_query.user'])
            ->paginate(20);

        $messages->map(function ($message) use ($telegram){
            if ($message->photo) {
                $message->photo = $telegram::getPhoto(['file_id' => $message->photo]);
            }
        });

        // dd($messages);

        return view('admin.company.telegram.chat.show', compact(
            'chat',
            'telegram_bot',
            'company',
            'messages'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TelegramChat $chat)
    {
        try {
            $chat->update($request->all());

            return back()->with([
                'ok' => true, 
                'description' => "Updated"
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'ok' => false, 
                'description' => $e->getMessage()
            ]);
        }
    }
}
