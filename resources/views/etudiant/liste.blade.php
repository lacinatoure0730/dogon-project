<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container text-center">
      <div class="row">
        <div class="col">
        <nav class="navbar navbar-expand-lg bg-black ">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="{{asset('/images/logo.jpg') }}" alt="" width="30" height="24">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
              <div class="navbar-nav ">
                <a class="nav-link active text-white " aria-current="page" href="#">Home</a>
                <a class="nav-link text-primary" href="#">Features</a>
                <a class="nav-link text-primary" href="#">Pricing</a>
                <a class="nav-link text-light">Disabled</a>
              </div>
            </div>
          </div>
        </nav>
          <hr>
          <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
          <div class="btn-group" role="group" aria-label="First group">

          <a href="/ajouter" class="btn btn-secondary">Ajouter un etudiant</a>
          </div>
          <div class="input-group">
            <div class="input-group-text bg-secondary text-light" id="btnGroupAddon2">Recherche</div>
            <input type="text" class="form-control" placeholder="toure... /1ere.." aria-label="Input group example" aria-describedby="btnGroupAddon2 " id="searchInput">
          </div>
          </div>
          <hr>
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prenoms</th>
                <th>Classe</th>
                <th>QR Code</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="studentTableBody">
              @php
                $ide = 1;
              @endphp
              @foreach ($etudiants as $etudiant)
                <tr>
                  <td>{{ $ide }}</td>
                  <td>{{ $etudiant->nom }}</td>
                  <td>{{ $etudiant->prenom }}</td>
                  <td>{{ $etudiant->classe }}</td>
                  <td>
                    <div id="qrcode-{{ $etudiant->id }}">{{  $etudiant->qrcode}}</div>
                  </td>
                  <td>
                    <a href="/update/etudiant/{{ $etudiant->id }}" class="btn btn-info">Update</a>
                    <a href="/delete/etudiant/{{ $etudiant->id }}" class="btn btn-danger">Delete</a>
                    <button onclick="printQRCode('{{ $etudiant->id }}')">Print</button>
                  </td>
                </tr>
                @php
                  $ide += 1;
                @endphp
              @endforeach
            </tbody>
          </table>
          {{ $etudiants->links() }}
        </div>
      </div>
    </div>

    <script>
      function printQRCode(id) {
        var printContents = document.getElementById('qrcode-' + id).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        // Add event listener to the search input
        $("#searchInput").on("keyup", function() {
          var searchText = $(this).val().toLowerCase(); // Get the entered search term and convert to lowercase
          // Loop through all students in the table body
          $("#studentTableBody tr").filter(function() {
            // Show only the students whose names (or other relevant data) match the search term
            $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
          });
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
