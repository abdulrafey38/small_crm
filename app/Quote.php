<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Quote
 *
 * @property int $id
 * @property int $customer_id
 * @property int $service_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_new
 * @property int $revision_no
 * @property-read \App\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Response[] $responses
 * @property-read int|null $responses_count
 * @property-read \App\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereRevisionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quote extends Model
{
    //
    protected $fillable = ['customer_id','service_id','message','status'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function responses()
    {
        return $this->hasMany('App\Response');
    }

}
