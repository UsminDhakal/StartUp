<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use App\Models\UserHasInvest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FundsController extends Controller
{
    public function index()
    {
        $topics = Topic::where("status", "1")->get();
        $users = User::where("user_role", "1")->get();
        return view('admin.funds.index', compact("topics", "users"));
    }

    public function getTopic()
    {
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


        $staff_lists = UserHasInvest::with("getUser", "getTopic")->orderBy('id', 'DESC');
        $counts = $staff_lists->count();

        $filtered_count = $staff_lists->count();
        $staff_lists->offset($start)->limit($length);


        return response()->json([
            "data" => $staff_lists->get()->map(function ($u, $i) {
                return [
                    "sn" => ++$i,
                    "id" => $u->id,
                    "title" => $u->title,
                    "topic" => $u->getTopic ? $u->getTopic->title : "-",
                    "invoice_no" => $u->invoice_no,
                    "invoice_date" => $u->invoice_date,
                    "amount" => $u->amount,
                    "created_at" => $u->created_at,
                ];
            }),
            "recordsFiltered" => $filtered_count,
            "recordsTotal" => $counts
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'topic' => 'required',
            'amount' => 'required',
            'invoice_no' => 'required',
            'invoice_date' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->all()
            ]);
        }
        // dd($request->all());

        $id = request("id");

        $user = UserHasInvest::find($id) ? UserHasInvest::find($id) : new UserHasInvest();
        $user->user_id = $request->user;
        $user->topic_id = $request->topic;
        $user->amount = $request->amount;
        $user->invoice_no = $request->invoice_no;
        $user->invoice_date = $request->invoice_date;
        $user->type = $request->type;
        $user->save();
        return response()->json(["success"=>true, "message"=>"Fund added successfully"]);
    }
    public function edit(){
        $id = request()->id;
        $user = UserHasInvest::find($id);
        return response()->json(["success"=>true, "data"=>$user]);
    }


    public function delete(){
        $id = request("id");
        $contact = UserHasInvest::find($id);
        $contact->delete();
        return response()->json(["success"=>true, "message"=>"Fund deleted successfully"]);
    }
}
