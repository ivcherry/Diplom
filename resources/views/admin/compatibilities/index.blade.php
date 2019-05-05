@extends('admin.layouts.adminLayout')
@section('content')
    <div class="admin container">

        <div class="model-buttons">
            <button id="add" class="buttons-custom btn btn-default" type="button" data-toggle="modal" data-target="#addModal">Добавить</button>
            <button id="delete" class="buttons-custom btn btn-default">Удалить</button>
        </div>

        <div class="model-processing">
            <div class="current-type-model" id="currentCompatibilityModel">
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
                    Добавление совместимости
                </div>
                <div class="modal-body">
                    <div class="errors alert alert-danger"><ul></ul></div>
                    <form id="addFeatureForm">
                        <div class="row">
                            <div class="form-group">
                                <label for="firstTypesList">Выберите первую подкатегорию</label>
                                <input id="firstTypesList" name="firstTypeId" style="width: 100%;"/>
                            </div>
                            <div class="form-group">
                                <label for="firstFeaturesList">Выберите характеристику первой подкатегории</label>
                                <input id="firstFeaturesList" name="firstFeatureId"  style="width: 100%;"/>
                            </div>
                            <div class="form-group">
                                <label for="secondTypesList">Выберите вторую подкатегорию</label>
                                <input id="secondTypesList" name="secondTypeId"  style="width: 100%;"/>
                            </div>
                            <div class="form-group">
                                <label for="secondFeaturesList">Выберите характеристику второй подкатегории</label>
                                <input id="secondFeaturesList" name="secondFeatureId"  style="width: 100%;"/>
                            </div>
                            <div class="form-group">
                                <label>Укажите правило совместимости</label>
                                <input id="rule" name="rule" type="text" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="saveAdd">Добавить</button>
                                <button type="reset" id="cancelAdd" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/compatibilities/compatibilities.js"></script>
@endsection
