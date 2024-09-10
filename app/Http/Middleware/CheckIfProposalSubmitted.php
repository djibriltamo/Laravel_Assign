<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfProposalSubmitted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): 
     * (\Symfony\Component\HttpFoundation\Response)  $next
     * * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $jobId = $request->jobId->id;

        if (auth()->user()->proposals->contains('job_id', $jobId)) {
            return redirect()->route('jobs.index');
        }

        return $next($request);
    }
}
