const appPer = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appEmail',
    data:{
        errors: [],
    },
    created: function () {
        // this.inputUser();
    },
    methods: {
        searchForm: function(){
            console.log('Estas aqui');
            // const formData = $("#formulario").serialize();
            // console.log(formData);
            // $(".overlay-wrapper").show();
            // $(".overlay-wrapper").html('<div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-1 pl-3">Cargando...</div></div>')
            axios({
                method: 'GET',
                url: 'send/enviar',
                data: '',
            })
            .then(response => {
                Swal.fire({
                    title: 'Esta Seguro de Enviar?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success')
                    }
                    else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

                // $(".overlay-wrapper").hide();

            }).catch(e => {
                this.errors.push(e)
            })
        },
    }
})