<form action="{{route('manage.auth.login.post')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="text" name="name" ><br>
    <input type="text" name="password"><br>

    <button type="submit" >Button</button>
</form>