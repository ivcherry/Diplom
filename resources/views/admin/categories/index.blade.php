@extends('admin.layouts.adminLayout')

@section('content')
    <div class="admin container">
        <div class="model-buttons">
            <button id="add" class="main-buttons" type="button" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus" style="margin-right: 5px"></i>Добавить
            </button>
            <button id="delete" class="main-buttons">
                <i class="fas fa-trash-alt" style="margin-right: 5px"></i>Удалить
            </button>
            <button id="edit" class="main-buttons" type="button" data-toggle="modal" data-target="#editModal">
                <i class="fas fa-edit" style="margin-right: 5px"></i>Изменить
            </button>
        </div>

        <div class="model-processing">
            <div class="current-type-model" id="currentCategoryModel">
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
                    Добавление новой категории
                </div>
                <div class="modal-body">
                    <div class="errors alert alert-danger">
                        <ul></ul>
                    </div>
                    <form id="addCategoryForm">
                        <div class="row form-inline">
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-modal--success" id="saveAdd">Добавить</button>
                            <button type="reset" id="cancelAdd" class="btn-modal--danger" data-dismiss="modal">Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/categories/categories.js"></script>
@endsection
