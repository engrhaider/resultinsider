@extends('base')

@section('page-title', 'Mdcat aggregate calculator - ')

@section('content')
    <style>
        .table td, .table th {
            padding: .2rem !important;
        }
    </style>
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Mdcat Aggregate Calculator</h1>
            <p class="lead">Calculate your MDCAT aggregate for admission into medical colleges.</p>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto mb-4">
                <form method="post" id="aggregateCalculator">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Matric marks</label>
                            <input type="number" id="matric_marks" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Matric total marks</label>
                            <input type="number" id="matric_total_marks" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Fsc marks</label>
                            <input type="number" id="fsc_marks" class="form-control" requred>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Fsc total marks</label>
                            <input type="number" id="fsc_total_marks" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Mdcat test marks</label>
                            <input type="number" id="mdcat_marks" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mdcat test total marks</label>
                            <input type="number" id="mdcat_total_marks" class="form-control" value="210" required>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" style="margin-top: 5px;" value="calculate" name="submit" type="submit">Calculate</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row my-5">
            <div id="result" class="col-12 text-center">
                <span id="aggregate" class="badge badge-success p-3" style="display:none; font-size:2rem">
                </span>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            const $result = $("#result");
            const $aggregate = $("#aggregate");
            const $form = $("#aggregateCalculator");
            const $matricMarks = $("#matric_marks");
            const $matricTotalMarks = $("#matric_total_marks");
            const $fscMarks = $("#fsc_marks");
            const $fscTotalMarks = $("#fsc_total_marks");
            const $mdcatMarks = $("#mdcat_marks");
            const $mdcatTotalMarks = $("#mdcat_total_marks");

            $form.on('submit', function (e) {
                e.preventDefault();
                let aggregate = ($matricMarks.val()/$matricTotalMarks.val()) * 0.1 + ($fscMarks.val()/$fscTotalMarks.val()) * .40 + ($mdcatMarks.val()/$mdcatTotalMarks.val()) * .50;
                aggregate = aggregate * 100;
                $aggregate.text('Your aggregate is: ' + aggregate.toFixed(2) + '%').show();
            });
        });
    </script>
@endsection
