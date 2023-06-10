<?php

namespace App\Utility\UploadFile;

use App\Models\Media;
use App\Utility\UploadInterface;
use Illuminate\Http\UploadedFile;

class ChatAudioFile extends BaseFile implements UploadInterface
{
    public function __construct(UploadedFile $file, $disk = 'public_html')
    {
        $year = date('Y');
        $month = date('m');

        parent::__construct($file, $disk);
        $this->mime_type = 'ogg';
        $this->type = Media::AUDIO_MEDIA;
        $this->url = "cdn/uploads/chat/audio/{$year}/{$month}";
    }
}
