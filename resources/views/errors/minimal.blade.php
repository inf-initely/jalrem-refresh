<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
     <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
      <style>
          @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap');

          html,
          body {
            background-color: #fff;
            font-family: 'Lato', sans-serif;
          }

          h1{
            font-size: 5rem;
            font-weight: 900;
            color: #DC3545;
          }

          a{
            color: #414042;
            text-decoration: none;
          }

          a:hover{
            color: #DC3545;
          }

          p{
            margin-bottom: 5px;
            font-size: 1.25rem;
          }

          .item-jelajah-3 {
                bottom: 0px;
                right: 0;
                width: 100%;
            }

            .item-jelajah {
                position: absolute;
                z-index: 0;
            }
      </style>


    </head>
    <body class="antialiased" class="position-relative">
        <img class="item-jelajah item-jelajah-3" src="assets/img/asset-jelajah.png">
         <div class="position-relative" style="height: 100vh; width: 100vw;">
            <div class="position-absolute top-50 start-50 translate-middle text-center">

                <img src="{{ asset('assets/img/icon/404.svg') }}" height="150">

                <h1 class="mt-3">@yield('code')</h1>
                <p> @yield('message')</p>
                <a href="#" onclick="goBack()"> <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div>
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </body>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>
</html>
