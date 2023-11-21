<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validate;
use App\Models\Recipes;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Data recovery successfully.',
            'data' => Recipes::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $validate = Validate::make($request->all(), [
            'recipe' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'price' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => 'Please, verify data typed',
            ], 404);
        }

        try {
            $recipes = Recipes::create([
                'name' => $request->get('name'),
                'instructions' => $request->get('instructions'),
                'ingredients' => $request->get('ingredients'),
                'price' => $request->get('price')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }

        return response()->json([
            'message' => 'Recipe created successfully.',
            'recipes' => [
                'id' => $recipes->id,
                'name' => $recipes->name,
                'ingredients' => $recipes->ingredients,
                'instructions' => $recipes->instructions,
                'price' => $recipes->price
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $recipes = Recipes::find($id);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }

        return response()->json([
            'message' => 'Data recovery successfully',
            'data' => $recipes
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $validate = Validate::make($request->all(), [
            'recipe' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'price' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => 'Please verify data typed.',
            ], 404);
        }

        $recipe = Recipes::find($id);

        if (empty($recipe)) {
            return response()->json([
                'error' => 'Recipe does not exists.'
            ], 400);
        }

        try {
            $recipe->recipe = $request->get('name');
            $recipe->ingredients = $request->get('ingredients');
            $recipe->price = $request->get('price');
            $recipe->instructions = $request->get('instructions');
            $recipe->save();
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }

        return response()->json([
            'message' => 'Recipe updated successfullly.',
            'data' => $recipe
        ], 200);
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
