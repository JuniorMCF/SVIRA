<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
use App\Events\ChatEvent;
use App\Mail\NotificationTeleconsulta;
use App\Models\Chat;
use App\Models\Especialidad;
use App\Models\Message;
use App\Models\Teleconsulta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $especialidades = Especialidad::all();

        $especialistas = User::where("role","=","admin")->get();


        $teleconsultas = Teleconsulta::select('users.name as doctorname','teleconsultas.especialidad','teleconsultas.fecha_programada','teleconsultas.link_google','teleconsultas.estado')->join('users','users.id','=','teleconsultas.id_doctor')->where("teleconsultas.id_paciente","=",Auth::user()->id)->get();

        return view('chat',["especialidades"=>$especialidades,"especialistas"=>$especialistas,'teleconsultas'=>$teleconsultas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //emitir un evento
    public function sendMessageChat(Request $request){

        //al momento que un doctor toma un chat, debe de modificar todos los registros
        //de los mensajes anteriores y poner to_user al id del doctor que acepto la solicitud

        
        if($request->to_user=="all"){
            

            //creamos el chat para que algun doctor responda si es que no existe
            $chat_in_table = Chat::where('id_user',$request->from_user)->first();

            if($chat_in_table == null){
                $chat = new Chat();
                $chat->state = "pendiente";
                $chat->id_user = $request->from_user;
                //$chat->id_doctor = $request->to_user;
                $chat->last_message = $request->message;
                $chat->id_channel = $request->from_user.'-to-'.$request->to_user;
                $chat->save();

                //luego guardamos el mensaje
                $message = new Message();
                $message->from_user = intval( $request->from_user);
                
                //$message->to_user = $request->to_user;
                $message->content = $request->message;
                $message->id_chat = $chat->id;
                $message->save();

                //responder con exito a la llamada de axios y redibujar el chat (tener en cuenta el valor de to_user)
                return response()->json(['message'=>'created chat'],200);
            }else{
                $chat_in_table->last_message = $request->message;//para actualizar el evento de chat y notificarlo
                $chat_in_table->id_channel = $request->from_user.'-to-'.$request->to_user;
                $chat_in_table->update();


                 //luego guardamos el mensaje
                 $message = new Message();
                 $message->from_user = $chat_in_table->id_user;
                 
                 //$message->id_user = $chat_in_table->from_user;
                 $message->to_user = $chat_in_table->id_doctor;
                 $message->content = $request->message;
                 $message->id_chat = $chat_in_table->id;
                 $message->save();
                //responder con exito a la llamada de axios y redibujar el chat (tener en cuenta el valor de to_user)
                return response()->json(['message'=>'message updated'],200);
            }
            
           

        }else{

            $message_update = Message::where('id_chat',$request->id_chat)->first();
            if($message_update->to_user == null){
                $modify_message = Message::where('id_chat', $request->id_chat)->update(["to_user" => $request->from_user]);
            }

            $chat_in_table = Chat::find($request->id_chat);
            $chat_in_table->last_message = $request->message;//para actualizar el evento de chat y notificarlo
            $chat_in_table->id_channel = $request->from_user.'-to-'.$request->to_user;
            $chat_in_table->update();

            $message = new Message();
            $message->from_user =  $request->from_user;
            $message->to_user =  $chat_in_table->id_user;
            $message->id_chat =  $request->id_chat;
            $message->content = $request->message;
            $message->save();

            return response()->json(['message'=>'message created'],200);
            //responder con exito a la llamada de axios y redibujar el chat (tener en cuenta el valor de to_user)
        }

        return back();
    }


    public function getChatState($id){
        $chat = Chat::where('id_user',$id)->first();

        if($chat==null){
            //si no hay ningun registro tenemos que mostrar la vista con all
            $messages = Message::where('from_user',$id)->get();

            return response()->json(['messages'=>$messages,'to_user'=>'all'],201);
            
        }else if($chat->to_user==null){
            //existe el chat pero aun no ha sido tomado por un medico
            $messages = Message::select("users.name as to_user","messages.content","messages.from_user","messages.created_at","messages.updated_at")->join('users','users.id','=','messages.from_user')->where('id_chat',$chat->id)->orderBy('messages.created_at','asc')->get();

            return response()->json(['messages'=>$messages,'to_user'=>$chat->to_user],201);

        }else if($chat->to_user!=null){
            //traemos todo el chat con la vista hacia to_user
            $messages = Message::select("users.name as to_user","messages.content","messages.from_user","messages.created_at","messages.updated_at")->join('users','users.id','=','messages.from_user')->where('id_chat',$chat->id)->orderBy('messages.created_at','asc')->get();

            return response()->json(['messages'=>$messages,'to_user'=>$chat->to_user],200);
        }
    }

    public function getChatStateDoctor($id_chat){
        $chat = Chat::where('id',$id_chat)->first();

        $messages = Message::select("users.name as from_user","messages.content","messages.to_user","messages.created_at","messages.updated_at")->join('users','users.id','=','messages.from_user')->where('id_chat',$id_chat)->orderBy('messages.created_at','asc')->get();

        return response()->json(['messages'=>$messages,'to_user'=>$chat->id_user],200);
    }


    public function createTeleconsulta(Request $request){
       
        $google_meets = array("https://meet.google.com/vav-jzcv-ttg","https://meet.google.com/huh-pmzx-tfx");

        $teleconsulta = new Teleconsulta();

        $date = strtotime($request->fec_programada);
    
        $datetime =  date('Y-m-d H:m:s',$date);

        $request->merge([
            'fec_programada' => $datetime,
        ]);


        $teleconsulta->tipo = "teleconsulta";
        //$cita->descripcion = $request->description;
        $teleconsulta->id_doctor = $request->doctor;
        $teleconsulta->id_paciente = Auth::user()->id;
        $teleconsulta->especialidad = $request->especialidad;
        

        $teleconsulta->link_google = $google_meets[array_rand($google_meets)];
        $teleconsulta->estado = "pendiente";

        $teleconsulta->fecha_programada = $request->fec_programada;
        $teleconsulta->save();

        //aqui enviamos una notificacion al correo electronico, del registro de la cita




        Mail::to(Auth::user()->email)->send(new NotificationTeleconsulta($teleconsulta));


        $teleconsultas = Teleconsulta::select('users.name as doctorname','teleconsultas.especialidad','teleconsultas.fecha_programada','teleconsultas.link_google','teleconsultas.estado')->join('users','users.id','=','teleconsultas.id_doctor')->where("teleconsultas.id_paciente","=",Auth::user()->id)->get();

        return response()->json(["citas"=>$teleconsultas],200);
    }
}
