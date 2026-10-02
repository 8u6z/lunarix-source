<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <title>Lunarix - the hangout spot for the swarm!!1!1!11!!!!</title>
</head>
<body class="bg-body-tertiary m-0">
<main class="container-fluid vh-100 p-0">
    <div class="row h-100 g-0 m-0">
        <div class="col-lg-3 d-flex align-items-center justify-content-center p-0">
            <div class="w-100 px-4" style="max-width: 380px;">
                <form method="POST" action="/login">
                @csrf
                    <div class="text-center mb-4">
                        <img src="/img/logo_full.png" alt="Lunarix" width="180" class="mb-3">
                        <p class="text-body-secondary">A Hangout spot for the Swarm community.</p>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    @if(config('services.turnstile.enabled'))
                    <div class="form-floating mb-3">
                    <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="dark"></div>
                    </div>
                    @endif
                    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                    <div class="text-center mt-3">
                        <small class="text-body-secondary">Don't have an account? <a href="/">Sign up</a></small>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9 d-none d-lg-block p-0">
            <img src="/img/conomy.png" alt="" class="w-100 h-100 object-fit-cover">
        </div>
    </div>
</main>
</body>
</html>