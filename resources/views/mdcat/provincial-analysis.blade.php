@extends('base')

@section('page-title', 'Mdcat 2021 result marks distribution - ')

@section('content')
    <style>
        .table td, .table th {
            padding: .2rem !important;
        }
    </style>
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Mdcat Result Provincial Analysis</h1>
            @if($province)
                <p class="lead">The table below shows the marks distribution in the province <strong>{{$province}}</strong></p>
            @endif
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 mb-4">
                <h5>{{$province}} result analysis</h5>
                <h5>Students appeared: <span class="badge badge-info">{{$appeared}}</span></h5>
                <h5>Passed: <span class="badge badge-success">{{$passed}}</span></h5>
                <h5>Fail: <span class="badge badge-danger">{{$fail}}</span></h5>
                <h5>Pass Percentage: <span class="badge badge-success">{{($appeared > 0) ? round((($passed/$appeared) * 100), '2') : '0.00%' }}</span></h5>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="table-responsive text-center" style="margin: auto; width: 300px">
                    @if (count($resultSet))
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Marks Range</th>
                                <th scope="col">No. of students</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resultSet as $key => $value)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    @else
                       <h3 class="text-center">No analysis found for the province. Invalid province.</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="row my-5">
            <h5 class="my-4 text-center col-12">You can also check for other provinces</h5>
            <div class="col-12 text-center">
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'khyber-pukhtoonkhwa'))  }}" class="btn btn-primary btn-lg px-4 my-2">Khyber Pukhtoonkhwa</a>
                </div>
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'punjab'))  }}" class="btn btn-primary btn-lg px-4 my-2">Punjab</a>
                </div>
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'sindh'))  }}" class="btn btn-primary btn-lg px-4 my-2">Sindh</a>
                </div>
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'fata'))  }}" class="btn btn-primary btn-lg px-4 my-2">FATA</a>
                </div>
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'balochistan'))  }}" class="btn btn-primary btn-lg px-4 my-2">Balochistan</a>
                </div>
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'islamabad'))  }}" class="btn btn-primary btn-lg px-4 my-2">Islamabad</a>
                </div>
                <div>
                    <a href="{{ route('get-mdcat-result-provincial-analysis', array('province' => 'gilgit-baltistan'))  }}" class="btn btn-primary btn-lg px-4 my-2">Gilgit Baltistan</a>
                </div>
                <div>
                    <a href="{{ route('mdcat-marks-distribution') }}" class="btn btn-outline-secondary btn-lg px-4 my-2">Check mark distribution by range for any province</a>
                </div>
                <div>
                    <a href="{{ route('mdcat-result')  }}" class="btn btn-outline-secondary btn-lg px-4 my-2">Check your Mdcat result 2021</a>
                </div>
            </div>
        </div>

    </div>
@endsection
