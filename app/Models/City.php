<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property float $latitude
 * @property float $longitude
 * @property string|null $country_code
 * @property string|null $timezone
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TemperatureReading> $temperatureReadings
 * @property-read int|null $temperature_readings_count
 * @mixin \Eloquent
 * @mixin IdeHelperCity
 */
class City extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * @return HasMany<TemperatureReading>|TemperatureReading[]
     */
    public function temperatureReadings(): HasMany
    {
        return $this->hasMany(TemperatureReading::class);
    }
}
