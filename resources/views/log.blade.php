@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="max-width: 100%;">
                <div class="card-header"><h2>Log by {{ $log['created_at'] }}</h2></div>
                <div style="margin: 10px">
                    <p><b>Class:</b> {{ $log['method'] }}</p>
                    <p><b>Method:</b> {{ $log['action'] }}</p>
                    <p><b>IP:</b> {{ $log['ip'] }}</p>
                    @if(!empty($log['city']))
                        <p><b>City:</b> {{ $log['city'] }}</p>
                    @endif
                    @if(!empty($log['country']))
                        <p><b>Country:</b> {{ $log['country'] }}</p>
                    @endif
                    <p><b>Last modified at: {{ $log['updated_at'] }}</p>
                    <br />
                    <hr />
                    <h3 align="center">Request data</h3>
                    <table width="40%">
                        <col width="70%">
                        @if(!empty($log['data']))
                            @foreach(json_decode($log['data'], true) as $key => $value)
                                <tr>
                                    <td><b>{{ $key }}</b></td>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
