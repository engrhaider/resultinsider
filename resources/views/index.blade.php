@extends('base')

@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">ResultInsider</h1>
            <p class="lead">Your one stop for checking all types of results and result analysis.</p>
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
