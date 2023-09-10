<x-master title="{{ __('Progress index') }}">
    <x-navbar />

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        @if ($values && $labels)
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

                                        <x-progress_modals.edit-progress-rating-modal
                                            modalId="{{ 'editProgressModal' .$progress->id}}"
                                            modalLabel="Edit Progress"
                                            formAction="{{ route('progress.update_single_rating') }}" :inputName="$progress->category->name"
                                            rating="{{ $progress->rating }}" :id="$progress->id" />

                                        <x-progress_modals.show-progress-modal :progress="$progress" />

                                        <x-progress_modals.delete-progress-modal :id="$progress->id" />
                                    @endforeach

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Display an info message if progressRecords is empty -->
            <div class="alert alert-info mt-3" role="alert">
                {{ __('No progress data available to do charts .') }}
            </div>
        @endif
        @if ($progressRecords->isNotEmpty())
            {{-- table --}}
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5 class="card-title">Progress Data Table</h5>
                    <table class="table table-bordered" id="progressTable" data-table>
                        <thead>
                            <tr>
                                <th  data-sortable="true">no. progress</th>
                                <th  data-sortable="true">Category</th>
                                <th  data-sortable="true">Rating</th>
                                <th  data-sortable="true">Date of creation</th>
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
                </div>
            </div>

            <!-- Button to edit all progress -->
            <a class="btn btn-primary" href="{{ route('progress.edit', $userId) }}">
                Edit All Progress
            </a>
        @else
            <!-- Display an info message if progressRecords is empty -->
            <div class="alert alert-info mt-3" role="alert">
                {{ __('No progress data available for table.') }}
            </div>
        @endif

        @if (!empty($userInsights))
            <div class="alert alert-info mt-3" role="alert">
                <h5 class="alert-heading">User Insights:</h5>
                <ul class="mb-0">
                    @foreach ($userInsights as $insight)
                        <li>{!! $insight !!}</li>
                    @endforeach
                </ul>
            </div>

        @endif
      @if (collect($summaryStatistics)->every(fn($value) => is_null($value)))
      <!-- Display a message if $summaryStatistics is empty or not available -->
            <div class="alert alert-info mt-3" role="alert">
                {{ __('Summary statistics are not available.') }}
            </div>
      @else
      <div class="card">
          <div class="card-header bg-primary text-white">
              <h5 class="card-title mb-0">Summary Statistics</h5>
          </div>
          <div class="card-body">
              <ul class="list-unstyled">
                  <li class="mb-2"><strong>Average Rating:</strong> {{ $summaryStatistics['averageRating'] }}
                  </li>
                  <li class="mb-2"><strong>Minimum Rating:</strong> {{ $summaryStatistics['minRating'] }}</li>
                  <li class="mb-2"><strong>Maximum Rating:</strong> {{ $summaryStatistics['maxRating'] }}</li>
              </ul>
          </div>
      </div>
            
        @endif


    </div>

    {{-- handle modal edit with ajax  --}}

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
                    console.log("status " + response.status); // Log the entire response

                    $("#edit_modal_form")[0].reset();
                    // $('.modalEdit').modal('hide');
                    $('#editProgressModal').modal('hide');

               const barsElement = document.getElementById("bars");

        if (barsElement) {
            // Clear the existing content
            barsElement.innerHTML = "";

            // Iterate over the data and create HTML elements
            response.data.forEach(function(item) {
                const label = item.label;
                const value = parseFloat(item.value);
                const id = item.id;
                const inputName = item.inputName;
        console.log('label', label)
               console.log('type value',typeof value)
               console.log('id', id)
               console.log('inputName', inputName)
                const barHtml = `<x-charts.single-data-percentage-bar label="${label}" value="${value}" max="10" id="${id}" type="edit" />`;
                const modalHtml = `<x-edit-progress-rating-modal modalId="editProgressModal${id}" modalLabel="Edit Progress" formAction="#" :inputName="${inputName}" :rating="${value}" :id="${id}" />`;

                // Append the HTML elements to #bars
                barsElement.insertAdjacentHTML("beforeend", barHtml + modalHtml);
            });
                   

                    //    alert(
                    //         'Updated',
                    //         'Progress updated successfully.',
                    //         'success'
                    //     );



                },
                error: (error) => {
                    // alert("error");
                    console.log(error)
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


    {{-- data table  --}}
    <script>
    $(document).ready(function() {
        var table = $('#progressTable').DataTable({
            "paging": true, // Enable pagination
            "pageLength": 10, // Number of records per page
            "ordering": true, // Enable column sorting
            "order": [[0, 'asc']], // Default sorting column and order
            "searching": true, // Enable search
            "language": { // Localization
                "search": "Custom Search Text:",
                "paginate": {
                    "next": "Next Page",
                    "previous": "Previous Page"
                }
            },
            "columnDefs": [
                {
                    "targets": [0], // Target the first column
                    "visible": true, // Hide the first column
                }
            ],
            "dom": 'lBfrtip', // Control the placement of components
            "buttons": [ // DataTables Buttons extension
                'copy', 'excel', 'pdf', 'print'
            ]
        });

        // Custom event example
        $('#sortable-table tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            // alert('Clicked on row with title: ' + data[1]);
        });
    });
</script>
    <x-footer />
</x-master>
