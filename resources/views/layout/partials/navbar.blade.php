<nav class="navbar navbar-expand-lg bg-dark text-light" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Novels-Sama</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Home' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Download' ? 'active' : '' }}" aria-current="page"
                        href="/downloads">Downloads</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Category' ? 'active' : '' }}" aria-current="page"
                        href="/categories">Category</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Novels' ? 'active' : '' }}" aria-current="page"
                        href="/posts">Novels</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'About' ? 'active' : '' }}" aria-current="page"
                        href="/about">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto me-4">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Login' ? 'active' : '' }}" aria-current="page" href="/login"><i
                        class="bi bi-person-circle"></i> Login </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
