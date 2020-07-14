@include('Admin.Includes.alerts')
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $plan->name ?? old('name')}}" aria-describedby="nameHelp" placeholder="nome do plano">
    <small id="nameHelp" class="form-text text-muted">informe o nome do plano</small>
  </div>
  <div class="form-group">
    <label for="price">Preço</label>
    <input type="number" step="0.01" value="{{ $plan->price ?? old('price') }}"
      class="form-control" name="price" id="price" aria-describedby="priceHelp" placeholder="99.99">
    <small id="priceHelp" class="form-text text-muted">informe o preço</small>
  </div>
  <div class="form-group">
    <label for="description">Descrição do Plano</label>
    <textarea class="form-control" name="description" id="description" rows="3">{{ $plan->description ?? old('price') }}</textarea>
  </div>