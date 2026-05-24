<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{

    public function run(): void
    {
        BankAccount::factory()->count(50)->create();
    }
}
