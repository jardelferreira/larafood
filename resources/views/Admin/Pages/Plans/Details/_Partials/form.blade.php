@include('Admin.Includes.alerts')
<div class="form-group">
  <label for="name">Detalhe</label>
  <input type="text" class="form-control" name="name" value="{{$detail->name ?? old('name')}}" id="name" aria-describedby="nameHelp" placeholder="detalhes do plano">
  <small id="nameHelp" class="form-text text-muted">novo detalhe do plano</small>
</div>