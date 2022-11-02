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
 * @property private  user = "email user"
 * @property private  path = "generate token"
 * @method private  get_token($user_id) : string
*/

class EmailVerified extends Mailable
{
    use Queueable, SerializesModels;

    const VIEW = "email";
    const SUBJECT = "Email verified";
    private  $user;
    private  $path = "";

    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->path = Env::get("APP_URL"."api/email/" , "http://127.0.0.1:8000/api/email/");
        $this->path .= $this->get_token();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(self::VIEW, ["subject" => self::SUBJECT , "link" => $this->path])
            ->subject(self::SUBJECT)
            ->to($this->user->email);
    }

    /**
     * Get unigiu token 
     */
    private function get_token() : string {
        $token = Str::replace("/" , "" , Hash::make($this->user->email));
        if(ModelsEmailVerified::query()->where("token", $token)->exists())
        {
            $this->get_token();
        }
        else
        {
            ModelsEmailVerified::query()
                ->create([
                    "user_id" => $this->user->id,
                    'token' => $token
                ]);
            return $token;
        }
    }
}
