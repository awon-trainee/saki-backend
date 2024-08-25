<?php

namespace App\Http\Services;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UploadService
{
    public function uploadFile($file, $type, Model $model , $background = false): void
    {
        if (! $file) {
            return;
        }

        $fileData['type'] = $type;
        $fileData['original_name'] = $file->getClientOriginalName();
        $fileData['file_name'] = $file->hashName();
        $fileData['mime'] = $file->getClientMimeType();
        $fileData['file_size'] = $file->getSize();
        $fileData['user_id'] = backpack_auth()->id();
        $fileData['background'] = $background;

        $upload = new Upload($fileData);
        if (Storage::disk('digitalocean')->put($type, $file , 'public')) {
            if($fileUpdate = $model->upload?->where('background' , $background)->first()) {
                $fileUpdate->update($fileData);
            } else {
                $model->upload()->save($upload);
            }

            return;
        }
        Log::error('failed to upload file', ['file' => $upload]);
        throw new BadRequestException('Failed to upload files, try again'. $upload);
    }


    public static function getFullPublicUrl($fileName , $folder): ?string
    {
        if (! $fileName) {
            return null;
        }

        return config('filesystems.disks.digitalocean.url').'/'.$folder.'/'.$fileName;
    }
}
