<?php

namespace Database\Seeders;

use App\Models\FitnessTrainer;
use App\Models\Folder;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        FitnessTrainer::truncate();
        Folder::truncate();
        Video::truncate();


        $trainer = FitnessTrainer::factory()->create();
         $folder = Folder::factory()->create();
         Video::factory(2)->create([
             'fitnesstrainer_id'=>$trainer->id,
             'folder_id'=>$folder->id,
         ]);


    }
}
