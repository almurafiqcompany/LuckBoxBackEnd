<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promocode;

class PromocodeController extends Controller
{
    public function store(Request $request)
    {
        $data = request()->all();
        $Promocode = Promocode::create([
            // data from form
            'code' => $data['code'],
        ]);
        return $Promocode;
    }

public function index()
    {
        $allPromocodes = Promocode::get();
        return $allPromocodes;
    }


    public function destroy($PromocodeId)
    {
        $onePromocode = Promocode::findOrFail($PromocodeId);
        $onePromocode->delete();
        return  $onePromocode;
    }


    public function show($PromocodeId)
    {
        $Promocode = Promocode::get()->find($PromocodeId);
        return $Promocode;
    }

    public function update($PromocodeId, Request $request)
    {
        $data = $request->all();
        $onePromocode = Promocode::findOrFail($PromocodeId);
        $onePromocode->update([
            'code' => (isset($data['code'])) ? $data['code'] : $onePromocode->code,
        ]);
        return $onePromocode;
    }
}
