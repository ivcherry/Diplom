<div class="model-data">
        <h3>Характеристика №{{$featureModel->getId()}}</h3>
<input type="hidden" id="featureId" value="{{$featureModel->getId()}}">
    <label for="name">Название:</label>
    <p> {{$featureModel->getName()}} </p>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение характеристики № {{$featureModel->getId()}}
            </div>
            <form id="editFeatureForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <div class="row form-inline">
                        <input type="hidden" name="id" value="{{$featureModel->getId()}}">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" class="form-control" value="{{$featureModel->getName()}}">
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
