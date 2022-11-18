<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GeneratedUrl extends Model
{
    use HasFactory;

    protected $table = 'generated_urls';

    protected $fillable = [
        'user_id',
        'uri',
        'expiry_date',
        'is_expired'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function generateNewLinkForByUser($user)
    {
        $uuid = (string)Str::uuid();

        return  $user->generatedUrls()->create([
            'uri' => $uuid,
            'expiry_date' => Carbon::now()->addDays(7),
        ]);
    }
}
