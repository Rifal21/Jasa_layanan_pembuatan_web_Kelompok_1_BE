<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = Template::all();

        return response()->json($template);
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
            'kode_template' => 'required|unique:templates',
            'nama_template' => 'required',
            'slug' => 'required|unique:templates',
            'gambar' => 'image|file',
            'deskripsi' => 'required'
        ]);

        $template = new Template();

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $allowedFileExtension = ['jpeg','jpg','png'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images' , $name);
                $template->gambar = $name;
            }
        }


        $template->kode_template = $request->input('kode_template');
        $template->nama_template = $request->input('nama_template');
        $template->slug = $request->input('slug');
        $template->deskripsi = $request->input('deskripsi');

        $template->save();

        return response()->json($template);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);

        return response()->json($template);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'kode_template' => 'required|unique:templates',
            'nama_template' => 'required',
            'slug' => 'required|unique:templates',
            'gambar' => 'image|file',
            'deskripsi' => 'required'
        ]);

        $template = Template::find($id);

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $allowedFileExtension = ['jpeg','jpg','png'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images' , $name);
                $template->gambar = $name;
            }
        }


        $template->kode_template = $request->input('kode_template');
        $template->nama_template = $request->input('nama_template');
        $template->slug = $request->input('slug');
        $template->deskripsi = $request->input('deskripsi');

        $template->save();

        return response()->json($template);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        $template->delete();
        return response()->json('Delete template berhasil!');
    }
}
