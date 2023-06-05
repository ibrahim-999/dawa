<?php

namespace App\Domains\Driver\v1\Enums;

enum DriverProfileStep: int
{
    case STEP_ONE = 1; // first step 
    case STEP_TWO = 2; // second step
    case STEP_THREE = 3; // completed
}
