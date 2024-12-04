deletedImagesNames = [];
var myDropzone = new Dropzone("#dropzone_input", {
    url: "/vendor/dropzone/validate-image", // Set the url for your upload script location
    method: "post",
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 5,
    maxFilesize: 0.5, // MB
    addRemoveLinks: true,
    dictFileTooBig: "الملف كبير جدًا ({{filesize}}ميغا بايت). الحد الأقصى لحجم الملف: {{maxFilesize}} ميغا بايت.",
    dictMaxFilesExceeded: __('You cannot download more than ') + '{{maxFiles}}' +  __(' from files.'),
    dictFallbackMessage:  "متصفحك لا يدعم تحميلات السحب والإفلات.",
    dictInvalidFileType:  "لا يمكنك تحميل ملفات من هذا النوع.",
    dictResponseError:  "استجاب الخادم برمز {{statusCode}}.",
    accept: function(file, done) {
        if (file.name == "wow.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    init:function() {
        // Get images
        if(window.setDropzoneImages)
            setDropzoneImages(this);

    },
    success: function(file, response)
    {
        $("#images_input").prop("files", new FileListItems(myDropzone.files));
    },

    error: function(file, response)
    {
        if($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        file.previewElement.style.border = '1px solid #ff000059';
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    removedfile: function(file){
        $("#images_input").prop("files", new FileListItems(myDropzone.files));
        file.previewElement.remove();

        if(!(file instanceof File)){
            deletedImagesNames.push(file.name);
            $(`[name='deleted_images']`).val(JSON.stringify(deletedImagesNames));
        }
    },
});

/**
 * @params {File[]} files Array of files to add to the FileList
 * @return {FileList}
 */
function FileListItems (files) {
    var b = new ClipboardEvent("").clipboardData || new DataTransfer()
    for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i])
    return b.files
}



