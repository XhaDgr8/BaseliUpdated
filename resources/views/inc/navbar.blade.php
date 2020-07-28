<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-3">

    <div class="container">
        <a class="navbar-brand" href="{{route('word.index')}}">
            <img class="img-fluid" src="{{asset('storage/sa/logo.svg')}}" alt="">
            <h3 class="d-inline font-weight-bold roboto m-0">ˈdikSHəˌnerē</h3>
        </a>

        <button class="navbar-toggler border-0 bg-secondary py-2 rounded-lg" type="button"
        data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img class="img-fluid" src="{{asset('storage/sa/navtoggle.svg')}}" alt="">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/word/create">Create</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/print">Print All</a>
                </li>

            </ul>
        </div>
    </div>

</nav>
