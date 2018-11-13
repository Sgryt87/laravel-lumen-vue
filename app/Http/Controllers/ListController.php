<?php

namespace App\Http\Controllers;

use App\Board;
use App\Lists;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $board = Board::find($id);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status' => 'error',
                'data'   => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $board->lists
        ], 200);
    }

    public function show($boardId, $listId)
    {
        $board = Board::find($boardId);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status' => 'error',
                'data'   => 'Unauthorized'
            ], 403);
        }

        $list = $board->lists()->find($listId);

        return response()->json([
            'status' => 'success',
            'data'   => $list
        ], 200);
    }


    public function store(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);

        $board = Board::find($id);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status' => 'error',
                'data'   => 'Unauthorized'
            ], 403);
        }

        $board->lists()->create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function update(Request $request, $boardId, $listId)
    {
        $this->validate($request, ['name' => 'required']);

        $board = Board::find($boardId);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status'  => 'error',
                'data' => 'Unauthorized'
            ], 403);
        }
        $board->update($request->all());

        return response()->json([
            'status'  => 'success',
            'data' => $board
        ], 200);
    }

    public function destroy($boardId, $listId)
    {
        $board = Board::find($boardId);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status'  => 'error',
                'data' => 'Unauthorized'
            ], 403);
        }

        $list = $board->lists()->find($listId);

        if ($list->delete()) {
            return response()->json([
                'status'  => 'success',
                'data' => 'List Deleted Successfully'
            ], 204);
        }

        return response()->json([
            'status'  => 'error',
            'data' => 'Something went wrong...'
        ], 500);
    }
}