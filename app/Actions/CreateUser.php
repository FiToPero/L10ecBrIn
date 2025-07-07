<?php

namespace App\Actions;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Hash;


class CreateUser
{
    use AsAction;

    public function handle($data)
    {
        // save image in storage
        if ($data['profile_photo_path'] instanceof \Illuminate\Http\UploadedFile) {
            $imageUrl_01 = $data['profile_photo_path']->store('public/users/images');
            $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
        }else {
            $imageUrl_01 = null;
        }

        $response = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'zip_code' => $data['zip_code'],
            'company' => $data['company'],
            'profile_photo_path' => $imageUrl_01,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
        ]);
        return $response;
    }
}
