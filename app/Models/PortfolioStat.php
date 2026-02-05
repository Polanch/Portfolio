<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioStat extends Model
{
    protected $table = 'portfolio_stats';
    protected $fillable = ['view_count', 'page'];
}
