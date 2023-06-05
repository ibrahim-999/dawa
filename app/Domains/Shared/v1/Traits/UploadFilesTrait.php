<?php

namespace App\Domains\Shared\v1\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\UploadedFileException;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

trait UploadFilesTrait
{
    /**
     * Upload file.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param Model $model
     * @param string $type
     * @param string $folder
     *
     * @return Image .
     */
    public function uploadFile(UploadedFile $file, Model $model, $type = 'profile', string $folder = ''): Model
    {
        $path = $this->uploadToStorage($file, $folder);

        $image = $model->images()->create([
                'url' => $path,
                'type' => $type,
            ]);

        return $image;
    }

    /**
     * Upload file to s3.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     *
     * @throws \App\Exceptions\UploadedFileException
     * @return string file path info.
     */
    private function uploadToStorage(UploadedFile $file, string $folder): string
    {
        $filePath = $this->prepareFilePath($file, $folder);

        Storage::disk('public')->put($filePath, file_get_contents($file), 'public');

        return $filePath;
    }

    /**
     * Prepare file path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     *
     * @return string file path info.
     */
    private function prepareFilePath(UploadedFile $file, string $folder): string
    {
        $name = $this->prepareFileName($file);

        $filePath = "{$folder}/" . $name;

        return $filePath;
    }

    /**
     * Prepare file name.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string The file name.
     */
    private function prepareFileName(UploadedFile $file): string
    {
        $name = date('ymd') . '_' . time() . rand(1, 100);

        $ext = $file->getClientOriginalExtension();

        return $name . '.' . $ext;
    }

    /**
     * Delete old files.
     *
     * @param string $fileName
     * @return void
     */
    public function deleteFile(string $fileName)
    {
        if (Storage::exists($fileName)) Storage::delete($fileName);
    }
}
