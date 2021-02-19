$(
    $('.datepicker').datepicker({
        format: "dd-mm-yyyy 00:00:00",
        language: "es",
        autoclose: true
    }),
    
    $("#btn-actualizar").on('click',function (e){
        const id = e.target.name
        
        const token = document.head.querySelector('meta[name="csrf-token"]');

        axios.get('/cita-detalle/'+id,{
            headers: {
                _token:token
            }
        }).then(res => {
            if(res.status == 200){
                
                console.log(res.data.cita)

                //llenamos el modal con los valores 
                $("#id").val(res.data.cita.id)
                $("#paciente").val(res.data.cita.doctorname)
                $("#farmaceutica").val(res.data.cita.farmaceutica)
                $("#vacuna").val(res.data.cita.vacuna)
                $("#dosis_actual").val(res.data.cita.dosis_proxima)
                $("#dosis_programada").val(parseInt(res.data.cita.dosis_proxima) + 1)
                $("#modalForm").modal({
                    show: true
                }); 
            }
        }).catch(err => {


        })
        
    }),

        $("#btn-terminar").on('click',function (e){
            const id = e.target.name
            
            const token = document.head.querySelector('meta[name="csrf-token"]');
            


            const data = new FormData();
            data.append('token',token)
            data.append('id',id)

            console.log(id)

            axios.post('/cita-terminar',data).then(res => {
                console.log(res)
                if(res.status == 200){
                    
                    $("#message-alert").html("Inmunización concluida")
                    $("#container-alert-message").removeClass("d-none")
                    
                    actualizarTabla(res.data.citas)
                }
            }).catch(err => {
    
                console.log(err.response)
            })


       
    

        
    })
)

function actualizarTabla(citas){
    
    html = ""
    for(i in citas){

        html += '<tr>'
        html += '<td>'+citas[i].doctorname+'</td>'
        html += '<td>'+citas[i].vacuna+'</td>'
        html += '<td>'+citas[i].farmaceutica+'</td>'
        html += '<td>'+citas[i].dosis_actual+'</td>'
        html += '<td>'+citas[i].dosis_proxima+'</td>'
        html += '<td>'+citas[i].dni+'</td>'
        if(citas[i].fecha_ultima_dosis == null){
            html += '<td></td>'
        }else{
            html += '<td>'+citas[i].fecha_ultima_dosis+'</td>'
        }
        html += '<td>'+citas[i].fecha_programada+'</td>'
        html += '<td>'+citas[i].hospital+'</td>'
        html += '<td>'+citas[i].piso+'</td>'
        html += '<td>'+citas[i].consultorio+'</td>'
        html += '<td class="d-flex"><a class="btn btn-success mx-1" id="btn-actualizar" name="'+citas[i].id+'">actualizar</a>'
        html += '<a class="btn btn-danger mx-1" id="btn-terminar" name="'+citas[i].id+'">terminar</a></td>'
        html += '</tr>'
    }
    //console.log(html)
    $("#table-citas").empty();
    $("#table-citas").append(html)
}