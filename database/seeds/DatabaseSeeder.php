<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AuthorTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(GenreTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
