<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    public const CURRENCY_ETH = 'eth';

    public const CURRENCY_BTC = 'btc';

    public const HARD_BOX = 0;

    public const EASY_BOX = 1;

    public const QUEST_BOX = 2;

    protected $table = 'box';

    protected $primaryKey = 'id';

    protected $fillable = [
        'seed',
        'starting_bank',
        'price',
        'cryptocurrency',
        'address',
        'box_type',
    ];

    public static $currency_name = [
        self::CURRENCY_ETH => 'Ethereum',
        self::CURRENCY_BTC => 'Bitcoin',
    ];

    public static $box_name = [
        self::HARD_BOX => 'Hard-box',
        self::EASY_BOX => 'Easy-box',
        self::QUEST_BOX => 'Quest-box',
    ];

    /**
     * @param $value
     */
    public function setSeedAttribute($value)
    {
        $this->attributes['seed'] = $value ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getSeedAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function hints()
    {
        return $this->hasManyThrough(Hints::class, BoxHint::class, 'box_id', 'id', 'id', 'hint_id');
    }

    public static function seeds(): array
    {
        return [
            'world',
            'hello',
            'last',
            'down',
            'sun',
            'phonet',
            'ready',
            'car',
            'watch',
            'together',
            'street',
            'cat',
        ];
    }
}
