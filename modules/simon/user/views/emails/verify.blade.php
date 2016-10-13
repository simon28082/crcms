Hello {{$user->name}}
<br />
点击链接 {{route('verify-check-email',['userId'=>$user->id,'hash'=>$hash])}}
<br />\
{{time()}}