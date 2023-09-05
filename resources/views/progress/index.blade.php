<x-master title="{{ __('Progress index') }}">
    <x-navbar />

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Progress Charts') }}</h5>

                        @if (!$labels)
                            <div class="alert alert-info" role="alert">
                                {{ __('You currently have no progress data.') }}
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-6 my-3 ">
                                    <h4 class="chaart-title"> Histogram </h4>
                                    <x-charts.progress-bar-chart :labels="$labels" :values="$values" />
                                </div>
                                <div class="col-md-6 my-3">
                                    <h4 class="chaart-title"> Graph </h4>
                                    <x-charts.progress-line-chart :labels="$labels" :values="$values" />
                                </div>

                                <div class="col-md-6 my-3">
                                    <h4 class="chaart-title"> Progress Chart </h4>
                                    <x-charts.progress-chart chart-id="progressPieCharts" chart-type="pie"
                                        :labels="$labels" :progressData="$values" :chartColors="$colors" />
                                </div>

                                <div class="col-md-6 my-3">
                                    <h4 class="chaart-title"> Recomanded Chart </h4>
                                    <x-charts.recomanded-progress-chart chart-id="recommandedProgressPieChart"
                                        chart-type="pie" :labels="$labels" :progressData="$values" :chartColors="$colors" />
                                </div>
                            </div>
                            <div class="col-md-12" id="bars">

                                @foreach ($progressRecords as $progress)
                                    <x-charts.single-data-percentage-bar label="{!! $progress->category->name !!}"
                                        value="{{ $progress->rating }}" max="10" id="{{ $progress->id }}"
                                        type="edit" />

                                    <x-edit-progress-rating-modal modalId="{{ 'editProgressModal' . $progress->id }}"
                                        modalLabel="Edit Progress"
                                        formAction="{{ route('progress.update_single_rating') }}" :inputName="$progress->category->name"
                                        rating="{{ $progress->rating }}" :id="$progress->id" />

                                    <x-show-progress-modal :progress="$progress" />
                                @endforeach


                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- table --}}
        <div class="row mt-3">
            <div class="col-md-12">
                <h5 class="card-title">Progress Data Table</h5>
                <table class="table table-bordered" id="progressTable" data-table>
                    <thead>
                        <tr>
                            <th>no. progress</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th>Date of creation</th>
                            <!-- Add more table headers for other relevant columns -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Use a loop to populate table rows with progress data -->
                        @foreach ($progressRecords as $i => $progress)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $progress->category->name }}</td>
                                <td>{{ $progress->rating }}</td>
                                <td>
                                    <span
                                        id="date_{{ $progress->id }}">{{ $progress->created_at->format('F j, Y') }}</span>
                                </td>

                                <!-- Add more table data for other relevant columns -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $progressRecords->links() }}
            </div>
        </div>

        <!-- Button to edit all progress -->
        <a class="btn btn-primary" href="{{ route('progress.edit', $userId) }}">
            Edit All Progress
        </a>

        @if (!empty($userInsights))
            <div class="alert alert-info mt-3" role="alert">
                <h5>User Insights:</h5>
                <ul>
                    @foreach ($userInsights as $insight)
                        <li>{{ $insight }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (!empty($summaryStatistics))
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title">Summary Statistics</h5>
                    <ul>
                        <li>Average Rating: {{ $summaryStatistics['averageRating'] }}</li>
                        <li>Minimum Rating: {{ $summaryStatistics['minRating'] }}</li>
                        <li>Maximum Rating: {{ $summaryStatistics['maxRating'] }}</li>
                    </ul>
                </div>
            </div>
        @endif


    </div>

    {{-- handle modal edit  --}}

    {{-- <script>
        $("#edit_btn").click(function(e) {

            e.preventDefault();

            const fd = new FormData($('#edit_modal_form')[0]);
            // console.log("hey");
            $.ajax({

                url: "{{ route('progress.update_single_rating') }}",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    console.log('Response data:', response); // Log the entire response

                    $("#edit_modal_form")[0].reset();
                    // $('.modalEdit').modal('hide');
                    $('#editProgressModal').modal('hide');

                    $("#bars").html(response);

                    // getData();

                    //    Swal.fire(
                    //         'Updated',
                    //         'Progress updated successfully.',
                    //         'success'
                    //     );



                },
                error: (error) => {
                    alert("error")
                }
            });

        });



        function getData() {

            $.ajax({
                url: '{{ route('progress.index') }}',
                method: 'get',

                success: function(response) {

                    $("#bars").html(response);
                    console.log("response :", response);

                }
            });
        }
    </script> --}}

    <x-footer />
</x-master>
