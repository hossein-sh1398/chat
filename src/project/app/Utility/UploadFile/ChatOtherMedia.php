<?php

namespace App\Utility\UploadFile;

use App\Models\Media;
use App\Utility\UploadInterface;
use Illuminate\Http\UploadedFile;

class ChatOtherMedia extends BaseFile implements UploadInterface
{
    public function __construct(UploadedFile $file, $disk = 'public_html')
    {
        $year = date('Y');
        $month = date('m');

        parent::__construct( $file, $disk);

        $this->type = Media::OTHER_MEDIA;
        $this->url = "cdn/uploads/chat/chat_other_medias/{$year}/{$month}";
    }
}
