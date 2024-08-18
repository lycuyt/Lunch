<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eatery;

class EateryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eateries = Eatery::paginate(7);
        // dd($eateries);
        return view('eatery.index', [
            'eateries' => $eateries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eatery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        $generatedImageName = 'image' . time() . '-'
            . $request->name . '.'
            . $request->image->extension();
        $request->image->move(public_path('images'), $generatedImageName);
        $eatery = Eatery::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'image' => $generatedImageName,
        ]);

        $eatery->save();
        return redirect('/eatery')->with('success', 'Eatery has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eatery = Eatery::findOrFail($id);
        return view('eatery.edit')->with('eatery', $eatery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048', // Image is optional
        ]);

        $eatery = Eatery::findOrFail($id);

        // Only update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            $generatedImageName = 'image' . time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $generatedImageName);
            $eatery->image = $generatedImageName;
        }

        $eatery->name = $request->input('name');
        $eatery->address = $request->input('address');
        $eatery->phone = $request->input('phone');

        $eatery->save();

        return redirect('/eatery')->with('success', 'Eatery has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eatery = Eatery::find($id);
        $eatery->delete();
        return redirect('/eatery')->with('success', 'Eatery has been deleted');
    }
}
