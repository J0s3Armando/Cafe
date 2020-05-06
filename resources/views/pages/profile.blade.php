@extends('layouts.main')
@section('title')
    <title>Mi perfil</title>
@endsection 
@section('section')
   <div class="container">
    @if(session('info'))
        <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
            {{session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mis datos</div>
                <div class="card-body">
                    <form method="POST" id="updateForm" action="{{route('user.update.data')}}">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last_name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" maxlength="50" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name',$user->last_name)}}"
                                required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" maxlength="200" type="text" class="form-control @error('address') is-invalid @enderror"
                                 name="address" value="{{ old('address',$user->address) }}" required autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cp" class="col-md-4 col-form-label text-md-right">{{ __('CP') }}</label>
                            <div class="col-md-6">
                                <input id="cp" type="text" maxlength="5" class="form-control @error('cp') is-invalid @enderror"
                                name="cp" value="{{ old('cp',$user->cp) }}" required autocomplete="cp" autofocus>
                                @error('cp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text"  maxlength="10" class="form-control @error('phone') is-invalid @enderror" 
                                name="phone" value="{{ old('phone',$user->phone) }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" placeholder="********" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="********" type="password" class="form-control" name="password_confirmation" 
                                autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" disabled="true" id="btnUpdate" class="btn btn-muk-cafe">
                                   Actualizar datos
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        document.getElementById('updateForm').onchange = function()
        {
            document.getElementById('btnUpdate').disabled =false;
        };
    </script>
@endsection