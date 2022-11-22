<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartiment\StoreRequest;
use App\Http\Requests\Apartiment\UpdateRequest;
use App\Http\Requests\PhotoRequest;
use App\Models\Apartment;
use App\Models\Photo;
use Illuminate\Http\Request;

class ApartimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartiments = Apartment::with()
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if(!isset($data['description'])){
            $data['description'] = null;
        }
        if(!isset($data['address'])){
            $data['address'] = null;
        }
        if(!isset($data['price'])){
            $data['price'] = null;
        }
        if(!isset($data['how_many_rooms'])){
            $data['how_many_rooms'] = null;
        }
        $apartiment = Apartment::query()->create($data);
        return response()->json([
            'message' => 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data = $request->validated();
        $data = $this->data($data);
        $apartiment = Apartment::query()->find($id);
        $apartiment->update($data);
        return response()->json([
            'message' => 'ok'
        ]);
    }

    private function data($data){
        if(!isset($data['description'])){
            $data['description'] = null;
        }
        if(!isset($data['address'])){
            $data['address'] = null;
        }
        if(!isset($data['price'])){
            $data['price'] = null;
        }
        if(!isset($data['how_many_rooms'])){
            $data['how_many_rooms'] = null;
        }
        return $data;
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

     /**
     * Store The foto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeMedia(PhotoRequest $request)
    {
        $data = $request->validated();
        if(!isset($data['description'])){
            $data['description'] = null;
        }
        if(!isset($data['address'])){
            $data['address'] = null;
        }
        if(!isset($data['price'])){
            $data['price'] = null;
        }
        if(!isset($data['how_many_rooms'])){
            $data['how_many_rooms'] = null;
        }
        $apartiment = Apartment::query()->create($data);
        $post->addMediaFromRequest('images')->toMediaCollection();
        return response()->json([
            "message" => 'Фотография добавлено'
        ]);
    }

    public function deleteMedia()
    {

    }
}
