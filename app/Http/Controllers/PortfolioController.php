<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = Portfolio::all();

        return response()->json($portfolio);
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
        $this->validate($request,[
            'judul' => 'required',
            'slug' => 'required|unique:portfolios',
            'gambar' => 'image|file',
            'deskripsi' => 'required'
        ]);

        $portfolio = new Portfolio();

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $allowedFileExtension = ['jpeg','jpg','png'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images' , $name);
                $portfolio->gambar = $name;
            }
        }
        // if($request->file('gambar')){
        //     $validatedData['gambar'] = $request->file('gambar')->store('gambar-portfolio'); 
        // }

        $portfolio->judul = $request->input('judul');
        $portfolio->slug = $request->input('slug');
        $portfolio->deskripsi = $request->input('deskripsi');

        $portfolio->save();

        return response()->json($portfolio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);

        return response()->json($portfolio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            'slug' => 'required|unique:portfolios',
            'gambar' => 'image|file',
            'deskripsi' => 'required'
        ]);

        $portfolio = Portfolio::find($id);

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $allowedFileExtension = ['jpeg','jpg','png'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images' , $name);
                $portfolio->gambar = $name;
            }
        }
        // if($request->file('gambar')){
        //     $validatedData['gambar'] = $request->file('gambar')->store('gambar-portfolio'); 
        // }

        $portfolio->judul = $request->input('judul');
        $portfolio->slug = $request->input('slug');
        $portfolio->deskripsi = $request->input('deskripsi');

        $portfolio->save();

        return response()->json($portfolio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->delete();
        return response()->json('Delete portfolio berhasil!');
    }
}
