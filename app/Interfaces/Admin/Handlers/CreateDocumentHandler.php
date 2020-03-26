<?php

namespace Interfaces\Admin\Handlers;

use Domain\Document\Actions\CreateDocumentAction;
use Domain\Document\Dto\DocumentData;
use Illuminate\Support\Facades\Response;
use Interfaces\Admin\Requests\DocumentRequest;

class CreateDocumentHandler
{
    /**
     * @param DocumentRequest $request
     * @param CreateDocumentAction $action
     *
     * @return void
     */
    public function __invoke(DocumentRequest $request, CreateDocumentAction $action)
    {
        $data = DocumentData::formRequest($request);

        $model = $action->handle($data);

        return Response::data($model);
    }
}
