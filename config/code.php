<?php

return [

    //file的示例

    /*'file'=>[
      'app'=>[
          'success'=>1000,
      ],
        'http'=>[
            'success'=>200,
        ]
    ],*/

    //这里这个app，http是属于公共的状态码和lang里面的app文件,
    //当自定义Lang里面的其它文件那么则可以定义其它文件下标
    'app'=>[
        'success'=>1000,
        'error'=>1003,
    ],
    'http'=>[
        'success'=>200,
        'error'=>200,
    ],
];