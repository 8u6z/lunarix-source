<nav class="navbar navbar-expand-lg bg-dark navbar-dark admin-navbar">
  <div class="container-fluid">
    <img class="navbar-brand" src="/images/UI/logo_admin_full_rhaqq2yye.png" style="height: 40px; width: auto;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="d-flex align-items-center">
        <span class="text-secondary">
          Welcome {{ $currentUser->username }} | <a href="/" class="text-light">Back to Lunarix</a>
        </span>
      </div>
    </div>
  </div>
</nav>
