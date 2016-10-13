Hello {{$user->name}}
<br />
点击链接 {{route('verify-mail',['userId'=>$user->id,'hash'=>$hash])}}
<br />\
{{time()}}