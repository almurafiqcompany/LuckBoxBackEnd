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
            'code' => $data['code'],
            'counter' => $data['counter'],

        ]);
        return $Subscripe;
    }

    public function index()
    {
        $allSubscripes = Subscripe::with('user')->get();
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
            'counter' => isset($data['counter']) ? $data['counter'] : $oneSubscripe->counter,
        ]);
        return $oneSubscripe;
    }


    function search($name, Request $request)
    {
        $data = $request->all();
        $resultCode = Subscripe::with('user')->where('code', 'LIKE','%'.$name.'%')->where('counter','10')->get();
        return Response()->json(['resultCode'=>$resultCode]);
    }



}
