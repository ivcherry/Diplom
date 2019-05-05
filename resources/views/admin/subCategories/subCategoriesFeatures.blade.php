@extends('admin.layouts.adminLayout')

@section('content')
    <div class="admin container">

        <div id="subCategoryFeatures">
        </div>

        <div class="bottom">
            <div id="grid" style="height: 350px;"></div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/subCategories/subCategoriesFeatures.js"></script>
@endsection
