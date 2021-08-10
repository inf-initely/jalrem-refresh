@extends('layout.app')

@section('content')
<main>
    <div id="content">
      <section id="artikelDanBerita">
        <div class="container">
          <div class="row justify-content-center">
            <article class="col-lg-8">
              <header class="mb-4">
                <h2 class="sub-judul">(Terbaru) Rekrutmen Peserta Muhibah Budaya Jalur Rempah 2021</h2>
                <div class="info-penulis">
                  <span class="txt-penulis" class="mr-3" id="penulis" name="penulis">Ahmad Rifaldi</span> |
                  <span class="txt-penulis" id="tglArtikel" name="tglArtikel">20 November 2021</span>
                </div>
              </header>
              <img src="assets/img/hero/hero-2.webp" width="100%">
              <article id="desTentang" class="mt-3">
                <p>Jalur Rempah mencakup berbagai lintasan dari timur Asia hingga barat Eropa terhubung dengan Benua Amerika, Afrika dan Australia. Suatu lintasan peradaban bermacam bentuk, garis lurus, lingkaran, silang, bahkan berbentuk jejaring.</p>
                <p>Di Indonesia, wujud jalur perniagaan rempah mencakup banyak hal. Tidak hanya berdiri di satu titik penghasil rempah, namun juga mencakup berbagai titik yang bisa dijumpai di Indonesia dan membentuk suatu lintasan peradaban yang berkelanjutan.</p>
                <p>Program Jalur Rempah melihat kembali lintasan jalur perdagangan rempah dari satu titik ke titik lainnya, menghidupkan kembali beragam kisahnya, menghubungkan kembali berbagai jejaknya.</p>
                <p>Menghidupkan kembali narasi sejarah yang umumnya tidak memperlihatkan peran orang Indonesia dalam pembentukan Jalur Rempah.</p>
                <p>Program ini bertekad keras mencatat peran mereka yang berada di titik-titik perdagangan rempah, menghubungkan serangkaian benang merah yang belum terdokumentasikan dan tampak samar-samar dalam narasi sejarah.</p>
              </article>
            </article>
          </div>
        </div>
      </section>
      <section id="artikelDanBerita">
        <section class="container" id="artikel">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Kegiatan Terkini</h2>
              <p>Berbagai upaya dilakukan untuk melestarikan jalur rempah, salah satunya dengan melakukan berbagai kegiatan.</p>
            </div>
          </header>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-4 mb-1">
                  <div class="card no-border no-background">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="assets/img/kegiatan/kegiatan-1.jpg">
                        </div>
                        <div class="col-6 center-v">
                          <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">20 Januari 2021</p>
                          <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">Kompetisi Cerita Gambar Rempah dan Budaya Bahari</h3>
                        </div>
                      </div>
                      <a href="https://upanastudio.com" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 mb-1">
                  <div class="card no-border no-background">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="assets/img/kegiatan/kegiatan-1.jpg">
                        </div>
                        <div class="col-6 center-v">
                          <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">20 Januari 2021</p>
                          <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">Kompetisi Cerita Gambar Rempah dan Budaya Bahari</h3>
                        </div>
                      </div>
                      <a href="https://upanastudio.com" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 mb-1">
                  <div class="card no-border no-background">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="assets/img/kegiatan/kegiatan-1.jpg">
                        </div>
                        <div class="col-6 center-v">
                          <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">20 Januari 2021</p>
                          <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">Kompetisi Cerita Gambar Rempah dan Budaya Bahari</h3>
                        </div>
                      </div>
                      <a href="https://upanastudio.com" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
    </div>
  </main>
@endsection