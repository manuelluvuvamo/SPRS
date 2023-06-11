<div class="row">
    @isset($user->profile_photo_path)
        <div class="col-sm-12 m-2">

            <div class="card card-outline-info h-100">
                <div class="card-img-top">
                    <img src="{{ asset($user->profile_photo_path) }}" class="grayscale img-fluid mx-auto d-block"
                        width="200">
                </div>
            </div>

        </div>
    @endisset
</div>

<div class="card border shadow-none mb-5">
    <div class="card-header d-flex align-items-center">
        <div class="flex-shrink-0 me-3">
            <div class="avatar">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                    01
                </div>
            </div>
        </div>
        <div class="flex-grow-1">
            <h5 class="card-title">Informações Pessoais</h5>
        </div>
    </div>
    <div class="card-body">
        <div>

            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="mb-3">
                            <label class="form-label" for="first_name">Nome</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                id="first_name" name="first_name" placeholder="" required
                                value="{{ isset($user->first_name) ? $user->first_name : old('first_name') }}" />
                            @error('first_name')
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
                            <label class="form-label" for="middle_name">Nomes do Meio</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                id="middle_name" name="middle_name" placeholder="" 
                                value="{{ isset($user->middle_name) ? $user->middle_name : old('middle_name') }}" />
                            @error('middle_name')
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
                            <label class="form-label" for="last_name">Sobrenome</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                id="last_name" name="last_name" placeholder="" required
                                value="{{ isset($user->last_name) ? $user->last_name : old('last_name') }}" />
                            @error('last_name')
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
                            <label class="form-label" for="name">Nome de usuário</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="" required
                                value="{{ isset($user->name) ? $user->name : old('name') }}" />
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
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="email@example.com" required
                                value="{{ isset($user->email) ? $user->email : old('email') }}" />
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
                            <label class="form-label" for="phone_number">Telefone</label>
                            <div class="input-group input-group-merge">
                                {{-- <span class="input-group-text">ANG (+244)</span> --}}
                                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number"maxlength="9" name="phone_number" placeholder="999 999 999"
                                    value="{{ isset($user->phone_number) ? $user->phone_number : old('phone_number') }}" />
                            </div>


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
                            <label class="form-label" for="genero">Gênero</label>
                            <div class="input-group input-group-merge">

                                <select type="text"
                                    class="form-control border-secondary  @error('genero') is-invalid @enderror"
                                    name="genero" required>


                                    <option
                                        {{ isset($user->genero) && $user->genero == 'Masculino' ? 'selected' : '' }}
                                        value="Masculino">Masculino</option>
                                    </option>

                                    <option {{ isset($user->genero) && $user->genero == 'Feminino' ? 'selected' : '' }}
                                        value="Feminino">Feminino</option>
                                    </option>
                                </select>
                            </div>


                            @error('genero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                @if (Auth::user()->level == 'Administrador')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="level">{{ __('Nível') }}</label>
                            <select class="form-control @error('level') is-invalid @enderror" name="level"
                                id="level" required autocomplete="level" onchange="alterarNivel()">


                                <option {{ isset($user->level) && $user->level == 'Administrador' ? 'selected' : '' }}
                                    value="Administrador">Administrador</option>
                                </option>
                                <option {{ isset($user->level) && $user->level == 'Entidade' ? 'selected' : '' }}
                                    value="Entidade">
                                    Entidade</option>
                                </option>

                            </select>

                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-md-4" hidden>
                        <div class="form-group">
                            <label for="level">{{ __('Nível') }}</label>
                            <select class="form-control @error('level') is-invalid @enderror" name="level"
                                id="level" required autocomplete="level" onchange="alterarNivel()">


                                <option {{ isset($user->level) && $user->level == 'Administrador' ? 'selected' : '' }}
                                    value="Administrador">Administrador</option>
                                </option>
                                <option {{ isset($user->level) && $user->level == 'Entidade' ? 'selected' : '' }}
                                    value="Entidade">
                                    Entidade</option>
                                </option>

                            </select>

                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif
                @if (Auth::user()->level == 'Administrador')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_curso" class="form-label">Entidade *</label>
                            <select
                                class="js-example-basic-single form-control @error('id_entity') is-invalid @enderror"
                                id="id_entity" name="id_entity" value="old('id_entity')" required
                                {{ isset($user) && $user->level == 'Entidade' ? '' : 'disabled' }}
                                style="height: 40px!important;">

                                <option value="{{ isset($user) ? $user->id_entity : '0' }}"
                                    {{ isset($func) ? '' : 'selected' }}>
                                    {{ isset($user) ? $user->vc_entidade : 'Seleccionar entidade' }}
                                </option>

                                @isset($entities)
                                    @foreach ($entities as $entity)
                                        <option value="{{ $entity->id }}" {{ isset($func) ? 'selected' : '' }}>
                                            {{ $entity->name }}
                                        </option>
                                    @endforeach
                                @endisset



                            </select>
                            @error('id_curso')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="id_curso" class="form-label">Entidade *</label>
                            <select class=" form-control @error('id_entity') is-invalid @enderror" id="id_entity"
                                name="id_entity" value="old('id_entity')" required
                                {{ isset($user) && $user->level == 'Entidade' ? 'readonly' : '' }}
                                style="height: 40px!important;" readonly>

                                <option value="{{ isset($user) ? $user->id_entity : '0' }}"
                                    {{ isset($func) ? '' : 'selected' }}>
                                    {{ isset($user) ? $user->vc_entidade : 'Seleccionar entidade' }}
                                </option>

                                @isset($entities)
                                    @foreach ($entities as $entity)
                                        <option value="{{ $entity->id }}" {{ isset($func) ? 'selected' : '' }}>
                                            {{ $entity->name }}
                                        </option>
                                    @endforeach
                                @endisset



                            </select>
                            @error('id_curso')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif
                <br><br><br><br>
                <div class="col-md-12">
                    <label for="upload">Foto de Perfil</label><br>
                    <input type="file" id="upload" class="account-file-input form-control" accept="image/*"
                        name="profile_photo_path" />
                </div>
            </div>







        </div>
    </div>
</div>
<!-- end card -->


<div class="card border shadow-none mb-5">
    <div class="card-header d-flex align-items-center">
        <div class="flex-shrink-0 me-3">
            <div class="avatar">
                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                    02
                </div>
            </div>
        </div>
        <div class="flex-grow-1">
            <h5 class="card-title">Segurança</h5>
        </div>
    </div>
    <div class="card-body">

        @if (isset($edit))
            <div>
                <div class="form-check mb-3" data-bs-toggle="collapse" data-bs-target="#collapseChangePassword"
                    aria-expanded="false" aria-controls="collapseChangePassword">
                    <input type="checkbox" class="form-check-input" id="gen-info-change-password"
                        name="checkbox"onchange="updatePassword()">
                    <label class="form-check-label" for="gen-info-change-password">Alterar a
                        Senha?</label>
                </div>

                <div class="" id="collapseChangePassword">
                    <div class="card border card-body">
                        <div class="row">
                            @if (Auth::user()->level == 'Administrador')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">{{ __('Senha') }}</label>
                                        <input value="" id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Senha do utiizador"
                                            value="{{ isset($user) ? '' : 'required' }}" required disabled
                                            autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">{{ __('Confirme a Senha') }}</label>
                                        <input value="" id="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Confirme a senha do utilizador"
                                            value="" required disabled>

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-4">
                                    <div class="mb-lg-0">
                                        <div class="form-group">
                                            <label for="currentPassword">{{ __('Senha Actual') }}</label>
                                            <input value="" id="currentPassword" type="password"
                                                class="form-control @error('currentPassword') is-invalid @enderror"
                                                name="currentPassword" placeholder="Senha actual do utilizador"
                                                value="" disabled>

                                            @error('currentPassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="password">{{ __('Nova Senha') }}</label>
                                        <input value="" id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Senha do utiizador"
                                            autocomplete="new-password" disabled>


                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">{{ __('Confirme a Senha') }}</label>
                                        <input value="" id="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Confirme a senha do utilizador"
                                            value="" disabled>


                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @else
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">{{ __('Senha') }}</label>
                            <input value="" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Senha do utiizador" value="{{ isset($user) ? '' : 'required' }}"
                                required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirme a Senha') }}</label>
                            <input value="" id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" placeholder="Confirme a senha do utilizador"
                                value="" required>

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>



                </div>
        @endif
    </div>
</div>
<!-- end card -->


<script>
    function alterarNivel() {
        var level = document.getElementById("level").value;


        if (level == "Entidade") {
            document.getElementById("id_entity").removeAttribute('disabled');
            document.getElementById("id_entity").setAttribute('required', 'required');


        } else if (level == "Administrador") {
            document.getElementById("id_entity").setAttribute('disabled', 'disabled');
            document.getElementById("id_entity").removeAttribute('required');

        }
    }
</script>
