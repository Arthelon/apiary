<?php

namespace App\Nova\Metrics;

use App\Team;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class TotalTeamMembers extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $count = Team::where('id', $request->resourceId)->get()->first()->members()->count();

        return $this->result($count);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'total-team-members';
    }
}
