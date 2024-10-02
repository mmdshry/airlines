<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class SendMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-message-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $telegram = new Api('');
        $chatId = '@realtime_usd'; // Replace with your channel ID
        dd($telegram->getUpdates());
        foreach ($telegram->getUpdates() as $update) {
            dd(                'chat_id' . "@{$update['channel_post']['chat']['username']}",
                'message_id'. $update['channel_post']['message_id']);
            $telegram->deleteMessage([
                'chat_id' => "@{$update['channel_post']['chat']['username']}",
                'message_id' => $update['channel_post']['message_id']
            ]);
        }

        dd($telegram->getUpdates());

        $newMessage = 'test';
        $response = $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $newMessage
        ]);

        $messageId = $response->getMessageId();

        $telegram->deleteMessage([
            'chat_id' => $chatId,
            'message_id' => $messageId
        ]);

        $this->info('Message sent and previous messages deleted.');
    }
}
