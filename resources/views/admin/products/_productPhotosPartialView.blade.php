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
            <button id="addPhotos" class="btn-modal--success" style="margin-top: 20px; width: 150px">
                <i class="fas fa-plus" style="margin-right: 5px"></i></i>Добавить
            </button>
        </form>
    </div>
    <div class="photos">
        <span><h3>Фотографии</h3></span>
        <div>
            <ul class="list-inline">
                @foreach($product->getPhotos() as $photo)
                    <li>
                        <div style="display: flex; flex-direction: column; align-items: center">
                            <img src="/storage{{$photo->getImage()}}" width="100px" height="100px"
                                 class="img-thumbnail">
                            <button id="{{$photo->getId()}}" class="btn-modal--danger deletePhoto"
                                    style="margin-top: 10px">
                                <i class="fas fa-trash-alt" style="margin-right: 5px"></i>Удалить
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script>
    $("#images").kendoUpload({
        localization: {
            select: "Выберите фото"
        },
        select: function (e) {
            var extensions = ['.jpg', '.png', '.jpeg'];
            $.each(e.files, function (index, value) {
                if (extensions.indexOf(value.extension) == -1) {
                    e.preventDefault();
                    bootbox.alert("Возможно добавление файлов только с раширениями .jpg, .jpeg, .png");
                }
            });
        }
    });
</script>
