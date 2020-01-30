<?php

namespace App\Http\Controllers;

class WheelController extends Controller
{
    /**
     * Retrieve the wheel for the given GUID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($guid)
    {
        return Wheel::findOrFail($guid);
    }
    //
}
