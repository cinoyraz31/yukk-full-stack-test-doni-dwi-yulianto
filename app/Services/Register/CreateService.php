<?php

namespace App\Services\Register;
use App\Models\Account;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
class CreateService extends BaseService
{
    public $rules = [
        'full_name' => 'required|string|max:250',
        'email' => 'required|email|max:250|unique:users',
        'password' => 'required|min:8',
    ];

    public $ruleMessages = [
        'full_name.required' => 'full name is required',
        'full_name.string' => 'full name must string',
        'full_name.max' => 'full name max 250 character',
        'email.required' => 'email address is required',
        'email.email' => 'email address must format email',
        'email.max' => 'email address max 250 character',
        'email.unique' => 'email address is registered',
        'password.required' => 'password is required',
        'password.min:8' => 'password min 8 character',
    ];

    public function execute()
    {
        $user = new User();
        $user->name = $this->request['full_name'];
        $user->email = $this->request['email'];
        $user->password = Hash::make($this->request['password']);
        $user->save();

        $account = new Account();
        $account->user_id = $user->id;
        $account->balance = 0;
        $account->total_transaction = 0;
        $account->save();

        $this->data = [
            "email" => $this->request['email'],
            "password" => $this->request['password'],
        ];
    }
}
