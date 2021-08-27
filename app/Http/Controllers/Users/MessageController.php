<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Contact;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->rcv == "") {

            if (isset($_COOKIE['gerant_id'])) {
                $contacts = Contact::where('user_id', 0)->orWhere('contact_id', 0)->get();
            } else {
                $contacts = Contact::where('user_id', $_COOKIE['id'])->orWhere('contact_id', $_COOKIE['id'])->orderByDesc('id')->get();
            }

            return view('users.messages.list', [
                'rcv' => $request->rcv,
                'contacts' => $contacts
            ]);
        } else {

            $users = User::where('id', $request->rcv)->get();

            if (isset($_COOKIE['gerant_id'])) {
                $contacts = Contact::where('user_id', 0)->orWhere('contact_id', 0)->get();
            } else {
                $contacts = Contact::where('user_id', $_COOKIE['id'])->orWhere('contact_id', $_COOKIE['id'])->orderByDesc('id')->get();
            }


            return view('users.messages.list', [
                'rcv' => $request->rcv,
                'users' => $users,
                'contacts' => $contacts
            ]);
        }
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
        $message = new Message;

        if (isset($_COOKIE['gerant_id'])) {
            $message->env_id = 0;

            $contacts = \DB::select("SELECT * FROM contacts WHERE (user_id = ? AND contact_id = ?) OR (user_id = ? AND contact_id = ?)", [
                0, $request->rcv, $request->rcv, 0
            ]);

            if (count($contacts) == 0) {
                \DB::insert("INSERT INTO contacts (user_id, contact_id) VALUES (?, ?)", [0, $request->rcv]);
            }

            \DB::update("UPDATE messages SET lu = ? WHERE env_id = ? AND rcp_id = ?", [
                1, $request->rcv, $_COOKIE['id']
            ]);

        } else {
            $message->env_id = $_COOKIE['id'];

            $contacts = \DB::select("SELECT * FROM contacts WHERE (user_id = ? AND contact_id = ?) OR (user_id = ? AND contact_id = ?)", [
                $_COOKIE['id'], $request->rcv, $request->rcv, $_COOKIE['id']
            ]);

            if (count($contacts) == 0) {
                \DB::insert("INSERT INTO contacts (user_id, contact_id) VALUES (?, ?)", [$_COOKIE['id'], $request->rcv]);
            }

            \DB::update("UPDATE messages SET lu = ? WHERE env_id = ? AND rcp_id = ?", [
                1, $request->rcv, $_COOKIE['id']
            ]);

        }

        $message->rcp_id = $request->rcv;
        $message->message = $request->message;
        $message->lu = 0;
        $message->save();


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

    public function body(Request $request) {

        $messages = \DB::select("SELECT * FROM messages WHERE (env_id = ? AND rcp_id = ?) OR (env_id = ? AND rcp_id = ?)", [
            $request->rcv, $_COOKIE['id'], $_COOKIE['id'], $request->rcv
        ]);

        \DB::update("UPDATE messages SET lu = ? WHERE env_id = ? AND rcp_id = ?", [
            1, $request->rcv, $_COOKIE['id']
        ]);

        return view('users.messages.body', [
            'messages' => $messages
        ]);
    }

    public function count() {

        $nb = count(\DB::select("SELECT * FROM messages WHERE rcp_id = ? AND lu = ?", [$_COOKIE['id'], 0]));

        return $nb;
    }
}
