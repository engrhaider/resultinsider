<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>@yield('page-title')Result Insider</title>
    <meta name="description" content="Resultinsider.com is your one stop for checking all types of tests results." />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XTEE892Y33"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XTEE892Y33');
    </script>

    <style>
        <style>

        .navbar-nav {
            flex-direction: row;
        }
        .nav-link {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
        }
        .ml-auto .dropdown-menu {
            left: auto !important;
            right: 0px;
        }
    </style>
    </style>
    <script data-ad-client="ca-pub-7954804589457957" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">ResultInsider</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mdcat-result')  }}">Mdcat result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mdcat-aggregate-calculator')  }}">Mdcat Aggregate Calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mdcat-marks-distribution')  }}">Mdcat marks distribution</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mdcat provinicial stats
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'khyber-pukhtoonkhwa'))  }}">KPK</a>
                        <a class="dropdown-item" href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'punjab'))  }}">Punjab</a>
                        <a class="dropdown-item" href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'sindh'))  }}">Sindh</a>
                        <a class="dropdown-item" href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'fata'))  }}">Fata</a>
                        <a class="dropdown-item" href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'balochistan'))  }}">Balochistan</a>
                        <a class="dropdown-item" href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'gilgit-baltistan'))  }}">Gilgit Baltistan</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('scripts')

</body>
</html>
