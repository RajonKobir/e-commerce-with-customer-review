@extends('backend.layouts.app')

@section('content')

    <!-- dataTable css  -->
    <!-- <link rel="stylesheet" href="/css/select.dataTables.css"> -->

    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Users</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('admin.user.download') }}" class="btn btn-success text-white">Download
                                as TXT</a>
                        </div>
                        {{-- <div class="col-auto">
                            <a class="btn app-btn-primary" href="{{ route('admin.user.create') }}">
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

        <!-- custom notification  -->
        <div id="notification_area">
    
        </div>



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
                            
                                <label for="countryFilter">Country:</label>
                                <select id="countryFilter">
                                    <option value="">All</option>
                                    @php
                                    $all_countries = [];
                                    foreach ($users as $user_key=>$user){
                                        if( !in_array($user->country_name, $all_countries) ){
                                    @endphp
                                        <option value="{{ $user->country_name }}">{{ $user->country_name }}</option>
                                    @php
                                            array_push($all_countries, $user->country_name);
                                        }
                                    }
                                    @endphp
                                </select>

                                <div class="d-inline-block" style="margin-left: 10px;">
                                    <button id="addToManyOpenModal" class="btn btn-success text-white" data-mdb-toggle="modal" data-mdb-target="#addToManyModal" > Add Note To Many </button>
                                </div>


                            </div>
                            <table id="user_table" class="display">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country Name</th>
                                        <th>Added date</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
                <nav class="app-pagination">
                    <div class="mx-auto">
                        {{-- {{ $users->links() }} --}}
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


                </nav><!--//app-pagination-->

            </div><!--//tab-pane-->
        </div><!--//tab-content-->



    </div><!--//container-fluid-->


    <div class="modal fade" id="addToManyModal" tabindex="-1" aria-labelledby="addToManyModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" >Add Note To Many Users</h1>
                    <button type="button" id="addToManyModalClose" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea id="add_user_note" name="add_user_note" minlength="10" maxlength="250" class="form-control" style="min-height: 150px"  ></textarea>
                    </div>
                    <div id="empty_note_error">

                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" id="addToMany" class="btn btn-success text-white" >Save</button>
                    </div>
                </div>
            </div>
        </div>
    <div>



@endsection

@section('custom_script')

    <!-- jquery js  -->
    <script type="text/javascript" src="/js/jquery-3.7.1.min.js"></script>

    <!-- datatable js  -->
    <script src="/js/dataTables.js"></script>

    <!-- datatable select js  -->
    <script src="/js/dataTables.select.js"></script>


    <script>

          // Define deleteUser function in the global scope
            function deleteUser(userId) {

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
               
                if (confirm("are you sure you want to delete this user?") == true) {
                    //text = "You pressed OK!";
                    //console.log("🚀 ~ deleteUser ~ userId:", userId);

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // For CSRF protection
                        'Authorization': 'Bearer ' + csrfToken // Include the token in the Authorization header
                    }
                });

                    $.ajax({
                        url: "/api/delete_user/" + userId, // Replace with your API endpoint
                        method: "DELETE", // Use "DELETE" method for deletion
                        contentType: "application/json",
                        success: function(response) {
                            // Handle the successful response from the API here
                            if(response.success === true){
                                alert('User deleted successfully!');
                                // Optionally, you can refresh the table or remove the deleted row from the UI
                                $('#user_table').DataTable().ajax.reload();
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

            var table = $('#user_table').DataTable({
                ajax: {
                    url: 'http://localhost:8000/api/get_user',
                    dataSrc: '',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    }
                },
                columns: [
                    { 
                        data: 'id',
                        orderable: false,
                        className: 'select-checkbox',
                        render: DataTable.render.select()
                    },
                    { 
                        data: 'id',
                        className: 'user_id'
                    },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'country_name' },
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
                        data: 'mobile',
                        render: function (data, type, row) {
                            if (row.dial_code && data) {
                                var fullNumber = row.dial_code + data;
                                return '<a href="https://api.whatsapp.com/send/?phone='+ fullNumber + '&text&type=phone_number&app_absent=0" target="_blank">' + fullNumber + '</a>';
                            } else if (data) {
                                return '<a href="tel:' + data + '">' + data + '</a>';
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'action',
                        render: function (data, type, row) {
                            return '<span onclick="deleteUser('+ row.id + ')" style="cursor: pointer">Delete</span>';
                        }
                    },
                    { 
                        data: 'note', 
                        render: function (data, type, row) {
                            return `
                                    <form class="auth-form login-form" action="{{ route('admin.user.addNote') }}" method="POST" >
                                        @csrf
                                        <textarea name="user_note" minlength="10" maxlength="250">`+data+`</textarea>
                                        <input type="hidden" name="user_id" value="${row.id}" />
                                        <button type="submit" class="btn btn-success text-white" > Save </button>
                                    </form>
                                    `;
                        }
                    },
                    { 
                        data: 'created_at', 
                        visible: false  // Hide the original date column
                    },
                   
                ],
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    }
                ],
                'select': {
                    'style': 'multi',
                    'selector': 'td:first-child'
                },
                deferRender: true,
                order: [[0, 'desc']]  // Default sort by the first column (id) in descending order
            });
    
            // Custom filtering function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    
                    var dateRange = $('#dateRange').val();
                    var country = $('#countryFilter').val();
                    var createdAt = new Date(data[9]); // Assuming 'created_at' is the 9th column
    
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
    
                    if (country && data[4] !== country) { // Assuming 'country_name' is the 4th column
                        return false;
                    }
    
                    return true;
                }
            );
    
            // Event listeners for the filters
            $('#dateRange, #countryFilter').change(function() {
                table.draw();
            });


            // initializing 
            var selected_rows;
            var add_user_note;
            var all_selected_users;

            $("#addToManyOpenModal").click(function(e){
                e.preventDefault();
                $("#notification_area").html('');
                $(".alert .btn-close").click();
                selected_rows = [];
                selected_rows = $('#user_table tr.selected .user_id');
                if(selected_rows.length == 0){
                    setTimeout(function(){
                        $('#addToManyModalClose').click();
                        $("#notification_area").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Please Select At Least One Item From The Left Column!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }, 1000);
                }
            });

            $("#addToMany").click(function(e){
                e.preventDefault();
                $('#empty_note_error').html('');
                $("#notification_area").html('');
                $(".alert .btn-close").click();
                add_user_note = $('#add_user_note').val();
                if(add_user_note == ''){
                    setTimeout(function(){
                        $('#empty_note_error').html('<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Please Write A Note!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }, 500);
                    return;
                }
                if(add_user_note.length < 10){
                    setTimeout(function(){
                        $('#empty_note_error').html('<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Please put at least 10 characters!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }, 500);
                    return;
                }
                $('#addToManyModalClose').click();
                all_selected_users = [];
                for (let i = 0; i < selected_rows.length; i++) {
                    all_selected_users.push(parseInt(selected_rows[i].innerHTML));
                }

                $.ajax({
                    url: "{{ route('admin.user.addNoteToMany') }}", // Adjust the route syntax here
                    method: "POST",
                    data: {
                        _token: csrfToken,
                        all_selected_users,
                        add_user_note
                    },
                    success: function(response) {
                        $("#notification_area").html('<div class="success_message alert alert-success alert-dismissible fade show" role="alert">'+response+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                        // initializing
                        var remaining_time = 4;
                        var previous_message;
                        const myInterval = setInterval(myTimer, 1000);
                        function myTimer() {
                            $(".success_message").html(response + ' This page will be reloaded within ' + remaining_time + ' seconds...');
                            remaining_time--;
                        }
                        function myStop() {
                            clearInterval(myInterval);
                        }

                        setTimeout(function(){
                            myStop();
                            window.location.reload();
                        }, 5000);
                    },
                    error: function(xhr, status, error) {
                        $("#notification_area").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">An error occurred while saving the note.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                });

                all_selected_users = [];
                $('#add_user_note').val('');

            });


        });



    </script>
    
@endsection