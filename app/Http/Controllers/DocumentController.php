<?php

namespace App\Http\Controllers;

use App\Resumen;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Models\Media;

class DocumentController extends Controller
{
    /**
     * @param int $id
     * @param Request $request
     * @return bool
     */
    public function store(int $id, Request $request)
    {
        $resumen = Resumen::find($id);
        if ($resumen) {
            $resumen->addMedia($request->file('document'))->toMediaCollection('documents');
            return true;
        }
        return false;
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $id)
    {
        $output = new Collection();
        $resumen = Resumen::find($id);
        if ($resumen) {
            if ($resumen->hasMedia('documents')) {
                /** @var Collection $documents */
                $documents = $resumen->getMedia('documents');
                /** @var Media $document */
                foreach ($documents as $docId => $document) {
                    $item = [
                        'id' => $docId,
                        'name' => $document->name,
                        'url' => $document->getUrl()
                    ];
                    $output->push($item);
                }
            }
        }
        $view = view('documents')->with('files', $output);
        return $view;
    }


    /**
     * @param int $id
     * @param int $docId
     * @return bool
     */
    public function remove(int $id, int $docId)
    {
        $resumen = Resumen::find($id);
        if ($resumen) {
            if ($resumen->hasMedia('documents')) {
                try {
                    /** @var Collection $documents */
                    $documents = $resumen->getMedia('documents');
                    /** @var Media $document */
                    if (isset($documents[$docId])) {
                        $document = $documents[$docId];
                        $document->delete();
                        return true;
                    }
                } catch (\Exception $e) {
                    return false;
                }
            }
        }
        return false;
    }
}
