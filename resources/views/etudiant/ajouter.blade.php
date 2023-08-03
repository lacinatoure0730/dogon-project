<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
   

  <div class="container ">
  <div class="row ">
  <hr>
            <h1 >AJOUTER UN ETUDIANT</h1>
        <hr>

        @if (session('status'))
            <div class="alert alert-success">
              {{(session('status'))}}
            </div>
        @endif
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach

        </ul>
    <div class="col s12">
       
        
        <form action="/ajouter/traitement" method="POST" >
          @csrf

            <div class="mb-3">
                <label for="Nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="Nom" name="nom" >
            </div>

            <div class="mb-3">
                <label for="Prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="Prenom" name="prenom" >
            </div>

            <div class="mb-3">
                <label for="Classe" class="form-label">Classe</label>
                <input type="text" class="form-control" id="Classe" name="classe" >
            </div>
            <br>
              <button type="submit" class="btn btn-primary">AJOUTER UN ETUDIANT</button>

              <br> <br>
              <a href="/etudiant" class="btn btn-danger">Revenir a liste des etudiants</a>
        </form>

   
    </div>
    <div class="col">
         {{ $qrcode }}
    </div>
  </div>
      
</div>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>