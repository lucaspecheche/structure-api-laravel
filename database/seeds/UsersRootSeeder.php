<?php

use App\Domain\Models\Role;
use App\Domain\Models\User;
use Illuminate\Database\Seeder;

class UsersRootSeeder extends Seeder
{
    public function run()
    {
        $role = $this->createRole();

        $user = User::firstOrNew([
            'firstName' => 'Lucas',
            'lastName'  => 'Lima',
            'cpf'       => '04595002106',
            'email'     => 'lucas@mail.com',
            'password'  => bcrypt('123456'),
            'role_id'   =>  $role->id
        ]);

        $user->save();
    }

    private function createRole(): Role
    {
        $role = Role::firstOrNew([
            'name' => 'Administrator',
            'slug' => 'administrator'
        ]);

        $role->save();
        return $role;
    }
}
