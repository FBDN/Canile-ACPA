$(function () {
    "use strict";
    let dropbox;
    let preview;
    let previewContainer;
    let fileSelect;
    let fileElem;
    let formSerializer;
    let dt;
    let files;
    fileSelect = document.getElementById('labelInput');
    fileElem = document.getElementById('fileElem');
    fileElem.addEventListener("change", previewImages, false);
    fileSelect.addEventListener("click", selectFiles, false);
    preview = document.getElementById("gallery");
    $('.loader').hide();
    function selectFiles(e) {
        if (fileElem) {
    fileElem.click();
        }
        e.preventDefault();
    }
    
        // Multiple images preview in browser
    function previewImages() {

        var preview = document.querySelector('#preview');

        if (this.files) {
            [].forEach.call(this.files, readAndPreview);
        }

        function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " non è un'Immagine");
            } // else...

            var reader = new FileReader();

            reader.addEventListener("load", function () {
                var image = new Image();
                image.title = file.name;
                image.src = this.result;
                image.width = 80;
                preview.appendChild(image);
               image.classList.add('img-thumbnail');
            });

            reader.readAsDataURL(file);

        }

    }

    $('.reset').on('click', function (e) {
        e.preventDefault();
        location.reload()
    })
    $('#salva').on('click', function (e) {
        e.preventDefault();
        var data = new FormData($('#aggiungifoto')[0]);
        for (var value of data.values()) {
            console.log(value);
        }
        $('.alert').removeClass('alert-danger');
        $('.alert').removeClass('alert-success');
        $.ajax({
            type: 'post',
            url: 'postFoto.php',
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.loader').show();
            },
            complete: function () {
                $('.loader').hide();
            },
            success: function (data) {
                if (data.success == false) {
                    $('.alert').addClass('alert-danger').html('<h3>' + data.msg + '</h3>');
                } else {
                    $('.alert').addClass('alert-success').html('<h3>' + data.msg + '</h3>');
                }
            }
        });
    });
    

})