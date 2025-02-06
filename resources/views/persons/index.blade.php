@extends('app.layout')

@section('content')
    <h1>Persons</h1>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            @if(session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
            @endif
            @if(session('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            Send notifications to pserons
            <form action="{{ route('notifications.send') }}" method="POST">
                @csrf
                <textarea name="content"></textarea>
                <br />
                <button class="btn btn-success" type="submit">Send</button>
            </form>
            <br />
            <a class="btn btn-success" href="{{ route('persons.create') }}">Add person</a>

            <table class="table">
                <tr>
                    <th>First</th>
                    <th>Last</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Email Subscription</th>
                    <th>Sms Subscription</th>
                    <th>Action</th>
                  </tr>
                @foreach($persons as $person)
                    <tr>
                        <td>{{ $person->firstName }}</td>
                        <td>{{ $person->lastName }}</td>
                        <td>{{ $person->email }}</td>
                        <td>{{ $person->phone }}</td>
                        <td>{{ $person->emailSubscription ? 'Yes' : 'No'}}</td>
                        <td>{{ $person->smsSubscription ? 'Yes' : 'No'}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('persons.edit', $person->id) }}">Edit</a>
                            <form action="{{ route('persons.destroy', $person->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Remove</button>
                            </form>
                    </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col"></div>
    </div>
@endsection
