@extends("layouts.backend")

@section("pageTitle")
    Kategori Oluştur
@endsection

@section("pageHeaderBreadCrumbs")
    <li><a href="{{route("backend.category.index")}}"><span>Kategoriler</span></a></li>
    <li><span>Kategori Oluştur</span></li>
@endsection

@section("content")
    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Ekleme Formu</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="post" id="form" enctype="multipart/form-data">

                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#info" data-toggle="tab">Kategori Bilgileri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#detail" data-toggle="tab">Kategori Detay</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="info" class="tab-pane active">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="title">Başlık <span class="required">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Kategori Başlığı" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="status">Durum</label>
                                        <div class="col-lg-6">
                                            <div class="switch switch-sm switch-success">
                                                <input type="checkbox" name="status" data-plugin-ios-switch
                                                       checked="checked"/>
                                            </div>
                                        </div>
                                    </div>

                                    {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="sort">Sıra
                                            No</label>
                                        <div class="col-lg-6">
                                            <input type="number" value="0" class="form-control" id="sort" name="sort">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="parent">Üst
                                            Kategori</label>
                                        <div class="col-lg-6">
                                            <select data-plugin-selectTwo class="form-control populate" name="parent">
                                                <option value="">Ana kategori</option>

                                                @foreach($categories as $category)

                                                    <optgroup label="{{$category->title}}">
                                                        <option value="{{$category->id}}">
                                                            — {{$category->title}}</option>
                                                        @foreach($category->subcategories as $subcategory)
                                                            <option value="{{$subcategory->id}}">
                                                                —— {{$subcategory->title}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="image">Kategori
                                            Resmi</label>
                                        <div class="col-lg-6">
                                            <input type="file" name="image" id="image"
                                                   class="form-control form-control-file">

                                            <img src="{{asset('placeholder.png')}}" id="imagePreview" alt=""
                                                 style="max-width: 250px; width: 100%" class="mt-3 shadow-lg">
                                        </div>
                                    </div>
                                </div>
                                <div id="seo" class="tab-pane">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="seo_keywords">Anahtar
                                            Kelimeler</label>
                                        <div class="col-lg-6">
                                            <input type="text" data-role="tagsinput"
                                                   data-tag-class="badge badge-primary" class="form-control"
                                                   id="seo_keywords" placeholder="Virgül ile ayırınız"
                                                   name="seo_keywords">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="seo_description">Açıklama</label>
                                        <div class="col-lg-6">
                                            <textarea rows="2" class="form-control" id="seo_description"
                                                      name="seo_description"
                                                      placeholder="Kategori SEO Açıklaması, Google tarafından gösterilir"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="seo_title">SEO
                                            Başlık</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="seo_title" name="seo_title"
                                                   placeholder="Sekme başlığında gözükecek başlık, boş ise kategori ismi otomatik eklenecektir">
                                        </div>
                                    </div>

                                </div>
                                <div id="detail" class="tab-pane">


                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <textarea rows="15" class="form-control" id="details"
                                                      name="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="mb-1 mt-1 mr-1 btn btn-success float-right" id="save">
                                    Kategoriyi Ekle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
@endsection


@push("customVendorJs")
    <script src="{{asset("assets/backend/vendor/autosize/autosize.js")}}"></script>
    <script src="{{asset("assets/backend/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js")}}"></script>

    <script src="{{asset("assets/backend/")}}/vendor/jquery-ui/jquery-ui.js"></script>
    <script src="{{asset("assets/backend/")}}/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
    <script src="{{asset("assets/backend/")}}/vendor/select2/js/select2.js"></script>

    <script src="{{asset("assets/backend/")}}/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <script src="{{asset("assets/backend/")}}/vendor/ios7-switch/ios7-switch.js"></script>
@endpush
@push("customJs")
    <script>

        $("#form").submit(function (e) {
            e.preventDefault();
            var button = $(this);

            var form = new FormData($("#form")[0]);
            form.append('enctype', 'multipart/form-data');

            swal({
                title: 'İşlem gerçekleştiriliyor...',
                html:
                    '<i class="fas fa-circle-notch fa-spin fa-3x fa-fw"></i>' +
                    ' <span class="sr-only">Loading...</span>',

                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            $.ajax({
                type: "post",
                url: "{{route("backend.category.createpost")}}",
                data: form,
                contentType: false,
                processData: false,

                success: function (response, textStatus, xhr) {
                    if (textStatus == "success") {

                        swal.close();

                        swal({
                            type: textStatus,
                            title: response.title,
                            text: response.message,
                        }).then(() => {
                            location.href = "{{route("backend.category.index")}}";
                        });
                    }
                },

                error: function (response) {
                    swal.close();

                    var output = "";
                    for (property in response.responseJSON.errors) {
                        output += response.responseJSON.errors[property] + ' <br>';
                    }

                    swal({
                        type: "error",
                        title: "Hata oluştu!",
                        html: "<span style='color:#f27474'>" + output + "</span><br>Lütfen formu kontrol edin!"
                    });
                }
            });
        });

        $("#image").on("change", function () {
            var input = this;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagePreview").attr("src", e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

    </script>

@endpush
@push("customCss")
    <link rel="stylesheet" href="{{asset("assets/backend/")}}/vendor/jquery-ui/jquery-ui.css"/>
    <link rel="stylesheet" href="{{asset("assets/backend/")}}/vendor/jquery-ui/jquery-ui.theme.css"/>
    <link rel="stylesheet" href="{{asset("assets/backend/")}}/vendor/select2/css/select2.css"/>
    <link rel="stylesheet"
          href="{{asset("assets/backend/")}}/vendor/select2-bootstrap-theme/select2-bootstrap.min.css"/>
    <link rel="stylesheet" href="{{asset("assets/backend/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css")}}"/>

    <link rel="stylesheet" href="{{asset("assets/backend/")}}/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css"/>
@endpush