<?php

namespace Domain\Document\Dto;

use Carbon\Carbon;
use Interfaces\Admin\Requests\DocumentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class DocumentData extends DataTransferObject
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $content;

    /**
     * @var Carbon
     */
    public Carbon $published_at;

    /**
     * @var string|null
     */
    public ?string $summary;

    /**
     * @var int
     */
    public int $views = 0;

    /**
     * @param DocumentRequest $request
     *
     * @return array
     */
    public static function formRequest(DocumentRequest $request)
    {
        return [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'published_at' => Carbon::parse($request->get('published_at')),
            'summary' => $request->get('summary'),
            'views' => 0,
        ];
    }
}
