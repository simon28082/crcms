<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-29 22:15
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit;

use CrCms\Document\Models\DocumentModel;
use CrCms\Document\Services\Documents\Document;
use CrCms\Document\Services\Fields\Input;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DocumentListTest
 * @package Tests\Unit
 */
class DocumentListTest extends TestCase
{

    protected function collect(): Collection
    {
        return collect([
            new DocumentModel([
                'id' => Str::random(10),
                'title' => Str::random(20),
                'abc' => 123,
            ]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
            new DocumentModel(['id' => Str::random(10), 'title' => Str::random(20)]),
        ]);
    }

    public function fields(): Collection
    {
        return collect([
            ['name' => 'id', 'type' => Input::class, 'roles' => ['list']],
            ['name' => 'title', 'type' => Input::class, 'roles' => ['list']]
        ]);
    }

    public function testList()
    {
        $document = new Document($this->fields());
dump($this->collect()->first());
        $result = $document->list($this->collect());

        $this->assertInstanceOf(Collection::class, $result);

        if ($result instanceof Collection) {
            $result->each(function(array $model){
                $this->assertNotEmpty($model['id']);
                $this->assertNotEmpty($model['title']);

                return false;
            });
        }
    }
}