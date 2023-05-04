<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->returnUrl = "/users/{}/addresses";
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(User $user): View
    {
        //$this->userId = $user;
        return view("backend.addresses.index", ["addrs" => $user->addrs, "user" => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(User $user): View
    {
        //$this->editReturnUrl($user->user_id);
        return view("backend.addresses.insert_form", ["user" => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param User $user
     * @param ProductImageRequest $request
     * @return RedirectResponse
     */
    public function store(PasswordRequest $request/*, User $user*/): RedirectResponse
    {
        $addr = new Address();
        //$request->user_id = $user->user_id;
        $data = $this->prepare($request, $addr->getFillable());
        $addr->fill($data);
        $addr->save();
       // Address::create($data);
        $this->editReturnUrl($request->user_id);
        return redirect($this->returnUrl);
    }

    private function editReturnUrl($id)
    {
        $this->returnUrl = "/users/$id/addresses";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @param Address $address
     * @return View
     */
    public function edit(User $user, Address $address): View
    {
        return view("backend.addresses.update_form", ["user" => $user, "addr" => $address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductImageRequest $request
     * @param User $user
     * @param Address $address
     * @return RedirectResponse
     */
    public function update(PasswordRequest $request, User $user, Address $address): RedirectResponse
    {
        $data = $this->prepare($request, $address->getFillable());
        $address->fill($data);
        $address->save();

        $this->editReturnUrl($user->user_id);

        return Redirect::to($this->returnUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(Address $address): JsonResponse
    {
        $id = $address->address_id;
        $address->delete();
        return response()->json(["message" => "Done", "id" => $id]);
    }
}
