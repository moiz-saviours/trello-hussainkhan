<?php

namespace App\Http\Controllers;

use App\Models\Board_List;

use Illuminate\Http\Request;

class ApiBoardListController extends Controller
{
    public function index(Request $request)
    {
        $board_list = Board_List::with('cards')->get();

        //return view('board_list.index' , compact('board_list'));
        return response()->json(['board' => $board_list], 200);
    }

    public function edit(Request $request, Board_List $board_list)
    {
        if (!$board_list->id) {
            return response()->json(['error' => 'Record Not Found']);
        }
        $board_list->loadMissing('cards');
        return response()->json(['board_list' => $board_list], 200);
    }



    public function store(Request $request)
    {
        $board_list = Board_List::create([

            'name' => $request->name,
            'is_active' => $request->is_active ?? true,

        ]);
        return response()->json(['board_list' => $board_list]);
    }


    public function toggleStatus(Request $request, $id)
    {
        $board_list = Board_List::findOrFail($id);
        $board_list->is_active = $request->is_active;
        $board_list->save();

        return response()->json(['success' => 'Status updated successfully']);
    }
}
