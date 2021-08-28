@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Beranda
@endsection

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid" id="contentWrapper">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <iframe width="100%" height="900px" src="{{ env('DATASTUDIO_URL') }}" frameborder="0" style="border:0" allowfullscreen></iframe>

            <!-- https://datastudio.google.com/embed/reporting/405b7bb5-8698-431a-8139-8623c8cdbb5e/page/S33B -->
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
@endsection
