<div class="row">
    <div class="col-2">
        <div class="profilePicDiv" onclick="$('#profileImage').trigger('click')">
            <img src="{{route('image',[($user->image->id??0),150,150])}}" class="img-fluid img-thumbnail" >
        </div>
        <input type="file" class="d-none" name="image" id="profileImage" onchange="filepreview(this,150,150)" />
    </div>

    <div class="col-10">
        <div class="row mb-2">
            <div class="col-6">
                <label for="firstname"
                    class="required-label @error('name') is-invalid @enderror ">{{__('Name')}}</label>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white"><i class="fas fa-signature"></i></span>
                    </div>
                    <input class="form-control form-control-sm" name="name" id="name" type="text"  value="{{ old('name', optional($user)->name  ?? '') }}" minlength="1"
                        maxlength="255" placeholder="{{__('Enter firstname here...')}}">
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-4">
                <label for="email"
                    class="required-label {{ $errors->has('email') ? 'has-error' : '' }}">{{__('Email')}}</label>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control form-control-sm"  name="email"  id="email" type="text" value="{{ old('email', optional($user)->email ??'') }}" minlength="1"
                        maxlength="255" placeholder="{{__('Enter email here...')}}">
                </div>
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>

        </div>
        <div class="row mb-2">
            <div class="col-4">
                <label for="email"
                    class="{{ $errors->has('password') ? 'has-error' : '' }}">{{__('Password')}}</label>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white"><i class="fas fa-password"></i></span>
                    </div>
                    <input class="form-control form-control-sm"  name="password" id="password" type="text" value="{{ old('password') }}"
                        minlength="1" maxlength="255" placeholder="{{__('Enter password here...')}}">
                </div>
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-6">
                <label for="birth" class="{{ $errors->has('birth') ? 'has-error' : '' }}">{{__('Birth')}}</label>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white"><i class="fas fa-birthday-cake"></i></span>
                    </div>
                    <input class=" form-control form-control-sm" name="birth" id="birth" type="date" data-date-format="d M yy"
                    value="{{old('birth', optional($user)->birth)??''}}">
                </div>

                
                {!! $errors->first('birth', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
</div>