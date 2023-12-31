<?php
namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\TelegramChat;

class TelegramChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company, TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $chats = $telegram_bot->chats()->search($request->search)
            ->orderByDesc('updated_at')
            ->paginate(20);

        $chats_collection = $chats->map(function ($chat) use ($bot){
            $last_message           = $chat->messages()->latest()->limit(1)->first();
            $chat->last_message     = Str::limit($last_message?->text ?? $last_message?->caption, 60);
            $chat->photo            = $bot::getPhoto(['file_id' => $chat->photo]);
            return $chat;
        });

        return view('admin.company.telegram.chat.index', compact([
            'company',
            'telegram_bot',
            'chats',
            'chats_collection'
        ]));
    }

    public function edit(Company $company, TelegramBot $telegram_bot, TelegramChat $chat)
    {
        $bot = new Bot($telegram_bot->token);

        $chat->photo = $bot::getPhoto(['file_id' => $chat->photo]);

        return view('admin.company.telegram.chat.edit', compact(
            'chat',
            'telegram_bot',
            'company',
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, TelegramBot $telegram_bot, TelegramChat $chat)
    {
        $bot = new Bot($telegram_bot->token);

        $chat->photo = $bot::getPhoto(['file_id' => $chat->photo]);

        $messages = $chat->messages()
            ->orderBy('id', 'DESC')
            ->with(['user', 'callback_query', 'callback_query.user'])
            ->paginate(20);

        $messages->map(function ($message) use ($bot){
            if ($message->photo) {
                $message->photo = $bot::getPhoto(['file_id' => $message->photo]);
            }
        });

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
    public function update(Request $request, Company $company, TelegramBot $telegram_bot, TelegramChat $chat)
    {
        try {
            $chat->update($request->all());

            return redirect()->route('admin.company.telegram_bot.chat.show', [$company, $telegram_bot, $chat])->with([
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
