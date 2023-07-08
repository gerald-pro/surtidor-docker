<?php

namespace App\Http\Controllers;

use App\Models\UserBomba;
use Illuminate\Http\Request;


class UserBombaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        $userbombas=UserBomba::where('user_id',$user->id)->get();
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBomba  $userBomba
     * @return \Illuminate\Http\Response
     */
    public function show(UserBomba $userBomba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBomba  $userBomba
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBomba $userBomba)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserBomba  $userBomba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBomba $userBomba)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBomba  $userBomba
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBomba $userBomba)
    {
        //
    }
}
