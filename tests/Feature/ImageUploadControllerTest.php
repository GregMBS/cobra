<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageUploadControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/imageUpload/1');
        $response->assertViewIs('imageUpload');
    }

    public function testLoad()
    {
        $user = User::first();
        $file = new UploadedFile('/home/gmbs/Pictures/me2016.jpg', '1.jpg', 'image/jpeg',null, null,true);
        $this->actingAs($user)->post('/imageUpload/1', [
            'avatar' => $file,
            'id' => 1
        ]);

        $this->isThere();
    }

    private function isThere()
    {
        $filePath = public_path('/images/1.jpg');
        $this->assertFileExists($filePath);
        $this->assertFileIsReadable($filePath);
        $type = mime_content_type($filePath);
        $this->assertEquals('image/jpeg', $type);
    }

    public function testShow()
    {
        $this->isThere();
    }
}
