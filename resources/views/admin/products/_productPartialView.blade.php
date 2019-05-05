<div class="model-data dl-horizontal">
    <h3>Товар №{{$product->getId()}}</h3>
    <input type="hidden" id="productId" name="productId" value="{{$product->getId()}}">
    <div class="form-group row">
        <label for="name">Название:</label>
        <span name="name">{{$product->getName()}}</span>
    </div>
    <div class="row form-group ">
        <label for="price">Цена(руб):</label>
        <span name="price">{{$product->getPrice()}}</span>
    </div>
    <div class="row form-group ">
        <label for="description">Описание:</label>
        <span name="description">{{$product->getDescription()}}</span>
    </div>
    <div class="row form-group">
        <label for="amount">Количество:</label>
        <span name="amount">{{$product->getAmount()}}</span>
    </div>
    <div class="row form-group ">
        <label for="type">Подкатегория:</label>
        <span name="type">{{$product->getType()->getName()}}</span>
    </div>
    <div class="row form-group ">
        <label for="producer">Производитель:</label>
        <span name="producer">{{$product->getProducer()}}</span>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение товара №
            </div>
            <form id="editProductForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <div class="row">
                        <input type="hidden" name="id" value="{{$product->getId()}}">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" class="form-control" value="{{$product->getName()}}">
                        </div>
                        <div class="form-group">
                            <label for="subCategory">Подкатегория</label>
                            <input id="subCategoryDropDown" name="subCategory" style="width: 100%;" value="{{$product->getType()->getId()}}">
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input id="price" type="number" name="price" title="currency" min="0" style="width: 100%;" value="{{$product->getPrice()}}"/>
                        </div>
                        <div class="form-group">
                            <label for="amount">Количество</label>
                            <input id="amount" type="number" name="amount" title="currency" min="0" style="width: 100%;" value="{{$product->getAmount()}}"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea id="description" class="form-control" name="description">{{$product->getDescription()}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="producer">Производитель</label>
                            <input id="producer" class="form-control" name="producer" type="text" value="{{$product->getProducer()}}"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="saveEdit">Сохранить</button>
                    <button type="reset" id="cancelEdit" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>



