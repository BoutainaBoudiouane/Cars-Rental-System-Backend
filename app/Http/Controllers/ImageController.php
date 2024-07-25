<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function getImage($filename)
{
    $image = Storage::get('public/images/' . $filename);

    return new Response($image, 200, [
        'Content-Type' => 'image/jpeg', // Update the content type if necessary
    ]);
}

}
