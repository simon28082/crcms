<?php

namespace Domain\Document\Actions;

use Domain\Document\Models\DocumentModel;

class CreateDocumentAction
{
    protected $model;

    public function __construct(DocumentModel $model)
    {
        $this->model = $model;
    }

    public function handle(array $data)
    {
        return $this->model->create($data);
    }

}
