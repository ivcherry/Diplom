@extends('admin.layouts.adminLayout')

@section('content')
    <div class="admin container">
        <div class="model-buttons">
            <button id="delete" class="buttons-custom btn btn-default">
                <i class="fas fa-trash-alt" style="margin-right: 5px"></i>Удалить
            </button>
            <button id="edit" class="buttons-custom btn btn-default" type="button" data-toggle="modal"
                    data-target="#editModal">
                <i class="fas fa-id-card" style="margin-right: 5px"></i>Роли
            </button>

        </div>
        <div class="model-processing">
            <div class="current-type-model" id="currentUserModel">
            </div>
        </div>

        <div class="bottom">
            <div id="grid" style="height: 350px;"></div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/user/user.js"></script>
@endsection
