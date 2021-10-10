@extends('base')

@section('page-title', 'Mdcat 2021 result marks distribution')

@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Mdcat 2021 result marks distribution</h1>
            <p class="lead">You can view marks distribution across a marks range for a particular province or overall</p>
        </div>

        <div class="row">
            <div class="col6">
                <form id="mdcatMarksDistributionForm" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">From</label>
                            <input type="email" class="form-control" name="marks_from" placeholder="Marks from">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">To</label>
                            <input type="password" class="form-control" name="marks_to" placeholder="Marks to">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col6"></div>
        </div>

    </div>
@endsection
