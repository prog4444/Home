<?php

namespace App\Mail;

use App\Models\EmailVerified as ModelsEmailVerified;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @property const VIEW = "email"
 * @property const SUBJECT = "email user"
 * @property private string $email = "email user"
 * @property private string token = "generate token"
 * @method private  get_token() : string
*/

class EmailVerified extends Mailable
{
    use Queueable, SerializesModels;

    const VIEW = "email";
    const SUBJECT = "Email verified";
    private string $email = "";
    private  $path = "";

    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct(User $user)
    {
        $this->email = $user->email;
        $this->path = Env::get("APP_URL"."api/email/" , "http://127.0.0.1:8000/api/email/");
        $this->path += $this->get_token($user->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(self::VIEW, ["subject" => self::SUBJECT , "link" => $this->path]);
    }

    /**
     * Get unigiu token 
     */
    private function get_token(int $user_id) : string {
        $token = Str::replace("/" , "" , Hash::make($this->email));
        if(ModelsEmailVerified::query()->where("token", $token)->exists())
        {
            $this->get_token($user_id);
        }
        else
        {
            ModelsEmailVerified::query()
                ->create([
                    "user_id" => $user_id,
                    'token' => $token
                ]);
            return $token;
        }
    }
}
