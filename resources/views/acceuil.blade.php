@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <body>
<table >
<tr>

<td>First Name</td>

</tr>
@foreach ($users as $user)
<tr>

<td>{{ $user->name }}</td>

</tr>
<tr>
<td>{{ $user->email }}</td>
</tr>
@endforeach
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
