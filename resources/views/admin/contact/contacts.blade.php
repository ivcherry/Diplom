@extends('admin.layouts.adminLayout')

@section('content')
   <div class="admin">
       <button id="saveContacts" class="btn btn-default buttons-custom text-center">Сохранить</button>
       <div style="margin: 20px;">
           <textarea class="tinymce" id="contactsContent" style="margin-top:20px;">{{$content}}</textarea>
       </div>
   </div>
    <div id="result"></div>
@endsection

@section('scripts')
<script src="/js/admin/admin.common-settings.js"></script>
<script src="/js/tinymce/tinymce.min.js"></script>
<script src="/js/admin/init-tinymce.js"></script>
<script src="/js/admin/contact/contacts.js"></script>
@endsection
