<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Work',
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Sport',
        ]);
        DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Education',
        ]);
        DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Shopping',
        ]);
        DB::table('categories')->insert([
            'id' => 5,
            'name' => 'Other',
        ]);

        factory(App\Task::class, 500)->create();
    }
}
