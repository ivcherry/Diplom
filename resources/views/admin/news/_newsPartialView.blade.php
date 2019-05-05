<div class="model-data">
    <h3>Новость №{{$newsModel->getId()}}</h3>
    <input type="hidden" id="newsId" value="{{$newsModel->getId()}}">
    <div class="row">
        <label for="name">Заголовок:</label>
        <input type="text" name="name" class="" id="title" value="{{$newsModel->getTitle()}}" disabled="disabled"
               width="300"/>

    </div>
    <div class="row">
        <label for="name">Краткое описание:</label>
        <input type="text" name="name" class="" id="summary" value="{{$newsModel->getSummary()}}" disabled="disabled"
               width="300"/>
    </div>
    <div class="row">
        <label for="name">Полный текст новости:</label>
        <input type="text" name="name" class="" id="text" value="{{$newsModel->getText()}}" disabled="disabled"
               width="300"/>
    </div>

    <div class="row">
        <label for="name">Дата:</label>
        <input type="text" name="name" class="" id="date" value="{{$newsModel->getDate()}}" disabled="disabled"
               width="300"/>
    </div>
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
                        <div class="form-group">
                            <label for="name">Заголовок</label>
                            <input type="text" name="title" class="form-control" value="{{$newsModel->getTitle()}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Краткое содержание</label>
                            <textarea type="text" name="summary" class="form-control" >{{$newsModel->getSummary()}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">Текст</label>
                            <textarea type="text" name="text" class="form-control" >{{$newsModel->getText()}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">Дата</label>
                            <input type="date" name="date" class="form-control" value="{{$newsModel->getDate()}}">
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



