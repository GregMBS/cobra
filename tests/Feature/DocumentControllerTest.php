<?php

namespace Tests\Feature;

use App\Http\Controllers\DocumentController;
use App\Resumen;
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

    public function setUp(): void
    {
        parent::setUp();
        $this->dc = new DocumentController();
        $this->user = User::first();
    }

    public function testIndex()
    {
        $resumen = Resumen::all()->first();
        $response = $this->dc->index($resumen->id_cuenta);
        $this->assertInstanceOf(View::class, $response);
        $url = '/documents/' . $resumen->id_cuenta;
        $response = $this->actingAs($this->user)->get($url);
        $response->assertViewIs('documents');
    }

    public function testStore()
    {
        /** @var Resumen $resumen */
        $resumen = Resumen::all()->first();
        /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $file = new \Symfony\Component\HttpFoundation\File\UploadedFile(public_path('/FISA.jpg'), 'FISA.jpg');

        $response = $this->actingAs($this->user)->post('/documents/' . $resumen->id_cuenta, [
           'document' => $file
        ]);

        // Assert the file was stored...
        $this->assertTrue($resumen->hasMedia('documents'));
        Storage::disk()->put(public_path('/FISA.jpg'), $file);

    }

    public function testRemove()
    {
        /** @var Resumen $resumen */
        $resumen = Resumen::all()->first();
        $rid = $resumen->id_cuenta;
        /** @var Collection $documents */
        $documents = $resumen->getMedia('documents');
        /** @var MediaCollection $document */
        foreach ($documents as $document) {
            $docId = $document->id;
            $url = "/documents/$rid/$docId";
            $response = $this->actingAs($this->user)->delete($url);
            $this->assertTrue($response);
        }
        $this->assertFalse($resumen->hasMedia('documents'));
    }
}
