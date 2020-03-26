<?php

namespace Interfaces\Admin\Controllers;

use Domain\Document\Actions\CreateDocumentAction;
use Domain\Document\Dto\DocumentData;
use Illuminate\Support\Facades\Response;
use Interfaces\Admin\Requests\DocumentRequest;

class CreateDocument
{
    public function __invoke(DocumentRequest $request,CreateDocumentAction $action)
    {
        $data = DocumentData::formRequest($request);

        $model = $action->handle($data);

        Response::data($model);
    }
}
