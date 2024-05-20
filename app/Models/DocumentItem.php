<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'DocumentItem';

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
        'DocumentId',
        'ProductId',
        'Quantity',
        'ExpectedQuantity',
        'PriceBeforeTax',
        'Price',
        'Discount',
        'DiscountType',
        'ProductCost',
        'PriceBeforeTaxAfterDiscount',
        'PriceAfterDiscount',
        'Total',
        'TotalAfterDocumentDiscount',
        'DiscountApplyRule',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
