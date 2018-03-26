<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\MessageWasReceived;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $messages = DB::table('messages')->get();
        $messages = Message::with(['user', 'note', 'tags'])->orderBy('created_at', request('sorted', 'DESC'))->paginate(10);

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        //Guardamos en mensaje
        /*  DB::table('messages')->insert([
             'nombre' => $request->nombre,
             'email' => $request->email,
             'mensaje' => $request->mensaje,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
         ]); */
        $message = Message::create($request->all());

        if (auth()->check()) {
            auth()->user()->messages()->save($message);
        }

        /** Se genera el evento */
        event(new MessageWasReceived($message));

        /** Esta se utiliza cuando sabemos que siempre tenemos un usuario autenticado
         * auth()->user()->messages()->create($request->all());
         */

        //redireccionamos

        return redirect()->route('mensajes.create')->with('info', 'Hemos Recibido tu Mensaje');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$message = DB::table('messages')->where('id', $id)->first();
        $message = Message::findOrFail($id);

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.edit', compact('message'));
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
        $message = Message::findOrFail($id);
        //Actualizamos
        $message->update($request->all());
        //Redireccionamos
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        //Eliminamos
        $message->delete($id);
        //Redireccionamos
        return redirect()->route('mensajes.index');
    }
}
