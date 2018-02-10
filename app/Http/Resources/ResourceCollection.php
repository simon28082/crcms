<?php

namespace CrCms\Foundation\Http\Resources;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Http\Resources\Json\ResourceCollection as BaseResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

/**
 * Class ResourceCollection
 * @package CrCms\Foundation\Http\Resources
 */
class ResourceCollection extends BaseResourceCollection
{
    /**
     * @var string
     */
    protected $transform;

    /**
     * ResourceCollection constructor.
     * @param mixed $resource
     * @param string $transform
     */
    public function __construct($resource, string $transform = '')
    {
        $this->transform = $transform;
        parent::__construct($resource);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return $this->resource instanceof AbstractPaginator
            ? (new PaginatedResourceResponse($this))->toResponse($request)
            : parent::toResponse($request);
    }

    /**
     * @return string
     */
    protected function collects()
    {
        if (!empty($this->transform) && substr($this->transform, -8) === 'Resource') {
            return $this->transform;
        }

        return parent::collects();
    }
}