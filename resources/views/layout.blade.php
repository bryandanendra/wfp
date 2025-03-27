<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <title>@yield('judul-browser')</title>
    @yield('model')
</head>
<body>
    <div>
        <h1>SHOPEE FOOD</h1>
    </div>
    <div >
        <h2 style= "background-color: yellow;">@yield('judul-halaman')</h2>
        <!-- disinilah akan terisi data dari controller -->
        @yield('isi')

    </div>
    <div  id="kaki">
        <h4>Hak Cipta (c)2025</h4>
    </div>
</body>
</html>