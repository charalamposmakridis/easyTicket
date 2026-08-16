<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = User::where('role', 'client')->first();
        $category = Category::first();

        if ($client && $category) {
            $ticket1 = Ticket::create([
                'title' => 'Cannot connect to Wi-Fi',
                'description' => 'I am experiencing connection issues with the main network.',
                'status' => 'open',
                'user_id' => $client->id,
            ]);
            $ticket1->categories()->attach($category->id);

            $ticket2 = Ticket::create([
                'title' => 'Billing Inquiry',
                'description' => 'I need clarification regarding my latest monthly invoice.',
                'status' => 'closed',
                'user_id' => $client->id,
            ]);
            $ticket2->categories()->attach($category->id);
        }
    }
}
