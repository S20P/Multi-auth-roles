@if (isset($errors) && $errors->any())
    <b-alert
        variant="danger"
        show="true"
        dismissible
    >
        <ul class="pl-3 py-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </b-alert>
@endif



                @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif