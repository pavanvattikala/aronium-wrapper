<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Product';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ProductGroupId',
        'Name',
        'Code',
        'PLU',
        'MeasurementUnit',
        'Price',
        'IsTaxInclusivePrice',
        'CurrencyId',
        'IsPriceChangeAllowed',
        'IsService',
        'IsUsingDefaultQuantity',
        'IsEnabled',
        'Description',
        'DateCreated',
        'DateUpdated',
        'Cost',
        'Markup',
        'Image',
        'Color',
        'AgeRestriction',
        'LastPurchasePrice',
        'Rank',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'DateCreated',
        'DateUpdated',
    ];
}
