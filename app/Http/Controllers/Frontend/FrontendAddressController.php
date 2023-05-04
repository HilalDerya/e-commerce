<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\User;
use App\Models\Address;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class FrontendAddressController extends Controller
{

    public function __construct()
    {
        $this->returnUrl = "/hesabim/adreslerim";
    }

    public function index(User $user): View
    {
        return view("frontend.address.index", ["addrs" => $user->addrs, "user" => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(User $user): View
    {
        return view("frontend.address.insert_form", ["user" => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param User $user
     * @param ProductImageRequest $request
     * @return RedirectResponse
     */
    public function store(PasswordRequest $request): RedirectResponse
    {
        $addr = new Address();
        $data = $this->prepare($request, $addr->getFillable());
        $addr->fill($data);
        $addr->save();

        $this->editReturnUrl($request->user_id);

        return redirect($this->returnUrl);
    }

    private function editReturnUrl($id)
    {
        $this->returnUrl = "/hesabim/$id/adreslerim";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @param Address $address
     * @return View
     */
    public function edit(User $user, Address $adreslerim): View
    {
        return view("frontend.address.update_form", ["user" => $user, "address" => $adreslerim]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductImageRequest $request
     * @param User $user
     * @param Address $address
     * @return RedirectResponse
     */
    public function update(PasswordRequest $request, User $user, Address $adreslerim): RedirectResponse
    {   
       
        $data = $this->prepare($request, $adreslerim->getFillable());
        
        Address::where('address_id',$adreslerim->address_id)->update($data);
        
        $this->editReturnUrl($user->user_id);
        return redirect($this->returnUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(User $user, Address $address): RedirectResponse
    {
        $id = $address->address_id;
        $address->delete();
        $this->editReturnUrl($user->user_id);
        return redirect($this->returnUrl);
    }
}