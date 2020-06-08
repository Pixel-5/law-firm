<?php

    use App\Profile;
    use App\User;
    use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Micheal',
                'slug'           => 'Micheal',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$KZ1AioruwI7TtKuMJCiu3.VyxwgnXBEFhKraK8wlkep9xqTEQeXny',
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 2,
                'name'           => 'Moffat',
                'slug'           => 'Moffat',
                'email'          => 'lawyer@lawyer.com',
                'password'       => '$2y$10$KZ1AioruwI7TtKuMJCiu3.VyxwgnXBEFhKraK8wlkep9xqTEQeXny',
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 3,
                'name'           => 'More',
                'slug'           => 'More',
                'email'          => 'super@super.com',
                'password'       => '$2y$10$KZ1AioruwI7TtKuMJCiu3.VyxwgnXBEFhKraK8wlkep9xqTEQeXny',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];
        User::insert($users);
        $users = User::all();
        foreach ($users as $user) {
            $user->profile()->save(factory(Profile::class)->make());
        }
        factory(User::class, 7)->create()->each(function ($user) {
            $user->roles()->sync(random_int(1,3));
            $user->profile()->save(factory(Profile::class)->make());
        });
    }
}
