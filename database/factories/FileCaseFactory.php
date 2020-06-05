<?php

/** @var Factory $factory */

    use App\Facade\FileRepository;
    use App\Facade\UserRepository;
    use App\FileCase;
    use Carbon\Carbon;
    use Faker\Generator as Faker;
    use Illuminate\Database\Eloquent\Factory;
    use Illuminate\Support\Str;

    $factory->define(FileCase::class, function (Faker $faker) {
        $gender = $faker->randomElement(['male', 'female']);
        $status = $faker->randomElement(['assigned', 'scheduled', 'attended']);

        $lawyers = UserRepository::getLawyersOnly();
        $randLawyer = $faker->randomElement($lawyers);

        $files = FileRepository::allFiles();
        $randFile = $faker->randomElement($files);
        $user_id =  $faker->randomElement([null, $randLawyer->id]);
        return [
            'plaintiff' => $faker->firstName($gender),
            'number' => Str::caseNumber(),
            'user_id' =>$user_id,
            'file_id' => $randFile->id,
            'defendant' => $faker->unique()->firstName,
            'status' => $user_id === null? 'pending': 'assigned',
            'details' =>  $faker->sentence(100),
            'created_at' =>  Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $faker->dateTimeBetween('2020-01-01', '2020-06-05')->format('Y-m-d H:i:s')),
        ];
});
