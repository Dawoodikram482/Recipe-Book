<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Taste Book"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style><?php include __DIR__ . '/../public/css/style.css' ?></style>
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/images/newlogo.png" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/homepage">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/breakfastpage">BreakFast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/lunchpage">Lunch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dinnerpage">Dinner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/createrecipepage">Create Recipe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
