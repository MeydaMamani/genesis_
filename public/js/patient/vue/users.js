const appPer = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appPackageKidsPregnant',
    data:{
        errors: [],
        listsKids: [],
        listPregnant: [],
        listPatient: [],
        listPatientDetail: [],
        viewKids: false,
        viewPregnant: false,
        viewPatient: false,
        type: 1
    },
    created: function () {
        this.inputUser();
    },
    methods: {
        inputUser: function(){
            setTimeout(() => { this.$refs.focusMe.focus(); }, 200);
        },

        searchFormUser: function(){
            const formData = $("#formulario").serialize();
            console.log(formData);
            $(".overlay-wrapper").show();
            $(".overlay-wrapper").html('<div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-1 pl-3">Cargando...</div></div>')
            if(this.type == 1){
                axios({
                    method: 'POST',
                    url: 'patient/kids',
                    data: formData,
                })
                .then(response => {
                    if(response.data.length < 1){
                        Swal.fire({
                            icon: 'error',
                            title: 'El usuario no ha sido encontrado...!',
                            text: 'Usuario no registrado en Padrón Nominal y His Minsa.',
                        })

                        this.viewKids = false
                        this.viewPregnant = false
                        this.viewPatient = false
                    }else{
                        this.listsKids = response.data[0];
                        this.viewKids = true
                        this.viewPregnant = false
                        this.viewPatient = false
                    }
                    document.getElementById("formulario").reset();
                    $(".overlay-wrapper").hide();

                }).catch(e => {
                    this.errors.push(e)
                })
            }
            else if(this.type == 2){
                axios({
                    method: 'POST',
                    url: 'patient/pregnant',
                    data: formData,
                })
                .then(response => {
                    if(response.data.length < 1){
                        Swal.fire({
                            icon: 'error',
                            title: 'El usuario no ha sido encontrado...!',
                            text: 'Usuario no registrado en Padrón Nominal y His Minsa.',
                        })

                        this.viewKids = false
                        this.viewPregnant = false
                        this.viewPatient = false

                    }else{
                        this.listPregnant = response.data[0];
                        this.viewPregnant = true
                        this.viewKids = false
                        this.viewPatient = false
                    }
                    document.getElementById("formulario").reset();
                    $(".overlay-wrapper").hide();

                }).catch(e => {
                    this.errors.push(e)
                })
            }
            else if(this.type == 3){
                axios({
                    method: 'POST',
                    url: 'patient/PatientDetails',
                    data: formData,
                })
                .then(response => {
                    if(response.data.length < 1){
                        Swal.fire({
                            icon: 'error',
                            title: 'El usuario no ha sido encontrado...!',
                            text: 'Usuario no registrado en Padrón Nominal y His Minsa.',
                        })

                        this.viewKids = false
                        this.viewPregnant = false
                        this.viewPatient = false

                    }else{
                        this.listPatient = response.data[0];
                        this.listPatient.documento = response.data[0][0].documento;
                        this.listPatient.FechaNacido = response.data[0][0].FechaNacido;
                        this.listPatientDetail = response.data[1];
                        this.viewPregnant = false
                        this.viewKids = false
                        this.viewPatient = true
                    }
                    document.getElementById("formulario").reset();
                    $(".overlay-wrapper").hide();

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },
    }
})