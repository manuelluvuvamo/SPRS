<div class="row">


    {{--  <div class="col-md-12">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="vc_nome">Nome da Formação</label>
                <input type="text" class="form-control @error('vc_nome') is-invalid @enderror" id="vc_nome"
                    name="vc_nome" placeholder="" required
                    value="{{ isset($reference->vc_nome) ? $reference->vc_nome : old('vc_nome') }}" />
                @error('vc_nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div> --}}

    <div class="col-md-4">
        <div class="form-group">
            <label for="id_entity" class="form-label">Entidade</label>
            <select class="js-example-basic-single form-control @error('id_entity') is-invalid @enderror" id="id_entity"
                name="id_entity" value="old('id_entity')" required style="height: 40px!important;">

                <option value="{{ isset($reference) ? $reference->id_entity : '0' }}"
                    {{ isset($func) ? '' : 'selected' }}>
                    {{ isset($reference) ? $reference->name . ' - ' . $reference->code : 'Seleccionar Entidade' }}
                </option>

                @isset($entities)
                    @foreach ($entities as $entity)
                        <option value="{{ $entity->id }}" {{ isset($func) ? 'selected' : '' }}>
                            {{ $entity->name . ' - ' . $entity->code }}
                        </option>
                    @endforeach
                @endisset



            </select>
            @error('id_entity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="mb-3">
                <label class="form-label" for="amount">Valor</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    name="amount" placeholder="" required min="0" step="0.0000000001"
                    value="{{ isset($reference->amount) ? $reference->amount : old('amount') }}" />
                @error('amount')
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
                <label class="form-label" for="end_datetime">Data de Expiração</label>
                <input type="datetime-local" class="form-control @error('end_datetime') is-invalid @enderror"
                    id="end_datetime" name="end_datetime" placeholder="" required min="{{ date('Y-m-d') }}"
                    value="{{ isset($reference->end_datetime) ? $reference->end_datetime : old('end_datetime') }}" />
                @error('end_datetime')
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
                <label class="form-label" for="reference_number">Id de Referência</label>
                <input type="number" class="form-control @error('reference_number') is-invalid @enderror"
                    id="reference_number" name="reference_number" placeholder="" min="100000000" 
                    value="{{ isset($reference->reference_id) ? $reference->reference_id : old('reference_number') }}" />
                @error('reference_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>


</div>
