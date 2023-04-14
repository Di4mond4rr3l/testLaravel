<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use File;
use Illuminate\Database\Seeder;
use Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $users = User::factory()->hasPosts(3)->count(10)->create();

        foreach($users AS $user) {
            /**
             * @var User $user
             */
            $rand = rand(0,2);
            $rand2 = rand(0,2);

            while($rand == $rand2){ $rand2 = rand(0,2); }

            $user->roles()->save($roles[$rand]);
            $user->roles()->save($roles[$rand2]);

            $path = 'user'.$user->id;
        
            if (Storage::disk("public")->exists($path)) {
                Storage::disk("public")->deleteDirectory($path);
            }

            Storage::disk("public")->makeDirectory($path);
            $image = fake()->image(Storage::disk("public")->path($path), 500, 500, 'person');
            
            $path = $path.'/profilePic.png';
            //dd(Storage::disk("public")->path($path), $image);
            File::move($image, Storage::disk("public")->path($path));    
            
            $user->images = 'user'.$user->id.'/profilePic.png';
            $user->update();
        }
    }
}
