$(

    $("#accept-pago").on('click',function (e){

        const token = document.head.querySelector('meta[name="csrf-token"]');

        const hospital = $("#hospital-form").val()
        const especialidad = $("#especialidad-form").val()
        const doctor = $("#doctor-form").val()
        //const description = $('textarea#comment').val()

        const vacuna =  $("#vacuna-form").val()
        const farmaceutica = $("#farmaceutica-form").val()

        var fec_programada = ''

        if( $("#fec_programada-1").is(":checked")){
            fec_programada = $("#fec_programada-1").val()
        }
        if( $("#fec_programada-2").is(":checked")){
            fec_programada = $("#fec_programada-2").val()
        }
        if( $("#fec_programada-3").is(":checked")){
            fec_programada = $("#fec_programada-3").val()
        }
        if( $("#fec_programada-4").is(":checked")){
            fec_programada = $("#fec_programada-4").val()
        }


        //console.log("xdxd: ",hospital)

        const data = new FormData()
        data.append('token',token)
        data.append('hospital',hospital)
        data.append('especialidad',especialidad)
        data.append('doctor',doctor)
        //data.append('description',description)
        data.append('vacuna',vacuna)
        data.append('farmaceutica',farmaceutica)
        data.append('fec_programada',fec_programada)

        axios.post("/medicalappointment-save-cita",data)
        .then(response=>{
            if(response.status == 200){
                $("#modalForm").modal('toggle')
                $("#message-alert").html("Cita reservada correctamente")
                $("#container-alert-message").removeClass("d-none")
                
                actualizarTabla(response.data.citas)
            }else if(response.status == 201){
                $("#modalForm").modal('toggle')
                alert("No puede solicitar una cita para la misma vacuna");

            }
        }).catch(error =>{
            console.log(error.response)
        })
    })
)

function actualizarTabla(citas){
    
    html = ""
    for(i in citas){

        html += '<tr>'
        html += '<td>'+citas[i].vacuna+'</td>'
        html += '<td>'+citas[i].farmaceutica+'</td>'
        html += '<td>'+citas[i].dosis_actual+'</td>'
        html += '<td>'+citas[i].dosis_proxima+'</td>'
        html += '<td>'+citas[i].doctorname+'</td>'
        html += '<td>'+citas[i].fecha_ultima_dosis+'</td>'
        html += '<td>'+citas[i].fecha_programada+'</td>'
        html += '<td>'+citas[i].hospital+'</td>'
        html += '<td>'+citas[i].piso+'</td>'
        html += '<td>'+citas[i].consultorio+'</td>'
        html += '<td>'+citas[i].estado+'</td>'
        html += '</tr>'
    }
    //console.log(html)

    $("#table-citas").empty();
    $("#table-citas").append(html)
}