<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Response
 *
 * @property int $id
 * @property int|null $quote_id
 * @property string $description
 * @property int $discount
 * @property int $tax
 * @property float $sub_total
 * @property float $total_bill
 * @property int $revision_no
 * @property string $service_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Quote|null $quote
 * @method static \Illuminate\Database\Eloquent\Builder|Response newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Response newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Response query()
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereQuoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereRevisionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereServiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereTotalBill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Response extends Model
{
    protected $guard = [];

    public function quote()
    {
        return $this->belongsTo('App\Quote');
    }
}
