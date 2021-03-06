<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ImageUploadController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function load(Request $request)
    {
        try {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,jpg|max:2048',
                'id_cuenta' => 'required|integer|exists:resumen,id_cuenta'
            ]);
        } catch (ValidationException $e) {
            throw $e;
        }

        $image = $request->file('image');
        $id_cuenta = $request->id_cuenta;
        $input['imagename'] = $id_cuenta . '.jpg';
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        return redirect('/resumen/'.$id_cuenta);
    }

    /**
     * @param $id_cuenta
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id_cuenta)
    {
        return view('imageUpload')->with('id', $id_cuenta);
    }
}
