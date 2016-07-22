<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1></h1>

            <h3>Registration</h3>
            <form method="POST" action="/register" name="Sign Up">

                {!! csrf_field() !!}

                <div class="form-group">
                    Name
                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    Email
                    <input name="email" type="text" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    Phone
                    <input name="phone" type="text" class="form-control">
                </div>

                <div class="form-group">
                    Occupation
                    <input name="occupation" type="text" class="form-control">
                </div>

                <div class="form-group">
                    Password
                    <input name="password" type="password" class="form-control">
                </div>

                <div class="form-group">
                    <button name="Sign Up" type="submit" class="btn btn-primary" value="Sign Up">Sign Up</button>
                </div>
            </form>
            @if(count($errors))
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>