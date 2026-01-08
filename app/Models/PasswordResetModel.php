<?php

    namespace App\Models;

    use CodeIgniter\Model;


    /**
     *
     */
    class PasswordResetModel extends Model
    {
        /**
         *
         */
        protected $table = 'password_resets';

        /**
         *
         */
        protected $allowedFields = [
            'email',
            'token',
            'created_at'
        ];

        /**
         *
         */
        public function createToken($email)
        {
            /**
             * Gera token seguro
             */
            $token = bin2hex(random_bytes(32));

            /**
             * Remove tokens antigos
             */
            $this->where('email', $email)->delete();

            $this->insert(['email' => $email, 'token' => $token]);
            return $token;
        }

        /**
         *
         */
        public function getByToken($token)
        {
            return $this->where('token', $token)->first();
        }

        /**
         *
         */
        public function deleteToken($token)
        {
            return $this->where('token', $token)->delete();
        }
    }
