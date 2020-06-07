<?php

    use App\FileCase;
    use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(FileCase::class, 2000)->create();
    }
}
