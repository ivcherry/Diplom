@extends('admin.layouts.adminLayout')

@section('content')
    <div class="admin container">
        <div>
            <div class="current-type-model" id="currentProductFeaturesModel">
            </div>
        </div>

        <div class="bottom">
            <div id="grid" style="height: 250px;"></div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/admin/admin.common-settings.js"></script>
    <script src="/js/admin/products/productFeatures.js"></script>
@endsection
