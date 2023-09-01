import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzones', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPUblicada = {}
            imagenPUblicada.size = 1234;
            imagenPUblicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPUblicada);
            this.options.thumbnail.call(this, imagenPUblicada, `/uploads/${imagenPUblicada.name}`);
        
            imagenPUblicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('success', function (file, response) {
    console.log(response.Imagen);
    document.querySelector('[name="imagen"]').value = response.Imagen;
})
dropzone.on("removedfile",function(){
    document.querySelector('[name="imagen"]').value = "";
})
/*dropzone.on('sending', function (file, xhr, formData) {
    console.log(file);
})*/

/*dropzone.on('error', function (file, response) {
    console.log(response);
})*/