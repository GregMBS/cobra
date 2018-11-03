<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function load(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg|max:2048',
            'id_cuenta' => 'required|integer|exists:resumen,id_cuenta'
        ]);

        $image = $request->file('image');
        $id = $request->id_cuenta;
        $input['imagename'] = $id . '.jpg';
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        return redirect('/resumen/'.$id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $id)
    {
        return view('imageUpload')->with('id', $id);
    }
}
