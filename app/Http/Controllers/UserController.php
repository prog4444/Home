<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $inter = User::find($id);
            if(!auth()->$inter){         
                $inter->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);
                return response()->json([
                    'message' => 'Изменён!',
                ]);
            }else {
                return response()->json([
                    'message' => 'Not found'
                ], 404);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Что то работает неправильно пожалуйста обратитесь к СА!(((',
                'errors' => $th->getMessage()
            ], 422);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
