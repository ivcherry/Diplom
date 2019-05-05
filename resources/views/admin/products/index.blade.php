@extends('admin.layouts.adminLayout')

@section('content')
    <div class="admin container">
        <div class="model-buttons">
              <button id="add" class="buttons-custom btn btn-default" type="button" data-toggle="modal" data-target="#addModal">Добавить</button>
              <button id="delete" class="buttons-custom btn btn-default">Удалить</button>
              <button id="edit" class="buttons-custom btn btn-default" type="button" data-toggle="modal" data-target="#editModal">Изменить</button>
        </div>
        <div class="model-processing">
            <div class="current-type-model" id="currentProductsModel">
            </div>

        </div>

        <div class="bottom">
            <div id="grid" style="height: 350px;"></div>
        </div>

    </div>
    <div class="modal fade" id="addModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    Добавление товара
                </div>
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <form id="addProductForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input type="text" name="name" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="subCategory">Подкатегория</label>
                                <input id="subCategoryDropDownAdd" name="subCategory" style="width: 100%;">
                            </div>
                            <div class="form-group">
                                <label for="price">Цена</label>
                                <input id="addPrice" type="number" name="price" title="currency" min="0" style="width: 100%;" />
                            </div>
                            <div class="form-group">
                                <label for="addAmount">Количество</label>
                                <input id="amount" type="number" name="amount" title="currency" min="0" style="width: 100%;" />
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea id="description" class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="producer">Производитель</label>
                                <input id="producer" class="form-control" name="producer" type="text">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="saveAdd">Добавить</button>
                            <button type="reset" id="cancelAdd" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/products/products.js"></script>
    <script>

    </script>
@endsection
