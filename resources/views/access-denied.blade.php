
@include('layouts.header')
<main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h5>Access Denied</h5>
        <h2>You Are Not Eligible To View The page you are looking for.</h2>
        <a class="btn" href="{{ route('home') }}">Back to home</a>
        <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
        
      </section>

    </div>
</main>

@include('layouts.footer')