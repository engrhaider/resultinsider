@extends('base')

@section('page-title', 'Mdcat 2021 result marks distribution - ')

@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Mdcat 2021 marks distribution</h1>
            <p class="lead">You can view nationwide or provincial marks distribution for a particular range. Leave province option empty to see nationwide distribution for the marks range.</p>
        </div>

        <div class="row">
            <div class="col-12">
                <form id="mdcatMarksDistributionForm" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="number" class="form-control" name="marks_from" placeholder="Marks from">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="number" class="form-control" name="marks_to" placeholder="Marks to">
                        </div>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-4">
                            <select class="form-control" name="province" id="province">
                                <option value="">Choose province</option>
                                <option value="1">Khyber Pukhtoonkhwa</option>
                                <option value="2">FATA</option>
                                <option value="3">Punjab</option>
                                <option value="4">Sindh</option>
                                <option value="5">Balochistan</option>
                                <option value="6">Islamabad</option>
                                <option value="7">Gilgit Baltistan</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="resultWrapper" class="text-center mt-4" style="font-size: 2rem;">
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('mdcat-result')  }}" class="btn btn-outline-secondary btn-lg px-4 mr-3">Check your Mdcat result 2021</a>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            const $form = $("form#mdcatMarksDistributionForm");
            const $resultWrapper = $("#resultWrapper");

            $form.on('submit', function (e) {
                e.preventDefault();

                const $this = $(this);
                const $submitBtn = $this.find('button');
                $submitBtn.text('processing...');

                $.ajax({
                    url: '{{route('get-mdcat-marks-range')}}',
                    method: 'POST',
                    data: $(this).serialize()
                }).done(function (res) {
                    if (res.success) {
                        $resultWrapper.html(res.data);
                    } else {
                        $resultWrapper.html(res.data);
                    }
                }).always(function () {
                    $submitBtn.text('Submit');
                }).fail(function () {
                    $resultWrapper.html("Couldn't fetch the result, please try again later!");
                });
            });
        });
    </script>
@endsection
