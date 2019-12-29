<?php

namespace App\Support;

use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class Resizer
{
    /**
     * Request file
     *
     * @var Illuminate\Http\UploadedFile
     */
    private $uploadFile;

    /**
     * Part of path to storage directory
     *
     * @var string
     */
    private $pathPrefix;

    /**
     * Image constructor
     *
     * @param Illuminate\Http\UploadedFile $uploadFile
     * @param string $pathPrefix
     */
    public function __construct(UploadedFile $uploadFile, string $pathPrefix = '')
    {
        $this->uploadFile = $uploadFile;
        $this->pathPrefix = $pathPrefix;
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
        $filename =
            hash('sha256', time()) . '-thumb-' .
            $this->uploadFile->getFilename() . '.' .
            $this->uploadFile->getClientOriginalExtension();

        $path = public_path('/storage/' . $this->pathPrefix . '/' . $filename);

        Image::make($this->uploadFile->getRealPath())
            ->resize(320, 280)
            ->save($path);

        return $this->pathPrefix . '/' . $filename;
    }
}
