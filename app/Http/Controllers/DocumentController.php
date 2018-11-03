<?php

namespace App\Http\Controllers;

use App\Debtor;
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
        $debtor = Debtor::find($id);
        if ($debtor) {
            $debtor->addMedia($request->file('document'))->toMediaCollection('documents');
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
        $debtor = Debtor::find($id);
        if ($debtor) {
            if ($debtor->hasMedia('documents')) {
                /** @var Collection $documents */
                $documents = $debtor->getMedia('documents');
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
        $debtor = Debtor::find($id);
        if ($debtor) {
            if ($debtor->hasMedia('documents')) {
                try {
                    /** @var Collection $documents */
                    $documents = $debtor->getMedia('documents');
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
