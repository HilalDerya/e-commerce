<!doctype html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>El Yapımı Ürünler E-ticaret Sitesi</title>

  <link rel="stylesheet" href="{{asset("css/app.css")}}">
  <style>
    * {
      border: 0;
      padding: 0;
      margin: 0;
    }

    body {
      margin: 0px;
    }
  </style>
</head>

<body>
  <header>
    <div class="container-fluid">
      <div class="row">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="/">- Gijs -</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Anasayfa</a>
                </li>
                @auth()
                @if(Auth::user()->is_admin == 1)
                <li class="nav-item">
                  <a class="nav-link" href="/users">Admin Paneli</a>
                </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" href="/hesabim">Hesabım </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/sepetim">Sepetim</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/cikis">Çıkış</a>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="/giris">Giriş Yap</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/uye-ol">Üye ol</a>
                </li>
                @endauth
              </ul>
            </div>
          </div>
        </nav>
      </div>
  </header>

  <main>
    <div class="row">
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-light" style="width: 280px;">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="list-group-item list-group-item-action py-2 ripple" aria-current="true" data-mdb-toggle="collapse" aria-expanded="true" aria-controls="collapseExample1">
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>HESABIM</span>
          </a>
          <a href="{{url('/hesabim')}}" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt fa-fw me-3" data-feather="user"></i><span>Kullanıcı Bilgilerim</span></a>
          <a href="{{url("/hesabim/$user->user_id/adreslerim")}}" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt fa-fw me-3" data-feather="map-pin"></i><span>Adres Bilgilerim</span></a>
          <a href="/" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt fa-fw me-3" data-feather="credit-card"></i><span>Kayıtlı Kartlarım</span></a>
        </div>
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="list-group-item list-group-item-action py-2 ripple" aria-current="true" data-mdb-toggle="collapse" aria-expanded="true" aria-controls="collapseExample1">
            <span>SİPARİŞLERİM</span>
          </a>
          <a href="{{url('/sepetim')}}" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt fa-fw me-3" data-feather="shopping-bag"></i><span>Tüm Siparişlerim</span></a>
        </div>
      </div>

      <div class="col-sm-9 pt-4">
        <div class="row">
          <form action="{{route("update-password")}}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="col-lg-6">
              <div class="mt-2">
                <x-input label="Kullanmakta olduğunuz Ad-Soyad:" placeholder="Ad soyad giriniz" field="name" value="{{$user->name}}" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-2">
                <x-input label="Kullanmakta olduğunuz E-posta:" placeholder="Eposta giriniz" field="email" type="email" value="{{$user->email}}" />
              </div>
            </div>
            <div class="col-lg-12 mt-5 mb-3">
              <div class="col-lg-6">
                <div class="col-lg-12">
                  <p style="color:red;"><u>Şifrenizi değiştirmek ister misiniz?</u></p>
                </div>
                <div class="col-lg-6">
                  <div class="mt-2">
                    <x-input label="Kullanmakta olduğunuz şifre:" placeholder="Şifre giriniz" field="password" type="password" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mt-2">
                    <x-input label="Yeni şifre:" placeholder="Şifre giriniz" field="new_password" type="password" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mt-2">
                    <x-input label="Yeni şifrenizi Tekrar Giriniz:" placeholder="Şifrenizi tekrar giriniz" field="new_password_confirmation" type="password" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary mt-2"><span data-feather="save"></span> KAYDET</button>
              </div>
            </div>
          </form>
        </div>
  </main>

  <hr class="hr hr-blurry" />

  <div class="container-fluid bg-dark text-white">
    <footer class="py-5">
      <div class="row">
        <div class="col-6 col-md-2 mb-3">
          <h5>Kategoriler</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Kupa</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Mum</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Dekor</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Peluş</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-3">
          <h5>Kurumsal</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Hakkımızda</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Misyon & Vizyon</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Müşteri Hizmetleri</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sıkça Sorulan Sorular</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">İletişim</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-2 mb-3">
          <h5>Ödeme</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ödeme Seçenekleri</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Banka Kampanyaları</a></li>
          </ul>
        </div>

        <div class="col-md-5 offset-md-1 mb-3">
          <form>
            <h5>Haber bültenimize abone ol.</h5>
            <p>Abone olarak yeni haberlerimizin aylık özetinden haberdar olabilirsin.</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
              <label for="newsletter1" class="visually-hidden">E-mail</label>
              <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
              <button class="btn btn-primary" type="button">Abone Ol</button>
            </div>
          </form>
        </div>
      </div>

      <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
        <p>© 2023 Company, Inc. All rights reserved.</p>
        <div>
          <p>Sosyal Medya Hesaplarımız:</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3"><a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true" data-mdb-toggle="collapse" aria-expanded="true" aria-controls="collapseExample1">
                <i class="fas fa-tachometer-alt fa-fw me-3" data-feather="twitter"></i>
              </a></li>
            <li class="ms-3"><a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true" data-mdb-toggle="collapse" aria-expanded="true" aria-controls="collapseExample1">
                <i class="fas fa-tachometer-alt fa-fw me-3" data-feather="instagram"></i>
              </a></li>
            <li class="ms-3"><a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true" data-mdb-toggle="collapse" aria-expanded="true" aria-controls="collapseExample1">
                <i class="fas fa-tachometer-alt fa-fw me-3" data-feather="facebook"></i>
              </a></li>
          </ul>
        </div>

      </div>
    </footer>
  </div>


</body>
<script type="text/javascript" src="{{asset("js/app.js")}}"></script>

</html>