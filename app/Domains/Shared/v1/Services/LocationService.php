<?php

namespace App\Domains\Shared\v1\Services;

use App\Models\Contact;
use App\Models\FirebaseDeviceToken;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LocationService 
{
    private Model|Builder $locationModel;

    public function __construct()
    {
        $this->locationModel = new Location();
    }

    public function add(Request $request): ?Model
    {
        try {
            $user = getAuthUser();
            
            $location = $user->location()->updateOrCreate([],[
                'lat' => $request->lat,
                'long' => $request->long,
            ]);
            
            return $location;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

}
