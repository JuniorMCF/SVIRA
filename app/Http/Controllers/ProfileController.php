<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profile = Profile::where('user_id',Auth::user()->id)->first();

        //var_dump(json_decode($profile));

        return view('profile',['profile'=>$profile]);  

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
    public function update(Request $request)
    {
        //
        $user_id = $request->id;

        $user = User::find($user_id);

        $user->name = $request->name;
        $user->save();

        $profile = Profile::where('user_id',$user_id)->first();
        $profile->age = $request->age;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->phone_number = $request->phone_number;
        $profile->address = $request->address;
        

        if($request->hasFile('file')){
                //
                $upload_path = public_path('photos');
    
                $file = $request->file('file');
    
                $mime = $file->getMimeType();
                if ($mime == "image/gif" || $mime == "image/png" || $mime == "image/jpeg" || $mime == "image/bmp" ) 
                {
                    //vamos a remover la anterior foto subida a la base de datos
                    
                    $previous_profile = Profile::find($request->id);
                    $path_previous_image = public_path($previous_profile->url_image);
                    if(file_exists($path_previous_image)){
                        File::delete($path_previous_image);
                    }
                    $file_name = $request->file->getClientOriginalName();
                    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $name = pathinfo($file_name,PATHINFO_FILENAME);   
                    $filename = $name.time().'.'.$ext;
                    $generated_new_name = $filename;
                    $request->file->move($upload_path, $generated_new_name);

                    $request->merge([
                        'url_image' => "photos/".$generated_new_name,
                    ]);
                    

                    $profile->url_image = $request->url_image;
                }else{
                    $profile->save();

                    return redirect()->back()->with('message', 'La foto subida no tiene un formato válido');
                }
        }

        $profile->save();

        return redirect()->back()->with('message', 'Datos actualizados!');

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
