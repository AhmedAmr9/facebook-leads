<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_name',
        'ad_set_name',
        'delivery_status',
        'delivery_level',
        'reach',
        'impressions',
        'frequency',
        'attribution_setting',
        'result_type',
        'results',
        'amount_spent',
        'cost_per_result',
        'starts',
        'ends',
        'reporting_starts',
        'reporting_ends',
        'uploaded_by',

    ];
}
