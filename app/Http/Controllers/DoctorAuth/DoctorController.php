<?php

namespace App\Http\Controllers\DoctorAuth;

use App\Diagnosis;
use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function index()
    {
        return view('doctor.home');
    }

    public function diagnosa()
    {
        $diagnosis = Diagnosis::where('id_doctor', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('doctor.diagnosa.diagnosa', [
            'diagnosis' => $diagnosis,
            'total' => $diagnosis->total(),
            'perPage' => $diagnosis->perPage(),
            'currentPage' => $diagnosis->currentPage(),
        ]);
    }

    public function profile()
    {
        $user = Doctor::find(Auth::user()->id);
        return view('doctor.profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request) {
        $id = Auth::user()->id;
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
            if ($doctor->image != 'default.png'){
                Storage::delete($doctor->image);
            }
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
        return redirect()->route('doctor.profile')->with(['success'=>'Your profile has been updated successfully']);
    }

    public function updateDiagnosa(Request $request, $id)
    {
        $this->validate($request, [
            'diagnosa' => 'required',
        ]);
        $diagnosa = Diagnosis::find($id);
        $diagnosa->diagnosis = $request->diagnosa;
        $diagnosa->update();
        return redirect()->route('doctor.diagnosa')->with(['success' => 'Diagnosa has been inserted on selected record']);
    }
}
