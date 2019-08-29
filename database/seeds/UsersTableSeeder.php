<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Image;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Question for a terminal
        $usersCount = max((int)$this->command->ask('How many users would you like to be created?', 20), 1);

        $admin = factory(App\User::class)->state('custom-user')->create();
        $users = factory(App\User::class, $usersCount)->create();

        foreach($users as $user) {
            if(File::exists(public_path("storage/avatars/")."image-{$user->id}.png")) {
                $user->image()->save(
                    Image::make(['path'=>"avatars/image-{$user->id}.png"])
                );
            }
        }

        if(File::exists(public_path("storage/avatars/")."image-{$admin->id}.png")) {
            $admin->image()->save(
                Image::make(['path'=>"avatars/image-{$admin->id}.png"])
            );
        }
    }
}
