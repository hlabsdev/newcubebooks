<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Visitors\MainController;

// Route::get('/user', [UserController::class, 'index']);

Route::get('/',  [MainController::class, 'index'])->name("indexVisitors");
// Route::get('/', "Visitors\MainController@index")->name("indexVisitors");
Route::get('publication/plus', "PublicationController@plusProduits")->name('plusPublication');

Route::get('about', "Visitors\MainController@about")->name("about");
Route::get('contacts', "Visitors\MainController@contacts")->name("contacts");
Route::get('login', "Visitors\MainController@login")->name("login");
Route::get('register', "Visitors\MainController@register")->name("register");

Route::post('register/form', "Visitors\RegisterCotroller@registerForm")->name('registerForm');
Route::get('register/mail_sent', "Visitors\RegisterCotroller@emailSent")->name('emailSent');

Route::get('register/password', "Visitors\RegisterCotroller@password")->name('password');
Route::get('register/datas', "Visitors\RegisterCotroller@datas")->name('datas');

Route::post('register/pssword/form', "Visitors\RegisterCotroller@passwordForm")->name("registerPasswordForm");

Route::post('register/datas/form', "Visitors\RegisterCotroller@datasForm")->name("registerDatasForm");

Route::get('register/success', "Visitors\RegisterCotroller@success")->name("successRegister");

Route::get('users', "Users\MainController@index")->name('indexUsers');

Route::get('users/contacts', "Users\MainController@contacts")->name('uContacts');

Route::get('users/notifications', "Users\NotificationController@index")->name('listNotifications');
Route::get('users/publications', "Users\PublicationController@index")->name('listPublications');
Route::get('users/messages', "Users\MessageController@index")->name('listMessages');

Route::get('users/profile', "Users\ProfileController@index")->name('uProfile');
Route::post('users/profile/{id}/update', "Users\ProfileController@update")->name('uProfileUpdate');

Route::get('users/{id}/publication', "Users\ProfileController@foreign")->name('uForeign');
Route::get('users/{id}/profile/other', "Users\ProfileController@other")->name('otherProfile');

Route::post('users/login', "Visitors\MainController@loginForm")->name('loginForm');

Route::get('logout', "Users\MainController@logout")->name('logout');

Route::post('users/publications/store', "Users\PublicationController@store")->name('storePublication');

Route::get('users/publications/{id}/edit', "Users\PublicationController@edit")->name('editPublication');
Route::post('users/publications/{id}/update', "Users\PublicationController@update")->name('updatePublication');
Route::get('users/publications/{id}/destroy', "Users\PublicationController@destroy")->name('destroyPublication');

Route::get("users/updates/visible", "Users\ProfileController@visible")->name('updateVisible');

Route::get('users/comments/store', "Users\CommentaireController@store")->name('storeComment');

Route::get('users/notifications/count', "Users\NotificationController@count")->name('getBadgeNotifications');
Route::get('users/publications/{publication_id}/notifications/{id}/show', "Users\NotificationController@show")->name('showComment');
Route::get('users/publications/all', "Users\PublicationController@all")->name('allPublications');

Route::get('users/publiations/answer/store', "Users\ReponseCommentaireController@store")->name('storeAnswerComment');
Route::get('users/publiations/{id}/show', "Users\PublicationController@show")->name('showPublications');

Route::get('users/publications/{publication_id}/comments/{commentaire_id}/answer/{id}/show', "Users\CommentaireController@answer")->name('showAnswerComment');
Route::post('users/avatar/post', "Users\ProfileController@avatar")->name('updateAvatar');

Route::get('cubebooks/{nom}/{id}/commander', "Users\CubeStoreController@commander")->name('usersCubeStoreCommander');
Route::get('users/cubebooks', "Users\CubeStoreController@cubeStore")->name('cubeStore');

Route::get('admins/urb/cubebooks/produits/list', "Admin\CubeStoreController@liste")->name('adminCubeStoreListeProduits');
Route::get('admins/urb/cubebooks/produits/{id}/edit', "Admin\CubeStoreController@edit")->name('adminCubeStoreEditProduit');

Route::post('admins/urb/cubebooks/produits/store', "Admin\CubeStoreController@store")->name('adminCubeStoreStoreProduit');
Route::post('admins/urb/cubebooks/produits/{id}/update', "Admin\CubeStoreController@update")->name('adminCubeStoreUpdateProduit');

Route::get('admins/urb/cubebooks/produits/{id}/destroy', "Admin\CubeStoreController@destroy")->name('adminCubeStoreDestroyProduit');

Route::get('users/manuscrits/list', "Users\ManuscritController@index")->name('userManuscrit');
Route::post('users/manuscrits/store', "Users\ManuscritController@store")->name('userStoreManuscrit');
Route::get('users/manuscrits/{id}/destroy', "Users\ManuscritController@destroy")->name('userDestroyManuscrit');

Route::get('users/livres/{id}/edit', "Admin\CubeStoreController@uEdit")->name('usersCubeStoreEditProduit');
Route::get('users/user_livres', "Users\ProfileController@livres")->name('usersCubeStoreListeProduits');

Route::get('admins/urb/cubebooks/users/list', "Admin\UsersController@liste")->name('adminCubeStoreListeUsers');
Route::get('admins/urb/cubebooks/users/{id}/show', "Admin\UsersController@show")->name('adminShowUser');

Route::get('admins/urb/cubebooks/login', "Admin\LoginController@login");
Route::post('admins/urb/cubebooks/login/form', "Admin\LoginController@loginForm")->name('gerantLoginForm');

Route::get('admins/urb/cubebooks/users/{id}/block', "Admin\UsersController@block")->name('adminBlockUser');
Route::get('admins/urb/cubebooks/users/{id}/unBlock', "Admin\UsersController@unBlock")->name('adminUnBlockUser');

Route::get('admins/urb/cubebooks/users/search/result', "Admin\UsersController@search")->name('getAdminsUsersResultSearch');

Route::get('admins/urb/cubebooks/notifications/list', "Admin\NotificationController@liste")->name('adminCubeStoreListeNotifications');
Route::get('admins/urb/cubebooks/notifications/list/read/all', "Admin\NotificationController@readAll")->name('adminCubeStoreReadAllNotifications');

Route::get('admins/urb/cubebooks/manuscrits/list', "Admin\ManuscritController@liste")->name('adminCubeStoreListeManuscrits');

Route::get('admins/urb/cubebooks/search/livres/result', "Admin\CubeStoreController@resultSearch")->name('getLivresAdminResultSearch');

Route::get('admins/urb/cubebooks/messages/liste', "Admin\MessageController@liste")->name('adminLiseMessages');

Route::get('users/message/send/store/', "Users\MessageController@store")->name('usersSendMessage');
Route::get('users/message/send/body', "Users\MessageController@body")->name('usersGetMessages');

Route::get('users/messages/count/unread', "Users\MessageController@count")->name('usersGetCountMessages');

Route::get('users/cubebooks/search/livres/result', "Users\CubeStoreController@resultSearch")->name('usersGetResultSearch');

Route::get('users/list/all', "Users\MainController@allUsers")->name('allUsers');

Route::get('users/search/result', "Users\MainController@resultSearch")->name('usersResultSearch');


Route::get('admis/urb/cubestore/publicites/all', "Users\MainController@allPublicites")->name('allPublicites');

Route::post('admis/urb/cubestore/publicites/store', "Users\MainController@storePublicite")->name('adminCubeStorePublicite');

Route::get('admis/urb/cubestore/publicites/{id}/destroy', "Users\MainController@destroyPublicite")->name('adminCubeStoreDestroyPublicite');

Route::get('users/livres-gratuits', "Users\CubeStoreController@livreGratuit")->name('usersLivreGratutis');

Route::get('users/livres-gratuits/{nom}/{id}/telecharger', "Users\CubeStoreController@DownloadLivreGratuit")->name('usersDownloadLivreGratutis');
Route::post('admins/urb/cubebooks/livres-gratuits/store', "Admin\CubeStoreController@storeLivreGratuit")->name('adminStoreLivreGratuit');

Route::get('auteurs/list', "Users\MainController@listAuteurs")->name('ListeAuteurs');

Route::get('users/auteurs/list', "Users\AuteurController@index")->name('usersListeAuteurs');
Route::post('users/auteurs/store', "Users\AuteurController@store")->name('usersStoreAuteurs');
Route::post('users/auteurs/{id}/update', "Users\AuteurController@update")->name('usersUpdateAuteurs');
Route::get('users/auteurs/{id}/edit', "Users\AuteurController@edit")->name('usersEditAuteur');
Route::get('users/auteurs/{id}/destroy', "Users\AuteurController@destroy")->name('usersDestroyAuteur');

Route::get('livres-gratuits/telechargement/{id}/count',function($id) {

    $livres = \DB::table('livres_gratuits')->where('id', $id)->get();

    \DB::insert('INSERT INTO livre_gratuits (livre_id) VALUES (?) ', [$id]);

    foreach($livres as $livre) {
        return redirect("https://cubebooks.saeicube.com/$livre->pdf");
    }

})->name('countLivresGratuitsDownload');

Route::get('users/librairie/{id}/{nom}', "Users\MainController@librairie")->name('usersShowLibrairie');

Route::post('resset/password/form', function(Request $request) {
    if(count(User::where('email', $request->email)->get()) == 0) {
        return back()->with('error', 'Email non trouvé !');
    }

    $to_name = "CUBE STORE";

    $to_email = 'ngabalazare3@gmail.com';
    $to_email2 = 'cubealerte@gmail.com';

    $data = array(
        'nom_prenom' => $request->nom_prenom,
        'email' => $request->email,
        'pays' => $request->pays,
        'ville' => $request->ville,
        'quartier' => $request->quartier
    );

    \Mail::send('mails_views.notification_reinit_mdp', $data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email)
        ->from('cubebooks@saeicube.com', 'CUBE BOOKS')
        ->subject("Notification de demande de réinialisation de mot de passe sur CUBE BOOKS");
    });
    \Mail::send('mails_views.notification_reinit_mdp', $data, function ($message) use ($to_name, $to_email2) {
        $message->to($to_email2)
        ->from('cubebooks@saeicube.com', 'CUBE BOOKS')
        ->subject("Notification de demande de réinialisation de mot de passe sur CUBE BOOKS");
    });
    return back()->with('success', 'La demande a été soumise avec succès. La vérification est encours ... Un mail vous sera envoyé. Merci');
})->name('resetPasswordForm');
