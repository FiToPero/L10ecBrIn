<?php

namespace App\Actions;

use App\Http\Requests\UserRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\User;

class UpdateUser
{
    use AsAction;

    public function handle($data)
    {   
          ///// save image in storage
        if ($data['profile_photo_path'] instanceof \Illuminate\Http\UploadedFile) {
            $imageUrl_01 = $data['profile_photo_path']->store('public/users/images');
            $imageUrl_01 = str_replace('public', 'storage', $imageUrl_01);
        } else {
            if(is_string($data['profile_photo_path'])){
                $imageUrl_01 = $data['profile_photo_path'];
            }
        }

        $response = User::where('id', $data['id'])->update([
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
            'email' => $data['email'],
            'profile_photo_path' => $imageUrl_01,
            'role_id' => $data['role_id'],
        ]);
        return $response;
    }
}
