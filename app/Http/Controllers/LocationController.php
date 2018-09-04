<?php

namespace App\Http\Controllers;

use App\Location;
use App\Convention;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Redirect;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $convention = Convention::find($id);
        return view('calendar.convention.location.create')->with('convention' , $convention);
    }

   public function set(Request $request) {
        $convention = Convention::find($request->convention);
        $convention->location_id = $request->location;
        $convention->save();

        return redirect('/calendar/convention/'.$convention->id.'/location/change')->with('status' , 'location changed');
   }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:140',
            'address1'  => 'required|max:140',
            'address2'  => 'max:140',
            'link'  => 'max:240',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $location = new Location();
        $location->name = $request->name;
        $location->address1 = $request->address1;
        $location->address2 = $request->address2;
        $location->link = $request->link;

        $location->save();

        return redirect('/calendar/convention/' .$request->convention . '/location/change')->with('status', 'location Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $convention = Convention::find($id);
        return view('calendar.convention.location.show')->with('convention' , $convention);
    }

    public function change($id)
    {
        $convention = Convention::find($id);
        $locations = Location::all();
        return view('calendar.convention.location.change')->with('convention' , $convention)->with('locations' , $locations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convention = Convention::find($id);
        $location = Location::find($convention->location_id);
        return view('calendar.convention.location.edit')
        ->with('convention' , $convention)->with('location', $location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:140',
            'address1'  => 'required|max:140',
            'address2'  => 'max:140',
            'link'  => 'max:240',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        $location = Location::find($id);
        $location->name = $request->name;
        $location->address1 = $request->address1;
        $location->address2 = $request->address2;
        $location->link = $request->link;

        $location->save();

        return redirect('/calendar/convention/' .$request->convention . '/manage')->with('status', 'location updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
