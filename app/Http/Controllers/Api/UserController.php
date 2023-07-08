<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        /*         $userArray = $user->toArray();

        $image = 'https://secure.gravatar.com/avatar/522d3a85411971750df06ad25246c8a0?s=128&d=mm&r=g';
        if ($user->foto_perfil) {
            $expiresAt = Carbon::now()->addSeconds(5);
            $imageReference = app('firebase.storage')->getBucket()->object($user->foto_perfil);
            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            };
        }
        $userArray['foto_perfil'] = $image;
        return $userArray; */
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->foto_perfil) {
            if ($user->foto_perfil) {
                if (app('firebase.storage')->getBucket()->object($user->foto_perfil)->exists()) {
                    app('firebase.storage')->getBucket()->object($user->foto_perfil)->delete();
                }
                $user->update(['foto_perfil' => null]);
            };

            $image_bin = base64_decode($request->input('foto_perfil'));
            if ($image_bin) {
                $file = $user->id . '.jpg';
                $image = Storage::disk('public_upload')->put('firebase-temp-uploads' . '/' . $file, $image_bin);
                $localfolder = public_path('firebase-temp-uploads') . '/';
                $firebase_storage_path = 'Users/';
                error_log('almacenado');
                if ($image) {
                    $uploadedfile = fopen($localfolder . $file, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                    $user->update((['foto_perfil' => $firebase_storage_path . $file]));
                    unlink($localfolder . $file);
                    error_log('eliminado');
                }
            }
        }
        $user->update($request->except(['foto_perfil', 'extension']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
