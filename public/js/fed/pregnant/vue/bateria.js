Vue.directive('select2', {
    inserted(el) {
        $(el).on('select2:select', () => {
            const event = new Event('change', { bubbles: true, cancelable: true });
            el.dispatchEvent(event);
        });

        $(el).on('select2:unselect', () => {
            const event = new Event('change', {bubbles: true, cancelable: true})
            el.dispatchEvent(event)
        })
    },
});

const appFed = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appBateria',
    data: {
        errors: [],
        lists: [],
        listsResum: [],
        total: 0,
        cumple: 0,
        no_cumple: 0,
        avance: 0,
        advanceReg: [],
        provinces: [],
        districts: {},
        date_his: '',
        red: '',
        distrito: '',
        anio: '',
        mes: '',
        nameMonth: '',
        nameYear: '',
    },
    created: function() {
        this.filtersProv();
        this.listYears();
        this.bateriaActually();
    },
    methods: {
        filtersProv: function() {
            axios.post('provinces')
            .then(respuesta => {
                this.provinces = respuesta.data;
                setTimeout(() => $('.show-tick').selectpicker('refresh'));

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersDistricts() {
            this.districts = [];
            axios({
                method: 'POST',
                url: 'districts',
                data: { "id": this.red },
            })
            .then(respuesta => {
                this.districts = respuesta.data;
                setTimeout(() => $('.show-tick').selectpicker('refresh'));

            }).catch(e => {
                this.errors.push(e)
            })
        },

        listYears: function(){
            const getDate = new Date();
            var n = getDate.getFullYear();
            var select = document.getElementById("anio");
            for(var i = 2021; i<=n; i++)select.options.add(new Option(i,i));

            this.date_his = getDate.toISOString().split('T')[0];
            setTimeout(() => $('.show-tick').selectpicker('refresh'));
        },

        // para carga de datos del mes actual
        bateriaActually: function(){
            const getDate = new Date();
            const currentData = { "red": "TODOS", "distrito": "TODOS", "anio": getDate.getFullYear(), "mes": getDate.getMonth()+1 }
            this.listBateria(currentData);
        },

        // para carga de datos según mes de busqueda
        searchBateria: function(){
            if (this.red == '') { toastr.error('Seleccione una Red', null, { "closeButton": true, "progressBar": true }); }
            else if (this.distrito == '') { toastr.error('Seleccione un Distrito', null, { "closeButton": true, "progressBar": true }); }
            else if (this.anio == '') { toastr.error('Seleccione un Año', null, { "closeButton": true, "progressBar": true }); }
            else if (this.mes == '') { toastr.error('Seleccione un Mes', null, { "closeButton": true, "progressBar": true }); }
            else {
                const formData = $("#formulario").serialize();
                this.listBateria(formData);
            }
        },

        listBateria: function(data) {
            $(".nominalTable").removeAttr("id");
            $(".nominalTable").attr("id","bateria_completa");
            $(".overlay-wrapper").show();
            $(".overlay-wrapper").html('<div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-1 pl-3">Cargando...</div></div>');
            const getDate = new Date();
            axios({
                method: 'POST',
                url: 'bateria/list',
                data: data,
            })
            .then(response => {
                this.cumple=0; this.no_cumple=0; this.total=0;
                this.lists = response.data[0];
                this.listsResum = response.data[1];
                this.advanceReg = response.data[2];
                for (let i = 0; i < this.lists.length; i++) {
                    this.total++;
                    this.lists[i].MIDE == 'SI' ? this.cumple++ : this.no_cumple++;
                }

                for (let j = 0; j < this.listsResum.length; j++) {
                    var avance = (this.listsResum[j].NUMERADOR/this.listsResum[j].DENOMINADOR)*100;
                    avance % 1 != 0 ? this.listsResum[j].AVANCE = avance.toFixed(1) : this.listsResum[j].AVANCE = avance;
                }

                for (let k = 0; k < this.advanceReg.length; k++) {
                    var a = (this.advanceReg[k].NUM/this.advanceReg[k].DEN)*100;
                    a % 1 != 0 ? this.advanceReg[k].ADVANCE = a.toFixed(1) : this.advanceReg[k].ADVANCE = a;
                }

                this.anio == '' ? this.nameYear = getDate.getFullYear() : this.nameYear = this.anio;
                this.mes == '' ? mes2 = getDate.getMonth() + 1 : mes2 = this.mes;
                this.nameMonth = new Intl.DateTimeFormat('es-ES', { month: 'long'}).format( getDate.setMonth(mes2 - 1));
                this.nameMonth = this.nameMonth.charAt(0).toUpperCase() + this.nameMonth.slice(1);

                this.avance = ((this.cumple / this.total) * 100).toFixed(1);
                $('.knob').val(this.avance + '%').trigger('change');
                $('.footable-page a').filter('[data-page="0"]').trigger('click');
                $(".overlay-wrapper").hide();

            }).catch(e => {
                this.errors.push(e)
            })
        },

        listNoCumplen() {
            $(".nominalTable").removeAttr("id");
            $(".nominalTable").attr("id","no_cumplen");
            this.listCumplen = [];
            for (let i = 0; i < this.lists.length; i++) {
                if(this.lists[i].MIDE == 'NO'){
                    this.listCumplen.push(this.lists[i]);
                }
            }

            this.lists = this.listCumplen;
            $('#demo-foo-addrow2').footable();
            $('#demo-foo-addrow2').data('footable').redraw();
            $('#demo-foo-filtering').data('footable').redraw();
            $('#demo-foo-filtering').footable();
            $('#demo-foo-addrow2').footable();
            $('.table').footable();
        },

        PrintNominal: function(){
            var red = $('#red').val();
            var dist = $('#distrito').val();
            var anio = $('#anio').val();
            var mes = $('#mes').val();

            const getDate = new Date();
            red == '' ? red = "TODOS" : red; dist == '' ? dist = "TODOS" : dist;
            anio == '' ? anio = getDate.getFullYear() : anio;     mes == '' ? mes = getDate.getMonth()+1 : mes;

            url_ = window.location.origin + window.location.pathname + '/print?r=' + (red) + '&d=' + (dist) + '&a=' + (anio) + '&m=' + (mes);
            window.open(url_,'_blank');
        },
    }
})