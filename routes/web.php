<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/d',function (){

    $test = new \App\Test();
//    $test->create([
//        'name'=>str_random(10),
//    ]);

//    $a12 = $test::find(12);
//
//    $a12->name='5555555555555555';
//    $a12->save();

//    $test::destroy(12);

//    $a14 = $test::find(14);
//    $a14->name = 'test';
//    $a14->save();
//    dd($test->where('id',20));
    $test->where('id',20)->update(['name'=>'799999999fdasfdsa']);

//    $b = $test::destroy(3);
//    dd($b);

});


Route::get('/c',function(){

    echo '<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">';
//    $attributes = [
//        'name'=>[
//            'type'=>'input',
//            'attribute'=>[
//                'class'=>'form-control',
//            ],
//            'value'=>'abc',
//            'name'=>'name1',
//            'label'=>'Name',
//        ],
//        'sex'=>[
//            'type'=>'radio',
//            'attribute'=>['class'=>'radio-inline'],
//            'value'=>2,
//            'option'=>[1=>'box',2=>'box2']
//        ],
//        'class_id'=>[
//            'type'=>'select',
//            'attribute'=>['class'=>'form-control'],
//            'option'=>[1=>'option1',2=>'option2'],
//            'value'=>2,
//        ],
//        'textarea'=>[
//            'type'=>'textarea',
//            'name'=>'remark',
//            'attribute'=>['class'=>'form-control'],
//            'value'=>'remark',
//
//        ]
//    ];


    $b = new B();

    $form = new \CrCms\Form\FormRender();

    $html = $form->render($b);

    foreach ($html as $string)
    {
        echo $string;
    }

});

class B implements \CrCms\Form\FormConfigInterface
{
    public function attributes() : array
    {
        // TODO: Implement attributes() method.
        $attributes = [
            'name'=>[
                'drive'=>\CrCms\Form\RenderDrives\InputRender::class,
                'attribute'=>[
                    'class'=>'form-control',
                ],
                'value'=>'abc',
                'name'=>'name1',
                'label'=>'Name',
            ],
            'sex'=>[
                'drive'=>\CrCms\Form\RenderDrives\RadioRender::class,
                'attribute'=>['class'=>'radio-inline'],
                'value'=>2,
                'option'=>[1=>'box',2=>'box2']
            ],
            'class_id'=>[
                'drive'=>\CrCms\Form\RenderDrives\SelectRender::class,
                'attribute'=>['class'=>'form-control','multiple'=>'multiple'],
                'option'=>[1=>'option1',2=>'option2'],
                'value'=>[1,2],
            ],
            'textarea'=>[
                'drive'=>\CrCms\Form\RenderDrives\TextareaRender::class,
                'name'=>'remark',
                'attribute'=>['class'=>'form-control'],
                'value'=>'remark',

            ],
            'checkbox'=>[
                'drive'=>\CrCms\Form\RenderDrives\CheckboxRender::class,
                'name'=>'abc',
                'attribute'=>['a'=>'b'],
                'value'=>['a','b'],
                'option'=>['a'=>'A','b'=>'B','c'=>'C','d'=>'D'],
            ]
        ];
        return $attributes;
    }

    public function rules() : array
    {
        // TODO: Implement rules() method.
    }

    public function table() : string
    {
        // TODO: Implement table() method.
    }

}