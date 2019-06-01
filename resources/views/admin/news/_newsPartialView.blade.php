<div class="model-data">
    <h3>Новость №{{$newsModel->getId()}}</h3>
    <table class="table">
        <thead>
        <tr>
            <th><label for="name" class="header-label">Заголовок</label></th>
            <th><label for="name" class="header-label">Краткое описание</label></th>
            <th><label for="name" class="header-label">Полный текст новости</label></th>
            <th><label for="name" class="header-label">Дата</label></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div id="title">{{$newsModel->getTitle()}}</div>
            </td>
            <td>
                <div id="summary">{{$newsModel->getSummary()}}</div>
            </td>
            <td>
                <div id="text">{{$newsModel->getText()}}</div>
            </td>
            <td>
                <div id="date">{{$newsModel->getDate()}}</div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                Измененение новости № {{$newsModel->getId()}}
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
                            <textarea type="text" name="summary"
                                      class="form-control">{{$newsModel->getSummary()}}</textarea>
                        </div>

                        <div class="form-group form-container">
                            <label for="name">Текст</label>
                            <textarea type="text" name="text" class="form-control" cols="10"
                                      rows="5">{{$newsModel->getText()}}</textarea>
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



