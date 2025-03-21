<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TimezoneAwareRequest extends FormRequest
{

    /**
     * Get the user's timezone from cookies or default to the app timezone or to server timezone.
     *
     * @return string
     */
    public function getTimezone(): string
    {
        return strval(
            $this->cookie('user_timezone') ?: config('app.timezone') ?: Carbon::today()->timezoneName
        );
    }
}
