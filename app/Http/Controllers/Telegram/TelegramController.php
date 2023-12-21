<?php
namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Romanlazko\Telegram\App\Config;
use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Http\Requests\BotStoreRequest;
use Romanlazko\Telegram\Models\TelegramBot;

class TelegramController extends Controller
{
    public function index(Company $company)
    {
        $telegram_bots = $company->telegram_bots;

        if ($telegram_bots->isEmpty()) {
            return redirect()->route('admin.company.telegram_bot.create', [$company]);
        }

        return redirect()->route('admin.company.telegram_bot.show', [$company, $telegram_bots->first()]);
    }

    public function create(Company $company)
    {
        $telegram_bots = $company->telegram_bots;

        if ($telegram_bots->isEmpty()) {
            return view('admin.company.telegram.create', compact([
                'company'
            ]));
        }

        return redirect()->route('admin.company.telegram_bot.show', [$company, $telegram_bots->first()]);
        
    }

    public function store(Request $request, Company $company)
    {
        try {
            $bot = new Bot($request->token);

            $response = $bot::setWebHook([
                'url' => env('APP_URL').'/api/telegram/'.$bot->getBotId(),
            ]);

            if ($response->getOk()) {
                $telegram_bot = $company->telegram_bots()->create([
                    'id'            => $bot->getBotChat()->getId(),
                    'first_name'    => $bot->getBotChat()->getFirstName(),
                    'last_name'     => $bot->getBotChat()->getLastName(),
                    'username'      => $bot->getBotChat()->getUsername(),
                    'photo'         => $bot->getBotChat()->getPhoto()?->getBigFileId(),
                    'token'         => $request->token,
                    'settings'      => $request->settings,
                    'namespace'     => 'buukan_bot',
                ]);
            }
            
            return redirect()->route('admin.company.telegram_bot.index', $company)->with([
                'ok' => $response->getOk(), 
                'description' => $response->getDescription()
            ]);
        }
        catch (TelegramException $e){
            return back()->with([
                'ok' => false, 
                'description' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $telegram_bot->photo                  = $bot->getBotChat()->getPhotoLink();
        $telegram_bot->webhook                = $bot::getWebhookInfo()->getResult();
        $telegram_bot->all_commands_list      = $bot->getAllCommandsList();
        $telegram_bot->config                 = Config::$config;
        $telegram_bot->logs                   = $telegram_bot->logs();

        return view('admin.company.telegram.show', compact([
            'company',
            'telegram_bot'
        ]));
    }

    public function edit(Company $company, TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $telegram_bot->photo                  = $bot->getBotChat()->getPhotoLink();
        $telegram_bot->webhook                = $bot::getWebhookInfo()->getResult();
        $telegram_bot->all_commands_list      = $bot->getAllCommandsList();
        $telegram_bot->config                 = Config::$config;
        $telegram_bot->logs                   = $telegram_bot->logs();

        return view('admin.company.telegram.edit', compact([
            'company',
            'telegram_bot'
        ]));
    }

    public function update(Request $request, Company $company, TelegramBot $telegram_bot)
    {
        $bot = new Bot($request->token);

        $response = $bot::setWebHook([
            'url' => env('APP_URL').'/api/telegram/'.$bot->getBotId(),
        ]);

        $company->telegram_bots()->find($telegram_bot->id)->update([
            'settings' => $request->settings
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, TelegramBot $telegram_bot)
    {
        $company->telegram_bot->delete();

        return back();
    }
}
