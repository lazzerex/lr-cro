<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class PortfolioTag extends Tag
{
    use HasFactory;
    use HasParent;
}
