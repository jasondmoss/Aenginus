<?php

/**
 * Ænginus: Laravel Website Engine.
 *
 * @package    Laravel
 * @author     Jason D. Moss <jason@jdmlabs.com>
 * @copyright  2017 Jason D. Moss. All rights freely given.
 * @license    https://github.com/jasondmoss/aenginus/blob/master/LICENSE.md [WTFPL License]
 * @link       https://github.com/jasondmoss/aenginus/
 */

namespace App\Http\Middleware;

use App\Http\Repositories\IpRepository;
use Closure;

class BlockMiddleware
{
    protected $ipRepository;

    /**
     * BlockMiddleware constructor.
     * @param IpRepository $ipRepository
     */
    public function __construct(IpRepository $ipRepository)
    {
        $this->ipRepository = $ipRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isAdminById(auth()->id()) && $this->ipRepository->isBlocked($request->ip())) {
            return response('Sorry, you are blocked, -_-');
        }
        return $next($request);
    }
}

/* <> */
