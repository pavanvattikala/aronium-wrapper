<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Document';

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
        'Number',
        'UserId',
        'CustomerId',
        'OrderNumber',
        'Date',
        'StockDate',
        'Total',
        'IsClockedOut',
        'DocumentTypeId',
        'WarehouseId',
        'ReferenceDocumentNumber',
        'DateCreated',
        'DateUpdated',
        'InternalNote',
        'Note',
        'DueDate',
        'Discount',
        'DiscountType',
        'PaidStatus',
        'DiscountApplyRule',
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
        'Date',
        'StockDate',
        'DateCreated',
        'DateUpdated',
        'DueDate',
    ];
}
