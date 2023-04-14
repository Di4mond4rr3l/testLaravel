<form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
 
    <label for="name">Nome e cognome:</label><br>
    <input type="text" id="name" name="name" value="{{$user->name}}"><br>
    <label for="phone">Telefono:</label><br>
    <input type="tel" id="phone" name="phone" value="{{$user->phone}}"><br>
    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email" value="{{$user->email}}"><br>
    <label for="image">Immagine Profilo:</label><br>
    <input type="file" id="image" name="image"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Submit">

</form>