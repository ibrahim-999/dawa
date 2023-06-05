<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Shared\v1\Services\ContactService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Shared\ContactUsRequest;

class ContactController extends ApiController
{
    private ContactService $contactService;

    public function __construct(
        ContactService $contactService,
    )
    {
        $this->contactService = $contactService;
    }

    /**
     * Store a newly created address in storage.
     */
    public function store(ContactUsRequest $request)
    {
        $contact = $this->contactService->add($request);
        if ($contact) {
            return $this->successCreateMessage();
        } else {
            return $this->failCreateMessage();
        }
    }
}
