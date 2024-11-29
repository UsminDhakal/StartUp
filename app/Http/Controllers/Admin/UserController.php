<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return view('admin.user.index');
    }

    public function getUser(){
        $start = 0;
        $length = 10;

        if (request()->has('start')) {
            if (request('start') >= 0) {
                $start = intval(request('start'));
            }
        }

        if (request()->has('length')) {

            if (request('length') >= 5 && request('length') <= 100) {
                $length = intval(request('length'));
            }
        }


        $staff_lists = User::where("user_role", "1")->orderBy('id', 'DESC');
        $counts = $staff_lists->count();

        $filtered_count = $staff_lists->count();
        $staff_lists->offset($start)->limit($length);


        return response()->json([
            "data" => $staff_lists->get()->map(function ($u, $i) {
                return [
                    "sn" => ++$i,
                    "id" => $u->id,
                    "name" => $u->name,
                    "email"=>$u->email,
                    "phone" => $u->phone,
                    "message" => $u->message,
                    "equity" => $u->equity,
                    "created_at" => $u->created_at,                    
                ];
            }),
            "recordsFiltered" => $filtered_count,
            "recordsTotal" => $counts
        ]);
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'equity' => 'required',
            "email" => 'required|email|unique:users,email', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->all()
            ]);
        }
        // dd($request->all());

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->equity = $request->equity;
        $user->email = $request->email;
        $user->password = Hash::make("admin123");
        $user->user_role = 1;
        $user->save();
        return response()->json(["success"=>true, "message"=>"User added successfully"]);
    }

    public function delete(){
        $id = request("id");
        $contact = User::find($id);
        $contact->delete();
        return response()->json(["success"=>true, "message"=>"User deleted successfully"]);
    }
}
