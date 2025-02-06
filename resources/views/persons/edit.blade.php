@extends('app.layout')

@section('content')
    <h1>Edit</h1>
    <form action="{{ route('persons.update', $person->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">First mame:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $person->firstName) }}"
                   required>
        </div>

        <div>
            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $person->lastName) }}"
                   required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $person->email) }}" required>
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $person->phone) }}" required>
        </div>

        <div>
            <label for="email_subscription">Email subscription:</label>
            <input type="checkbox" id="email_subscription" name="email_subscription"
                   value="1" {{ old('email_subscription', $person->emailSubscription) ? 'checked' : '' }}>
        </div>

        <div>
            <label for="sms_subscription">SMS subscription:</label>
            <input type="checkbox" id="sms_subscription" name="sms_subscription"
                   value="1" {{ old('sms_subscription', $person->smsSubscription) ? 'checked' : '' }}>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>
    </form>
    @if(session('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session('errors')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection
