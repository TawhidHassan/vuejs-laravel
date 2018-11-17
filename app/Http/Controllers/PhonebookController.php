<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phonebook;
use App\Http\Requests\PhonebookRequest;
class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phonebook');
    }
    public function alldata()
    {
       return Phonebook::orderBy('name','ASC')->get();
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
    public function store(PhonebookRequest $request)
    {
        $phone =new Phonebook;
        $phone->name=$request->name;
        $phone->email=$request->email;
        $phone->phone=$request->phone;
        $phone->save();
        return $phone;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request, $id)
    {
        $phone =Phonebook::find($id);
        $phone->name=$request->name;
        $phone->email=$request->email;
        $phone->phone=$request->phone;
        $phone->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Phonebook::where('id',$id)->delete();
    }
}
