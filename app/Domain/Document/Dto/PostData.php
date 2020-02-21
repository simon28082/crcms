<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2020-02-21 09:52
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2020 Rights Reserved CRCMS
 */

namespace Domain\Document\Dto;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class PostData extends DataTransferObject
{
    public string $title;

    public string $content;

    public Carbon $publishedAt;

    public int $status;

    public static function formRequest(Request $request): self
    {
        $staticFields = $request->only(['title', 'content', 'status']);

        return new self(array_merge($staticFields, Carbon::parse($request->get('published_at'))));
    }
}
