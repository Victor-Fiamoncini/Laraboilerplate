<?php

namespace App\Support;

use finfo;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Resizer
{
    /**
     * Part of path to storage directory
     *
     * @var string
     */
    private $pathPrefix;

    /**
     * Request file
     *
     * @var Illuminate\Http\UploadedFile
     */
    private $uploadFile;

    /**
     * Resizer constructor
     *
     * @param string $pathPrefix
     * @param Illuminate\Http\UploadedFile $uploadFile
     */
    public function __construct(string $pathPrefix = '', UploadedFile $uploadFile = null)
    {
        $this->pathPrefix = $pathPrefix;
        $this->uploadFile = $uploadFile;
    }

    /**
     * Save the original file
     *
     * @return string
     */
    public function storeOriginalImage(): string
    {
        return $this->uploadFile->store($this->pathPrefix);
    }

    /**
     * Resizes the image and returns its path
     *
     * @return string
     */
    public function makeThumb(): string
    {
        $filename = Str::random(16) . '-thumb-' . $this->uploadFile->getClientOriginalName();
        $path = public_path('/storage/' . $this->pathPrefix . '/' . $filename);

        Image::make($this->uploadFile->getRealPath())->resize(320, 320)->save($path);

        return $this->pathPrefix . '/' . $filename;
    }

    /**
     * Resizes the image from external url and returns its path
     *
     * @param string $url
     * @return string
     */
    public function makeThumbFromUrl(string $url): string
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = explode('/', $finfo->buffer(file_get_contents($url)))[1];

        $filename = basename($url) . '.' . $mimeType;

        $path = public_path('/storage/' . $this->pathPrefix . '/' . $filename);

        Image::make($url)->resize(320, 320)->save($path);

        return $this->pathPrefix . '/' . $filename;
    }


}
