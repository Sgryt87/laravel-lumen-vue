<?php

namespace App\Http\Controllers;

use App\Board;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['only' => 'store']);
        //['except' => ['index', 'show']
        $this->middleware('auth'); // all
    }

    public function index()
    {
        $boards = Auth::user()->boards;

        return response()->json([
            'status' => 'success',
            'data'   => $boards
        ], 200);
    }

    public function show($id)
    {
        $board = Board::find($id);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status' => 'error',
                'data'   => 'Unauthorized'
            ], 403);
        }

        return $board;
    }

    public function store(Request $request)
    {
        Auth::user()
            ->boards()
            ->create([
                'name' => $request->name
            ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $board = Board::find($id);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status' => 'error',
                'data'   => 'Unauthorized'
            ], 403);
        }
        $board->update($request->all());

        return response()->json([
            'status' => 'success',
            'data'   => $board
        ], 200);
    }

    public function destroy($id)
    {
        $board = Board::find($id);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json([
                'status' => 'error',
                'data'   => 'Unauthorized'
            ], 403);
        }

        if (Board::destroy($id)) {
            return response()->json([
                'status' => 'success',
                'data'   => 'Board Deleted Successfully'
            ], 204);
        }

        return response()->json([
            'status' => 'error',
            'data'   => 'Something went wrong...'
        ], 500);
    }
}
