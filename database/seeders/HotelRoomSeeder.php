<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::factory(10)->create()->each(function ($hotel){
           Room::factory(rand(1,6))->create([
              'hotel_id'=>$hotel->id
           ]);
        });
    }
}
