<?php

namespace Tests\Feature;

use App\Http\Controllers\DocumentController;
use App\Debtor;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollection\MediaCollection;
use Storage;
use Tests\TestCase;

class DocumentControllerTest extends TestCase
{

    /** @var DocumentController */
    private $dc;

    /** @var User */
    private $user;

    /** @var Debtor */
    private $resumen;

    public function setUp()
    {
        parent::setUp();
        $this->dc = new DocumentController();
        $this->user = User::first();
        $this->resumen = Debtor::first();
    }

    public function testIndex()
    {
        $response = $this->dc->index($this->resumen->id_cuenta);
        $this->assertInstanceOf(View::class, $response);
        $url = '/documents/' . $this->resumen->id_cuenta;
        $response = $this->actingAs($this->user)->get($url);
        $response->assertViewIs('documents');
    }

    public function testStore()
    {
        /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $file = new \Symfony\Component\HttpFoundation\File\UploadedFile(public_path('/FISA.jpg'), 'FISA.jpg');

        $response = $this->actingAs($this->user)->post('/documents/' . $this->resumen->id_cuenta, [
           'document' => $file
        ]);

        // Assert the file was stored...
        $this->assertTrue($this->resumen->hasMedia('documents'));
        Storage::disk()->put(public_path('/FISA.jpg'), $file);

    }

    public function testRemove()
    {
        $rid = $this->resumen->id_cuenta;
        /** @var Collection $documents */
        $documents = $this->resumen->getMedia('documents');
        /** @var MediaCollection $document */
        foreach ($documents as $document) {
            $docId = $document->id;
            $url = "/documents/$rid/$docId";
            $response = $this->actingAs($this->user)->delete($url);
            $this->assertTrue($response);
        }
        $this->assertFalse($this->resumen->hasMedia('documents'));
    }
}
