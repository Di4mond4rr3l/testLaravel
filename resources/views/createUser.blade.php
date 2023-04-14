<form action="/users" method="POST" enctype="multipart/form-data">
    @csrf
 
    <label for="name">Nome e cognome:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="phone">Telefono:</label><br>
    <input type="tel" id="phone" name="phone"><br>
    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email"><br>
    
    <label for="file">Immagine Profilo:</label><br>
    <input type="file" id="file" name="file" class="form-control"><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Submit">

</form>