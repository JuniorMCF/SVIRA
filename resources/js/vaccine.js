$(


    $('.datepicker').datepicker({
        format: "dd-mm-yyyy",
        language: "es",
        autoclose: true
    }),

    $(function () {
        const token = document.head.querySelector('meta[name="csrf-token"]');
        
        var table = $('.vaccine-datatable').DataTable({
            responsive:true,
            processing: true,
            serverSide: true,
            bFilter:false,
            paging:false,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            ajax: {
                "_token":token,
                "url":vaccineurl,
                "type": "GET"
            },
            columns: [
                //{ data: 'id' },
                { data: 'nombre_paciente' },
                { data: 'vacuna' },
                { data: 'tipo_inmun' },
                { data: 'dosis' },
                { data: 'dosis_totales' },
                { data: 'hospital' },
                { data: 'fec_inmun' }
            ],
        });
        
    }),


)