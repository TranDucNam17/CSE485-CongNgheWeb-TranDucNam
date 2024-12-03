<!-- CSS Bootstrap 5 -->
<link rel="stylesheet" href="./asset/css/bootstrap.min.css">
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"><b>Products</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page === 'index.php') ? 'active' : ''; ?>"
                        href="index.php?controller=Product&action=index">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#life">Life</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#article">Article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#images">Images</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control m-1" type="text" placeholder="Search">
                <button class="btn btn-primary m-1" type="button">Search</button>
            </form>
        </div>
    </div>
</nav>