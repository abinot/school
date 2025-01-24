<?php namespace App\Actions\Fortify;


use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param array<string, string> $input
     */
    public function create(array $input): User {
        $reservedUsernames = include ('reserved_usernames.php');

        Validator::make($input, [
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_]+$/', // فقط حروف انگلیسی، اعداد و _
                function ($attribute, $value, $fail) use ($reservedUsernames) {
                    if (in_array(strtolower($value), $reservedUsernames)) {
                        $fail('این نام‌کاربری نمی‌تواند استفاده شود.');
                    }
                },
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // تبدیل نام کاربری به حروف کوچک
        $input['username'] = strtolower($input['username']);
        $input['name'] = $input['username'];

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'username' => $input['username'],
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
