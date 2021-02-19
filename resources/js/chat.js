
Echo.channel('channel-chat')
    .listen('ChatCreated',(e)=>{ 
        //console.log(e)
        getChatState(id_user,username);
    });


Echo.channel('channel-chat')
.listen('ChatUpdated',(e)=>{ 
    //console.log(e)
    getChatState(id_user,username);
});

$(
    
    //console.log(id_user),
    getChatState(id_user,username),
    
    $("#send-message").on('click',function(e){
        const token = document.head.querySelector('meta[name="csrf-token"]');
        const from_user = $('#from_user').val()
        const to_user = $("#to_user").val()
        const message = $("#message").val()


        //console.log(from_user+to_user+message);

        const data = new FormData()
        data.append('from_user',from_user)
        data.append('to_user',to_user)
        data.append('message',message)

        axios.post('/send-message-chat',data,{
            headers: {
                _token:token
            }
        }).then(response =>{
            $('#message').value = ''
        }).catch(error =>{
            console.log(error.response.data)
        })
            
    }),


    $("#accept-pago").on('click',function (e){

        const token = document.head.querySelector('meta[name="csrf-token"]');

        const especialidad = $("#especialidad-form").val()
        const doctor = $("#doctor-form").val()
        //const description = $('textarea#comment').val()


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



        const data = new FormData()
        data.append('token',token)
        data.append('especialidad',especialidad)
        data.append('doctor',doctor)
        //data.append('description',description)
        data.append('fec_programada',fec_programada)

        axios.post("/create-teleconsulta",data)
        .then(response=>{
            console.log(response)
            if(response.status == 200){
                $("#modalForm").modal('toggle')
                $("#message-alert").html("Cita reservada correctamente")
                $("#container-alert-message").removeClass("d-none")
                
                actualizarTabla(response.data.citas)
            }
        }).catch(error =>{
            console.log(error.response)
        })
    })
)

function getChatState(id,from_user){
    var ul = $('#chat-content')
    ul.scrollTop(ul.prop('scrollHeight'));

    const token = document.head.querySelector('meta[name="csrf-token"]');


    axios.get('/chat-state/'+id,{
        headers: {
            _token:token
        }
    }).then(response =>{
        if(response.status == 200){ //to-user
            drawChatToUser(response.data.messages,id_user,from_user)
        }else if(response.status == 201){// all
            drawChatToAll(response.data.messages,id_user,from_user)
        }
    }).catch(error =>{
        console.log(error.response.data)
    })
}


function drawChatToUser(messages,id_user,from_user){
    console.log(messages)
}
function drawChatToAll(messages,id_user,from_user){
    console.log(messages)
    
    var chat = ''

    for(i in messages){
        if(messages[i].from_user == id_user){//derecha
            chat += chatLeft(messages[i].content,from_user)
        }else{//izquierda
            chat += chatRight(messages[i].content,messages[i].to_user)
        }
    }

   
    $('#chat-content').html(chat)
    var ul = $('#chat-content')
    ul.scrollTop(ul.prop('scrollHeight'));
}


function chatLeft(message,from_user){
    var htmlChatLeft = ""
    htmlChatLeft += '<li class="card rounded"><div class="d-flex"><div class="image-chat">'
    htmlChatLeft += '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle img-fluid" viewBox="0 0 16 16">'
    htmlChatLeft += '<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>'
    htmlChatLeft += '<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>'
    htmlChatLeft += '</svg>'
    htmlChatLeft += '</div>'
    htmlChatLeft += '<div class="comment-chat">'
    htmlChatLeft += '<strong>'+from_user+'</strong><br>'
    htmlChatLeft += '<span>'+message+'</span>'
    htmlChatLeft += '</div></li>'

    return htmlChatLeft
}
function chatRight(message,from_user){
    var htmlChatRight = ""
    htmlChatRight += '<li class="card rounded"><div class="d-flex">'
    htmlChatRight += '<div class="comment-chat-right">'
    htmlChatRight += '<strong>'+from_user+'</strong><br>'
    htmlChatRight += '<span>'+message+'</span></div>'
    htmlChatRight += '<div class="image-chat-right"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle img-fluid" viewBox="0 0 16 16">'
    htmlChatRight += '<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>'
    htmlChatRight += '<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>'
    htmlChatRight += '</svg></div>'
    htmlChatRight += '</div></li>'

    return htmlChatRight
}

function parametersChat(){
    /*<input type="text" name="from_user" id="from_user" value="{{Auth::user()->id}}" disabled class="d-none">
    <input type="text" name="to_user" id="to_user" value="all" disabled class="d-none">
    <input  type="text" name="message"  id="message" class="form-control"></input>*/
}

function actualizarTabla(citas){

    html = ""
    for(i in citas){

        html += '<tr>'
        html += '<td>Teleconsulta</td>'
        html += '<td>'+citas[i].doctorname+'</td>'
        html += '<td>'+citas[i].especialidad+'</td>'
        html += '<td>'+citas[i].fecha_programada+'</td>'
        html += '<td>Google Meets</td>'
        html += '<td>'+citas[i].link_google+'</td>'
        html += '</tr>'
    }
    //console.log(html)
    $("#table-citas").empty();
    $("#table-citas").append(html)
}

