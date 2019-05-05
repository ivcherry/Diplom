<div>
    <input type="hidden" id="productId" value="{{$product->getId()}}"/>
    <div>
        <span><h3>Товар "{{$product->getName()}}"</h3></span>
    </div>
    <div>
        <span>Добавить фотографии</span>
        <form id="productPhotoForm" enctype="multipart/form-data">
            <input id="productId" type="hidden" value="{{$product->getId()}}" name="productId">
            <input id="images" class="form-control" name="images" type="file">
            <button id="addPhotos" class="btn btn-default buttons-custom">Добавить</button>
        </form>
    </div>
    <div class="photos">
        <span><h3>Фотографии</h3></span>
        <div>
            <ul class="list-inline">
        @foreach($product->getPhotos() as $photo)
            <li>
                <div>

                    <img src="/storage{{$photo->getImage()}}" width="100px" height="100px" class="img-thumbnail">
                    <button id="{{$photo->getId()}}" class="buttons-custom btn btn-default deletePhoto">Удалить</button>
                </div>
            </li>
        @endforeach
            </ul>
        </div>
    </div>
</div>
<script>
    $("#images").kendoUpload({
        localization:{
            select:"Выберите фото"
        },
        select: function (e) {
            var extensions = ['.jpg', '.png', '.jpeg'];
            $.each(e.files, function(index, value) {
                if(extensions.indexOf(value.extension) == -1){
                    e.preventDefault();
                    bootbox.alert("Возможно добавление файлов только с раширениями .jpg, .jpeg, .png");
                }
            });
        }});
</script>
