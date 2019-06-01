<div class="model-data">
    <h3>Акция № &nbsp;{{$saleModel->getId()}}</h3>
    <input type="hidden" id="saleId" value="{{$saleModel->getId()}}">

    <table class="table">
        <thead>
        <th><label for="name" class="header-label">Заголовок</label></th>
        <th><label for="name" class="header-label">Краткое описание</label></th>
        <th><label for="name" class="header-label">Полный текст акции</label></th>
        <th><label for="name" class="header-label">Дата</label></th>
        </thead>
        <tbody>
        <tr>
            <td><span id="title">{{$saleModel->getTitle()}}</span></td>
            <td><span id="summary">{{$saleModel->getSummary()}}</span></td>
            <td><span id="text">{{$saleModel->getText()}}</span></td>
            <td><span id="date">{{$saleModel->getDate()}}</span></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение акции № &nbsp; {{$saleModel->getId()}}
            </div>
            <form id="editSaleForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id" value="{{$saleModel->getId()}}">
                        <div class="form-group form-container">
                            <label for="name">Заголовок</label>
                            <input type="text" name="title" class="form-control" value="{{$saleModel->getTitle()}}">
                        </div>
                        <div class="form-group form-container">
                            <label for="name">Краткое содержание</label>
                            <textarea type="text" name="summary"
                                      class="form-control">{{$saleModel->getSummary()}}</textarea>
                        </div>

                        <div class="form-group form-container">
                            <label for="name">Текст</label>
                            <textarea type="text" name="text" class="form-control" cols="10"
                                      rows="5">{{$saleModel->getText()}}</textarea>
                        </div>

                        <div class="form-group form-container">
                            <label for="name">Дата</label>
                            <input type="date" name="date" class="form-control" value="{{$saleModel->getDate()}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modal--success" id="saveEdit">Сохранить</button>
                    <button type="reset" id="cancelEdit" class="btn btn-modal--danger" data-dismiss="modal">Отмена
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>