@extends('admin.layouts.adminLayout')

@section('content')
    <div class="admin container">
        {{--<div class="model-buttons">--}}
               {{--<button id="add" class="buttons-custom btn btn-default" type="button" data-toggle="modal" data-target="#addModal">Добавить</button>--}}
               {{--<button id="delete" class="buttons-custom btn btn-default">Удалить</button>--}}
               {{--<button id="edit" class="buttons-custom btn btn-default" type="button" data-toggle="modal" data-target="#editModal">Изменить</button>--}}
        {{--</div>--}}
        <div class="model-processing">
            <div class="current-type-model" id="currentOrderModel">
            </div>

        </div>

        <div class="bottom">
            <div id="grid" style="height: 350px;"></div>
        </div>

    </div>

    {{--<div class="modal fade" id="addModal" role="dialog">--}}
        {{--<div class="modal-dialog">--}}

            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--Добавление ацкции--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="errors alert alert-danger">--}}
                        {{--<ul></ul>--}}
                    {{--</div>--}}
                    {{--<form id="addOrderForm">--}}
                        {{--<div class="row">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="name">Заголовок</label>--}}
                                {{--<input type="text" name="title" class="form-control">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="name">Краткое содержание</label>--}}
                                {{--<textarea type="text" name="summary" class="form-control" ></textarea>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="name">Текст</label>--}}
                                {{--<textarea type="text" name="text" class="form-control" ></textarea>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="name">Дата</label>--}}
                                {{--<input type="date" name="date" class="form-control">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-default" id="saveAdd">Добавить</button>--}}
                            {{--<button type="reset" id="cancelAdd" class="btn btn-default" data-dismiss="modal">Отмена</button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/orders/orders.js"></script>
@endsection
