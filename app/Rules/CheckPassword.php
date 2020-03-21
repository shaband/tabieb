<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CheckPassword implements Rule
{
    /**
     * @var String
     */
    private $table;
    /**
     * @var String
     */
    private $email;

    /**
     * Create a new rule instance.
     *
     * @param String $table
     * @param String $email
     */
    public function __construct(?String $table, ?String $email)
    {
        //
        $this->table = $table;
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $row = DB::table($this->table)->where('email', $this->email)->first();

        $hashed_password = optional($row)->password;

        return Hash::check($value, $hashed_password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Wrong Password");
    }
}
