<?php namespace Maatwebsite\Usher\Domain\Users\Events\Handlers;

use Illuminate\Contracts\Auth\Guard;
use Maatwebsite\Usher\Contracts\Users\User;
use Maatwebsite\Usher\Exceptions\UserIsBannedException;

class CheckIfUserIsBanned
{

    /**
     * @var Guard
     */
    private $guard;

    /**
     * @param Guard $guard
     * @internal param UserRepository $repository
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Handle
     * @param User $user
     */
    public function handle(User $user)
    {
        if ($user && $user->isBanned()) {
            $this->guard->logout();
            throw new UserIsBannedException('You are banned from the system');
        }
    }
}
