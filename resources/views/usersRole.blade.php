/**
* @var $user User
*/

@foreach($usersRole as $user)
    <h2>{{$user->name}}</h2>
    <h4>Ruoli:</h4>
    @foreach($user->roles as $role)
        {{$role->name}}
        <br>
    @endforeach
@endforeach