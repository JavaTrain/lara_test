<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $createPost = new \App\Permission();
        $createPost->name         = 'create-post';
        $createPost->display_name = 'Create Posts'; // optional
        // Allow a user to...
        $createPost->description  = 'create new blog posts'; // optional
        $createPost->save();

        $editUser = new \App\Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users'; // optional
        // Allow a user to...
        $editUser->description  = 'edit existing users'; // optional
        $editUser->save();

        $deleteUser = new \App\Permission();
        $deleteUser->name         = 'delete-user';
        $deleteUser->display_name = 'Delete Users'; // optional
        // Allow a user to...
        $deleteUser->description  = 'delete existing users'; // optional
        $deleteUser->save();
    }
}
