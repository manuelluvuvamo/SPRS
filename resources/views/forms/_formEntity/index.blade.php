<div class="row">
    @isset($entity->image)
        <div class="col-sm-12 m-2">

            <div class="card card-outline-info h-100">
                <div class="card-img-top">
                    <img src="{{ asset($entity->image) }}" class="grayscale img-fluid mx-auto d-block" width="200">
                </div>
            </div>

        </div>
    @endisset

    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="name">Nome da Entidade</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="" required
                    value="{{ isset($entity->name) ? $entity->name : old('name') }}" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="short_name">Nome Curto da Entidade</label>
                <input type="text" class="form-control @error('short_name') is-invalid @enderror"
                    id="short_name" name="short_name" placeholder=""
                    value="{{ isset($entity->short_name) ? $entity->short_name : old('short_name') }}"
                    maxlength="10" />
                @error('short_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="" required
                    value="{{ isset($entity->email) ? $entity->email : old('email') }}" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="nif">NIF</label>
                <input type="text" class="form-control @error('nif') is-invalid @enderror" id="nif"
                    name="nif" placeholder=""
                    value="{{ isset($entity->nif) ? $entity->nif : old('nif') }}" maxlength="14" />
                @error('nif')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="phone_number">Telefone</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                    id="phone_number"maxlength="9" name="phone_number" placeholder="" required
                    value="{{ isset($entity->phone_number) ? $entity->phone_number : old('phone_number') }}"
                    maxlength="14" />
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="code">Código de Entidade</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                    maxlength="5" name="code" placeholder="" required
                    value="{{ isset($entity->code) ? $entity->code : old('code') }}"  />
                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>




    <div class="col-md-12">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="image">Foto</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="foto" accept="image/*"
                    value="{{ isset($entity->image) ? $entity->image : old('image') }}" />
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


    </div>


</div>
