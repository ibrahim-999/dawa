<?php

namespace App\Domains\Shared\v1\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContactService 
{
    private Model|Builder $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    public function add(Request $request): ?Model
    {
        try {
            $data = $request->validated();
            $data['phone'] = $this->getRequestPhone($request);
            $contact = $this->contactModel->create($data);
            return $contact;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getRequestPhone($request): ?string
    {
        try {
            return phone($request->phone['number'], $request->phone['code'])->formatE164();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}
