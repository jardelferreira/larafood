<div class="form-group">
  <label for="title">Produto</label>
  <input type="text" value="{{$product->title ?? old('title')}}" class="form-control" name="title" id="title" aria-describedby="nameHelp" placeholder="nome do Produto">
  <small id="nameHelp" class="form-text text-muted">informe o título do Produto</small>
</div>
<div class="form-group">
  <label for="price">Preço</label>
  <input type="number" step="0.01" value="{{ $product->price ?? old('price') }}"
    class="form-control" name="price" id="price" aria-describedby="priceHelp" placeholder="99.99">
  <small id="priceHelp" class="form-text text-muted">informe o preço</small>
</div>
<div class="form-group">
  <label for="image">Imagem</label>
  <input type="file" class="form-control-file" name="image" id="image" placeholder="Imagem" aria-describedby="imageHelp">
  <small id="imageHelp" class="form-text text-muted">selecione uma imagem</small>
</div>
<div class="form-group">
  <label for="description">Descrição</label>
<textarea class="form-control" name="description" id="description" rows="3">{{$product->description ?? ""}}</textarea>
</div>