<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DoctorController extends Controller
{
    /**
     * DoctorController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $doctors = Doctor::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.doctor.doctor', [
            'doctors' => $doctors,
            'total' => $doctors->total(),
            'perPage' => $doctors->perPage(),
            'currentPage' => $doctors->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|min:6',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $doctor = new Doctor();
        $image = $request->file('image')->store('doctors');
        $doctor->image = $image;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = bcrypt($request->password);
        $doctor->address = $request->address;
        $doctor->phone = $request->phone;
        $doctor->save();

        return redirect()->route('admin.doctor')->with(['success'=>'A new doctor has been created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('admin.doctor.edit', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'email' => "required|email|unique:doctors,email,$id",
            'phone' => 'required',
            'address' => 'required',
        ]);

        $doctor = Doctor::find($id);

        if ($request->image != null){
            $image = $request->file('image')->store('doctors');
            Storage::delete($doctor->image);
            $doctor->image = $image;
        }
        $doctor->name = $request->name;
        if($doctor->email != $request->email){
            $doctor->email = $request->email;
        }
        if($request->password != null) {
            $doctor->password = bcrypt($request->password);
        }
        $doctor->address = $request->address;
        $doctor->phone = $request->phone;

        $doctor->update();
        return redirect()->route('admin.doctor')->with(['success'=>'A chosen doctor has been updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('admin.doctor')->with(['success'=>'A chosen doctor has been deleted successfully']);
    }
}
