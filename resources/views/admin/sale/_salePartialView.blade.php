<div class="model-data">
    <h3>Акция №{{$saleModel->getId()}}</h3>
    <input type="hidden" id="saleId" value="{{$saleModel->getId()}}">
    <div class="row">
        <label for="name">Заголовок:</label>
        <input type="text" name="name" class="" id="title" value="{{$saleModel->getTitle()}}" disabled="disabled"
               width="300"/>

    </div>
    <div class="row">
        <label for="name">Краткое описание:</label>
        <input type="text" name="name" class="" id="summary" value="{{$saleModel->getSummary()}}" disabled="disabled"
               width="300"/>
    </div>
    <div class="row">
        <label for="name">Полный текст акции:</label>
        <input type="text" name="name" class="" id="text" value="{{$saleModel->getText()}}" disabled="disabled"
               width="300"/>
    </div>

    <div class="row">
        <label for="name">Дата:</label>
        <input type="text" name="name" class="" id="date" value="{{$saleModel->getDate()}}" disabled="disabled"
               width="300"/>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение акции № {{$saleModel->getId()}}
            </div>
            <form id="editSaleForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id" value="{{$saleModel->getId()}}">
                        <div class="form-group">
                            <label for="name">Заголовок</label>
                            <input type="text" name="title" class="form-control" value="{{$saleModel->getTitle()}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Краткое содержание</label>
                            <textarea type="text" name="summary" class="form-control" >{{$saleModel->getSummary()}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">Текст</label>
                            <textarea type="text" name="text" class="form-control" >{{$saleModel->getText()}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">Дата</label>
                            <input type="date" name="date" class="form-control" value="{{$saleModel->getDate()}}">
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