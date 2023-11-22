<?php
namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Romanlazko\Telegram\App\Config;
use Romanlazko\Telegram\App\Telegram;
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

        $telegram_bots->map(function ($telegram_bot) {
            $telegram = new Telegram($telegram_bot->token);
            $telegram_bot->photo = $telegram->getBotChat()->getPhotoLink();
            return $telegram_bot;
        });

        return view('admin.company.telegram.index', compact([
            'telegram_bots',
            'company'
        ]));
    }

    public function create(Company $company)
    {
        return view('admin.company.telegram.create', compact([
            'company'
        ]));
    }

    public function store(Request $request, Company $company)
    {
        try {
            $telegram = new Telegram($request->token);

            $response = $telegram::setWebHook([
                'url' => url('api/telegram/'.$telegram->getBotId()),
            ]);

            if ($response->getOk()) {
                $telegram_bot = $company->telegram_bots()->create([
                    'id'            => $telegram->getBotChat()->getId(),
                    'first_name'    => $telegram->getBotChat()->getFirstName(),
                    'last_name'     => $telegram->getBotChat()->getLastName(),
                    'username'      => $telegram->getBotChat()->getUsername(),
                    'photo'         => $telegram->getBotChat()->getPhoto()?->getBigFileId(),
                    'token'         => $request->token,
                    'namespace'     => 'buukan_bot',
                ]);
            }
            
            return back()->with([
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
        $telegram = new Telegram($telegram_bot->token);

        $telegram_bot->photo                  = $telegram->getBotChat()->getPhotoLink();
        $telegram_bot->webhook                = $telegram::getWebhookInfo()->getResult();
        $telegram_bot->all_commands_list      = $telegram->getAllCommandsList();
        $telegram_bot->config                 = Config::$config;
        $telegram_bot->logs                   = $telegram_bot->logs();

        return view('admin.company.telegram.show', compact([
            'company',
            'telegram_bot'
        ]));
    }

    public function edit(Company $company, TelegramBot $telegram_bot)
    {
        $telegram = new Telegram($telegram_bot->token);

        $telegram_bot->photo                  = $telegram->getBotChat()->getPhotoLink();
        $telegram_bot->webhook                = $telegram::getWebhookInfo()->getResult();
        $telegram_bot->all_commands_list      = $telegram->getAllCommandsList();
        $telegram_bot->config                 = Config::$config;
        $telegram_bot->logs                   = $telegram_bot->logs();

        return view('admin.company.telegram.edit', compact([
            'company',
            'telegram_bot'
        ]));
    }

    public function update(Request $request, Company $company, TelegramBot $telegram_bot)
    {
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
