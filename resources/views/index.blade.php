@extends('base')

@section('content')
    <div class="container">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">ResultInsider</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Your one stop for checking all types of results and result analysis.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('mdcat-result')  }}" class="btn btn-outline-secondary btn-lg px-4 mr-3">Mdcat result 2021</a>
                    <a href="{{ route('mdcat-marks-distribution')  }}" class="btn btn-primary btn-lg px-4">Mdcat marks distribution</a>
                </div>
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
                    url: '{{route('mdcat-result')}}',
                    method: 'POST',
                    data: $(this).serialize()
                }).done(function (res) {
                    if (res.success) {
                        if (res.data && res.data.marks && res.data.marks > 0) {
                            $resultRow.html("<td>"+res.data.rollNo+"</td><td>"+res.data.name+"</td><td>"+res.data.marks+"</td><td>"+res.data.remarks+"</td");
                        } else {
                            $resultRow.html("<td colspan='4' align='center'>No record found.</td>");
                        }
                        $resultWrapper.show();
                    } else {
                        $resultWrapper.show();
                        $resultRow.html("<td colspan='4' align='center'>No record found.</td>");
                    }
                }).always(function () {
                    $submitBtn.text('Search');
                });
            });
        });
    </script>
@endsection
