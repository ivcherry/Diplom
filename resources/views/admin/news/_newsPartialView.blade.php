<div class="model-data">
    <h3>Новость №{{$newsModel->getId()}}</h3>
    <table class="table">
        <thead>
        <th><label for="name" class="header-label">Заголовок</label></th>
        <th><label for="name" class="header-label">Краткое описание</label></th>
        <th><label for="name" class="header-label">Полный текст новости</label></th>
        <th><label for="name" class="header-label">Дата</label></th>
        </thead>
        <tbody>
        <tr>
            <td><span id="title">{{$newsModel->getTitle()}}</span></td>
            <td><span id="summary">{{$newsModel->getSummary()}}</span></td>
            <td><span id="text">{{$newsModel->getText()}}</span></td>
            <td><span id="date">{{$newsModel->getDate()}}</span></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение новости № <strong>{{$newsModel->getId()}}</strong>
            </div>
            <form id="editNewsForm">
                <div class="modal-body">
                    <div class="errors alert alert-danger">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id" value="{{$newsModel->getId()}}">
                        <div class="form-group form-container">
                            <label for="name">Заголовок</label>
                            <input type="text" name="title" class="form-control" value="{{$newsModel->getTitle()}}">
                        </div>
                        <div class="form-group form-container">
                            <label for="name">Краткое содержание</label>
                            <textarea type="text" name="summary" class="form-control" >{{$newsModel->getSummary()}}</textarea>
                        </div>

                        <div class="form-group form-container">
                            <label for="name">Текст</label>
                            <textarea type="text" name="text" class="form-control" >{{$newsModel->getText()}}</textarea>
                        </div>

                        <div class="form-group form-container">
                            <label for="name">Дата</label>
                            <input type="date" name="date" class="form-control" value="{{$newsModel->getDate()}}">
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



