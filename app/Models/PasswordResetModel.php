<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $allowedFields = ['email', 'token', 'created_at'];

    public function createToken($email)
    {
        $token = bin2hex(random_bytes(32)); // gera token seguro
        $this->where('email', $email)->delete(); // remove tokens antigos
        $this->insert(['email' => $email, 'token' => $token]);
        return $token;
    }

    public function getByToken($token)
    {
        return $this->where('token', $token)->first();
    }

    public function deleteToken($token)
    {
        return $this->where('token', $token)->delete();
    }
}
