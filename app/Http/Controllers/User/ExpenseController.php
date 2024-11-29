<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserHasInvest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(){
        return view("user.expense.index");
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


        $staff_lists = UserHasInvest::where("user_id", Auth::user()->id)->with("getUser", "getTopic")->orderBy('id', 'DESC');
        $counts = $staff_lists->count();

        $filtered_count = $staff_lists->count();
        $staff_lists->offset($start)->limit($length);


        return response()->json([
            "data" => $staff_lists->get()->map(function ($u, $i) {
                return [
                    "sn" => ++$i,
                    "id" => $u->id,
                    "topic" => $u->getTopic ? $u->getTopic->title : "-",
                    "invoice_no" => $u->invoice_no,
                    "invoice_date" => $u->invoice_date,
                    "amount" => $u->amount,
                    "created_at" => $u->created_at,
                    "type" => $u->type
                ];
            }),
            "recordsFiltered" => $filtered_count,
            "recordsTotal" => $counts
        ]);
    }
}
