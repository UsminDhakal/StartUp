<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function index()
    {
        return view('admin.topic.index');
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


        $staff_lists = Topic::orderBy('id', 'DESC');
        $counts = $staff_lists->count();

        $filtered_count = $staff_lists->count();
        $staff_lists->offset($start)->limit($length);


        return response()->json([
            "data" => $staff_lists->get()->map(function ($u, $i) {
                return [
                    "sn" => ++$i,
                    "id" => $u->id,
                    "title" => $u->title,
                    "is_active" => $u->status,
                    "created_at" => $u->created_at,
                ];
            }),
            "recordsFiltered" => $filtered_count,
            "recordsTotal" => $counts
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:topics,title',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->all()
            ]);
        }
        // dd($request->all());

        $user = new Topic();
        $user->title = $request->name;
        $user->save();
        return response()->json(["success" => true, "message" => "User added successfully"]);
    }

    public function delete()
    {
        $id = request("id");
        $contact = Topic::find($id);
        $contact->delete();
        return response()->json(["success" => true, "message" => "User deleted successfully"]);
    }

    public function status()
    {
        $id = request("id");
        $contact = Topic::find($id);
        $contact->status = $contact->status == "1" ? "0" : "1";
        $contact->save();
        return response()->json(["success" => true, "message" => "Status changed successfully"]);
    }

    public function getTotalAmount()
    {
        $id  = request("id");
        $topic = Topic::where("id", $id)->with("getAmount")->first();
        $amount = 0;
        foreach ($topic->getAmount as $key => $value) {
            $amount += $value->amount;
        }


        return response()->json(["success" => true, "amount" => $amount]);
    }
}
