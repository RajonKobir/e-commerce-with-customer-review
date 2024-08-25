@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Subscribers</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('admin.subscriber.download') }}" class="btn btn-success text-white">Download
                                as TXT</a>
                        </div>
                        {{-- <div class="col-auto">
                            <a class="btn app-btn-primary" href="{{ route('admin.subscriber.create') }}">
                                <i class="bi bi-plus-square"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-square me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Create New
                            </a>
                        </div> --}}
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->
        @if (Session::has('success'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive p-3">
                        <div id="filters">
                                <label for="dateRange">Date Range:</label>
                                <select id="dateRange">
                                    <option value="">All</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>
                            <table id="table_id" class="display">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Email</th>
                                        <th class="cell">Added date</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @foreach ($subscribers as $subscriber)
                                        <tr>
                                            <td class="cell">{{ $subscriber->id }}</td>
                                            <td class="cell"><span>{{ $subscriber->email }}</span></td>
                                            
                                        </tr>
                                    @endforeach -->
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
                <!-- <nav class="app-pagination">
                    <div class="mx-auto">
                        {{ $subscribers->links() }}
                    </div>
                    {{-- <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul> --}}


                </nav>//app-pagination -->

            </div><!--//tab-pane-->
        </div><!--//tab-content-->



    </div><!--//container-fluid-->
@endsection



@section('custom_script')

    <!-- datatable js  -->
    <script src="/js/dataTables.js"></script>

    <script>

        // Define deleteSubscriber function in the global scope
        function deleteSubscriber(subscriberId) {

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm("are you sure you want to delete this subscriber?") == true) {

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // For CSRF protection
                'Authorization': 'Bearer ' + csrfToken // Include the token in the Authorization header
            }
        });

            $.ajax({
                url: "/api/delete_subscriber/" + subscriberId, // Replace with your API endpoint
                method: "DELETE", // Use "DELETE" method for deletion
                contentType: "application/json",
                success: function(response) {
                    // Handle the successful response from the API here
                    if(response.success === true){
                        alert('Subscriber deleted successfully!');
                        // Optionally, you can refresh the table or remove the deleted row from the UI
                        $('#table_id').DataTable().ajax.reload();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong!');
                }
            });

        } else {
            console.log("nothing to do");
        }
    }



        $(document).ready(function () {

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var table = $('#table_id').DataTable({
                ajax: {
                    url: 'http://localhost:8000/api/get_subscribers',
                    dataSrc: '',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'email' },
                    {
                        data: 'created_at',
                        render: function (data, type, row) {
                            var date = new Date(data);
                            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                            return date.toLocaleDateString('en-US', options);
                            //return data;
                        }
                    },
                    {
                        data: 'action',
                        render: function (data, type, row) {
                            return '<span onclick="deleteSubscriber('+ row.id + ')" style="cursor: pointer">Delete</span>';
                        }
                    },
                    { 
                        data: 'created_at', 
                        visible: false  // Hide the original date column
                    }
                
                ],
                order: [[0, 'desc']]  // Default sort by the first column (id) in descending order
            });

            // Custom filtering function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    
                    var dateRange = $('#dateRange').val();
                    var createdAt = new Date(data[4]); // Assuming 'created_at' is the 6th column

                    if (dateRange) {
                        var now = new Date();
                        switch (dateRange) {
                            case 'daily':
                                var dayAgo = new Date();
                                dayAgo.setDate(dayAgo.getDate() - 1);
                                if (createdAt < dayAgo || createdAt > now) return false;
                                break;
                            case 'weekly':
                                var weekAgo = new Date();
                                weekAgo.setDate(weekAgo.getDate() - 7);
                                if (createdAt < weekAgo || createdAt > now) return false;
                                break;
                            case 'monthly':
                                var monthAgo = new Date();
                                monthAgo.setMonth(monthAgo.getMonth() - 1);
                                if (createdAt < monthAgo || createdAt > now) return false;
                                break;
                            case 'yearly':
                                var yearAgo = new Date();
                                yearAgo.setFullYear(yearAgo.getFullYear() - 1);
                                if (createdAt < yearAgo || createdAt > now) return false;
                                break;
                        }
                    }

                    return true;
                }
            );

            // Event listeners for the filters
            $('#dateRange').change(function() {
                table.draw();
            });


        });
    </script>

@endsection