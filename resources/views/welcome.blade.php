@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 90%;">
        <div class="row justify-content-center">
            <div class="card" style="max-width: 100%;">
                <div class="card-header">Logs List</div>
                <div class="list-button">
                    <a href="{{ route('logs.form.create') }}" class="btn btn-success">Add new log</a>
                </div>
                <table class="table table-borderless" width="80%" id="logs-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Action</th>
                        <th>Method</th>
                        <th>IP</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deleteLog(id) {
            $.ajax({
                type: 'DELETE',
                url: `/api/logs/${id}`,
                success: () => {
                    getLogs();
                },
            })
        }

        function getLogs() {
            $.ajax({
                type: 'GET',
                url: "{{ route('logs.list') }}",
                success: showLogs,
            })
        }

        function showLogs(response) {
            if (response) {
                $("#logs-table > tbody").empty();
                response.data.map(item => {
                    $("#logs-table > tbody").append(
                        "<tr>" +
                        `   <td>${item.id}</td>` +
                        `   <td>${item.action}</td>` +
                        `   <td>${item.method}</td>` +
                        `   <td>${item.ip}</td>` +
                        `   <td>${item.city}</td>` +
                        `   <td>${item.country}</td>` +
                        `   <td>${item.type}</td>` +
                        `   <td>${item.created_at}</td>` +
                        "   <td>" +
                        "      <div>" +
                        `          <button style='display: inline; float: left;' class="btn btn-danger" onclick=deleteLog(${item.id})>Delete</button>` +
                        `          <a style='display: inline; float: left;' href="/update/${item.id}" class="btn btn-warning">Update</a>` +
                        `          <a style='display: inline; float: left;' href="/info/${item.id}" class="btn btn-info">Details</a>` +
                        "      </div>" +
                        "   </td>" +
                        "</tr>"
                    );
                });
            }
        }

        $(document).ready(function () {
            getLogs();
        });
    </script>
@endsection
