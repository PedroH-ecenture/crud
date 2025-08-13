<!-- resources/views/layouts/header.blade.php -->
<header class="text-white d-flex justify-content-between align-items-center px-4 py-3 mb-4"
    style="background-color: #0d1b2a;">

    <h1 class="h3 m-0">Bem-vindo à Página!</h1>

    <div class="d-flex align-items-center">
        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExYmtpaTJ3cjdkbWNseXN2YWoxZXlhdm5kcjl5YTV1dGx5empzY3R2diZlcD12MV9naWZzX3NlYXJjaCZjdD1n/lJNoBCvQYp7nq/giphy.gif"
            alt="GIF animado"
            class="img-fluid me-3"
            style="max-height:75px;">

        <a href="{{ route('logout') }}" class="btn"
            style="background:#333; color:#fff; border:1px solid #444; text-decoration:none; padding:0.35rem 0.9rem;">
            Sair
        </a>
    </div>
</header>