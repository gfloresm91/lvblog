<?php

namespace lvblog\Http\Controllers;

use Illuminate\Http\Request;

use lvblog\Models\User;
use lvblog\Models\Conversation;
use lvblog\Models\PrivateMessage;
use lvblog\Notifications\UserFollower;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function Index($username)
    {
        $user = User::where('username', $username)->first();
        $noticias = $user->noticias()->with('user')->paginate(10);
        $isFollowing = auth()->user()->isFollowing($user);



        return view('user.index', [
            'user' => $user,
            'noticias' => $noticias,
            'isFollowing' => $isFollowing,
        ]);
    }

    public function FollowPost($username, Request $request)
    {
        $user = User::where('username', $username)->first();

        $yo = $request->user();

        $yo->follows()->attach($user);

        $user->notify(new UserFollower($yo));

        return redirect()->route('user.index', [
            'username' => $username,
        ]);
    }

    public function UnFollowPost($username, Request $request)
    {
        $user = User::where('username', $username)->first();

        $yo = $request->user();

        $yo->follows()->detach($user);

        return redirect()->route('user.index', [
            'username' => $username,
        ]);
    }

    public function EnviarMensajePrivado($username, Request $request)
    {
        $user = User::where('username', $username)->first();
        $yo = $request->user();
        $mensaje = $request->input('message');

        $conversacion = Conversation::between($yo, $user);

        $mensajePrivado = PrivateMessage::create(
            [
                'conversation_id' => $conversacion->id,
                'user_id' => $yo->id,
                'message' => $mensaje,
            ]);

        return redirect()->route('user.conversacion', [
            'conversacion' => $conversacion->id,
        ]);
    }

    public function MostrarConversacion(Conversation $conversacion)
    {
        $conversacion->load('users', 'privateMessages');

        return view('user.conversacion', [
            'conversacion' => $conversacion,
            'user' => auth()->user(),
        ]);
    }
}
