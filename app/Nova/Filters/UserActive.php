<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class UserActive extends Filter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($request->resource() === 'App\Nova\User') {
            if ($value === 'yes') {
                return $query->active();
            } else {
                return $query->inactive();
            }
        } elseif ($request->resource() === 'App\Nova\Attendance') {
            if ($value === 'yes') {
                return $query->whereHas('attendee', function ($q) {
                    $q->active();
                });
            } else {
                return $query->whereDoesntHave('attendee', function ($q) {
                    $q->active();
                });
            }
        } else {
            return $query;
        }
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Yes' => 'yes',
            'No' => 'no',
        ];
    }
}
