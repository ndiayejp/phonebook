<?php

namespace App\Http\Controllers;

use App\PhoneBook;
use Illuminate\Http\Request;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('phonebook');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|min:5',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:phonebooks'
        ]);
        $phonebook = new PhoneBook;
        $phonebook->name   = $request->name;
        $phonebook->phone   = $request->phone;
        $phonebook->email   = $request->email;
        $phonebook->save();
        return $phonebook;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneBook $phoneBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function edit(PhoneBook $phoneBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $attributes = request()->validate([
            'name' => 'required|min:5',
            'phone' => 'required|numeric',
            'email' => 'required|email'
        ]);
        $phonebook = PhoneBook::find($id);
        $phonebook->name = $request->name;
        $phonebook->phone = $request->phone;
        $phonebook->email = $request->email;
        $phonebook->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhoneBook  $phoneBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        PhoneBook::where('id', $id)->delete();
        return 204;
    }

    public function getData()
    {
        return PhoneBook::orderBy('name', 'DESC')->get();
    }
}
