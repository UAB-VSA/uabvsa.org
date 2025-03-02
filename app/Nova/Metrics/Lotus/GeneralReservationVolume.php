<?php

namespace App\Nova\Metrics\Lotus;

use App\Helpers\Settings\LotusSettings;
use App\Models\LotusReservation;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Progress;

class GeneralReservationVolume extends Progress
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->sum($request, LotusReservation::class, function ($query) {
            return $query->where('holder_type', 'general');
        }, 'tickets', target: LotusSettings::generalTicketCapacity());
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
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
        return 'lotus-general-reservation-volume';
    }
}
