<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Wheel;
use Illuminate\Http\Request;

class WheelController extends Controller
{
    /**
     * Retrieve the wheel for the given GUID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($uuid)
    {

        if ($uuid === "random") {
            return $this->getRandomWheel();
        }

        $result = Wheel::findOrFail($uuid);
        // dd($result);

        return response()->json(json_decode($result->data));
    }

    public function create(Request $request) {
        $wheel = new Wheel;
        
        $wheel->data = $request->getContent();
        $wheel->save();

        // return array("id" => $wheel->id);
        return url('/') . '/' . $wheel->id;
    }
    

    public function getRandomWheel() {
        $result =  DB::table('wheels')
            ->where('public', true)
            ->inRandomOrder()
            ->first();

        return $this->show($result->id);
    }
}
