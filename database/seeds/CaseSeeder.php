<?php

    use App\Facade\UserRepository;
    use App\FileCase;
    use Illuminate\Database\Seeder;
    use Faker\Generator as Faker;

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
