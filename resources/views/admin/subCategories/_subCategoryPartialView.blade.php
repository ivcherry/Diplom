<div class="model-data">
        <h3>Подкатегория №{{$typeModel->getId()}}</h3>
        <input type="hidden" id="typeId" value="{{$typeModel->getId()}}">
        <div class="row">
            <label for="name">Название:</label>
            <span id="name">{{$typeModel->getName()}}</span>
        </div>
        <div class="row">
            <label for="category">Категория:</label>
            <span id="category">{{$typeModel->getGenericTypeName()}}</span>
        </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
               Измененение подкатегории № {{$typeModel->getId()}}
            </div>
            <form id="editSubCategoryForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <div class="row">
                        <input type="hidden" name="id" value="{{$typeModel->getId()}}">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" class="form-control" value="{{$typeModel->getName()}}">
                        </div>
                        <div class="form-group">
                            <label for="category">Категория</label>
                            <input id="editCategoriesDropDown" name="category" style="width: 100%;" value="{{$typeModel->getGenericTypeId()}}">
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



