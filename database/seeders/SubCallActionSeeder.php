<?php

namespace Database\Seeders;


use App\Models\SubAction;
use App\Models\CallAction;
use App\Models\SubCallAction;
use Illuminate\Database\Seeder;

class SubCallActionSeeder extends Seeder
{
    public function run()
    {

        $callActions = CallAction::all();

        foreach ($callActions as $callAction) {
            for ($i = 1; $i <= 9; $i++) {
                SubCallAction::updateOrCreate(
                    [
                        'call_action_id' => $callAction->id,
                        'digit' => $i,
                    ],
                    [

                        'type' => 'audio',
                    ]
                );
            }
        }
        echo "✅ Subactions seeded or updated successfully!\n";
    }
}
