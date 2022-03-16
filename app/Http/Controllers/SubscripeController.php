<?php

namespace App\Http\Controllers;
use App\Models\Subscripe;

use Illuminate\Http\Request;

class SubscripeController extends Controller
{
    public function store(Request $request)
    {
        $data = request()->all();
        $Subscripe = Subscripe::create([
            // data from form
            'user_id' => $data['user_id'],
            'promo_id' => $data['promo_id'],
        ]);
        return $Subscripe;
    }

    public function index()
    {
        $allSubscripes = Subscripe::get();
        return $allSubscripes;
    }


    public function destroy($SubscripeId)
    {
        $oneSubscripe = Subscripe::findOrFail($SubscripeId);
        $oneSubscripe->delete();
        return  $oneSubscripe;
    }


    public function show($SubscripeId)
    {
        $Subscripe = Subscripe::get()->find($SubscripeId);
        return $Subscripe;
    }

    public function update($SubscripeId, Request $request)
    {
        $data = $request->all();
        $oneSubscripe = Subscripe::findOrFail($SubscripeId);
        $oneSubscripe->update([
            'user_id' => (isset($data['user_id'])) ? $data['user_id'] : $oneSubscripe->user_id,
            'promo_id' => isset($data['promo_id']) ? $data['promo_id'] : $oneSubscripe->promo_id,
        ]);
        return $oneSubscripe;
    }






}
