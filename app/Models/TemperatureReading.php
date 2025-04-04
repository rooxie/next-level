<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $city_id
 * @property float $temperature
 * @property string $source
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereRecordedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereUpdatedAt($value)
 * @property-read \App\Models\City $city
 * @mixin IdeHelperTemperatureReading
 * @property int $year
 * @property \Illuminate\Support\Carbon $time
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemperatureReading whereYear($value)
 * @mixin \Eloquent
 */
class TemperatureReading extends Model
{
    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    // set fillable
    protected $fillable = [
        'city_id',
        'year',
        'time',
        'temperature',
        'source',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'time' => 'datetime',
        'temperature' => 'float',
    ];

    /**
     * @return BelongsTo<City>|City
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
