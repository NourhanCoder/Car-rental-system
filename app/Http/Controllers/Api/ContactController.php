<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponse;

    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = Contact::create($request->validated());

        return $this->successResponse(
            $contact,
            'Your message has been sent successfully!',
            201
        );
    }
}
