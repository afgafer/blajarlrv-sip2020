<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- style -->
    <link href="{{ asset('style/afstyle.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>
        <h2>LAPORAN PEMESANAN</h2>
        <h2>DEMANG GEDI DESA GEDANGAN</h2>
        <h2>{{$date1}}/{{$date2}}</h2>
        <br>
        <table class="table table-sm bg-limpid-light">
            <thead>
                <tr class='bg-primary text-white'>
                    <th>No</th>
                    <th>name</th>
                    <th>cin</th>
                    <th>count</th>
                    <th>bill</th>
                </tr>
            </thead>
            <tbody id="tb">
            @php
            $count=0;
            $bill=0;
            @endphp
            @forelse($orders as $o)
                @php
                $count+=$o->count;
                $bill+=$o->bill;
                @endphp
                <tr>
                    <td>{{$o->id}}</td>
                    <td>{{$o->name}}</td>
                    <td>{{$o->cin}}</td>
                    <td>{{$o->count}}</td>
                    <td>{{$o->bill}}</td>
                </tr>
                @empty
                <tr>
                    <td>empty</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr class="bg-light">
                    <td colspan="3" class="text-center">total</td>
                    <td>{{$count}}</td>
                    <td>{{$bill}}</td>
                </tr>
            </tfoot>
        </table>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <!-- bootstrap -->
    @yield('script')
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script>
        /* Set the width of the side navigation to 250px */
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>