<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateToken extends Command
{
    protected $signature = 'generate:token';

    protected $description = 'Create a token for test purposes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create();
        }

        $token  = $user->createToken('API Token')->plainTextToken;
        echo "Token: $token \n";

        return 0;
    }
}
