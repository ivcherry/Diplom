<div class="model-data">
        <h3>Подкатегория: <strong>{{$typeModel->getGenericTypeName()}}</strong></h3>
        <input type="hidden" id="typeId" value="{{$typeModel->getId()}}">
        <div class="row">
            <label for="name" class="name-nnn">Название:</label>
            <span id="name" class="name-nnn"><strong>{{$typeModel->getName()}}</strong></span>
        </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
               Измененение подкатегории: <strong>{{$typeModel->getName()}}</strong>
            </div>
            <form id="editSubCategoryForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <div class="row">
                        <input type="hidden" name="id" value="{{$typeModel->getId()}}">
                        <div class="form-group form-container">
                            <label for="name">Название</label>
                            <input type="text" name="name" class="form-control" value="{{$typeModel->getName()}}">
                        </div>
                        <div class="form-group form-container">
                            <label for="category">Категория</label>
                            <input id="editCategoriesDropDown" class="form-control" name="category" value="{{$typeModel->getGenericTypeId()}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal--success" id="saveEdit">Сохранить</button>
                    <button type="reset" id="cancelEdit" class="btn-modal--danger" data-dismiss="modal">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>



