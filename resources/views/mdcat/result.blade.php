@extends('base')

@section('page-title', 'Mdcat 2021 result marks distribution - ')

@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Mdcat 2021 Result</h1>
            <p class="lead">Check your Mdcat 2021 result by entering your roll no below.</p>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <form id="mdcatResult" method="POST">
                    <div class="form-group">
                        <input type="number" class="form-control" name="roll_no" placeholder="Enter Roll No" required/>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <div id="result-wrapper" class="mt-5" style="display: none">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Roll No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Marks</th>
                        <th scope="col">REMARKS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="resultRow">
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            const $form = $("form#mdcatResult");
            const $resultWrapper = $("#result-wrapper");
            const $resultRow = $("#resultRow");

            $form.on('submit', function (e) {
                e.preventDefault();

                const $this = $(this);
                const $submitBtn = $this.find('button');
                $submitBtn.text('processing...');

                $.ajax({
                    url: '{{route('get-mdcat-result')}}',
                    method: 'POST',
                    data: $(this).serialize()
                }).done(function (res) {
                    if (res.success) {
                        if (res.data && res.data.marks && res.data.marks > 0) {
                            $resultRow.html("<td>"+res.data.rollNo+"</td><td>"+res.data.name+"</td><td>"+res.data.marks+"</td><td>"+res.data.remarks+"</td");
                        } else {
                            $resultRow.html("<td colspan='4' align='center'>No record found, make sure you have entered the correct Roll NO.</td>");
                        }
                        $resultWrapper.show();
                    } else {
                        $resultWrapper.show();
                        $resultRow.html("<td colspan='4' align='center'>No record found, make sure you have entered the correct Roll NO.</td>");
                    }
                }).always(function () {
                    $submitBtn.text('Search');
                });
            });
        });
    </script>
@endsection
