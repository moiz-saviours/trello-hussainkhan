<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Board_List;
use Illuminate\Support\Facades\Validator;

class ApiCardsController extends Controller
{

    public function index(Request $request, Board_List $board_list)
    {
        if (!$board_list->id) {
            return response()->json(['error' => 'Record Not Found']);
        }
        $cards = Cards::where('board_list_id', $board_list->id)->get();
        return response()->json(['cards' => $cards], 200);
    }


    public function store(Request $request)
    {
        $rules = [
            'board_list_id' => 'required|integer',
        ];
        $validator = Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            return response()->json(['error', $validator->errors], 422);
        }
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $card = Cards::create([
            'board_list_id' => $request->board_list_id,
            'name' => $request->name,
            'startdate' => $request->startdate,
            'duedate' => $request->duedate,
            'tags' => $request->tags,
            'image' => $imageName,
            'priority' => $request->priority,

        ]);



        return response()->json($card);
    }
}
