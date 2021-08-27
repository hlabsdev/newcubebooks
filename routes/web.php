<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Visitors\MainController;

use App\Http\Controllers\Users\AuteurController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\NotificationController;
use App\Http\Controllers\Users\CommentaireController;
use App\Http\Controllers\Users\CubeStoreController as UserCubeController;
use App\Http\Controllers\Users\MessageController;
use App\Http\Controllers\Users\MainController as UserMainController;

use App\Http\Controllers\Admin\CubeStoreController;
use App\Http\Controllers\Admin\LoginController;

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

// Route::get('/user', [UserController::class, 'index']);

Route::get('/',  [MainController::class, 'index'])->name("indexVisitors");
Route::get('publication/plus', [PublicationController::class, 'plusProduits'])->name('plusPublication');

Route::get('about', [MainController::class, 'about'])->name("about");
Route::get('contacts', [MainController::class, 'contacts'])->name("contacts");

Route::get('login', [MainController::class, 'login'])->name("login");
Route::get('register', [MainController::class, 'register'])->name("register");

Route::post('register/form', [RegisterCotroller::class, 'registerForm'])->name('registerForm');
Route::get('register/mail_sent', [RegisterCotroller::class, 'emailSent'])->name('emailSent');

Route::get('register/password', [RegisterCotroller::class, 'password'])->name('password');
Route::get('register/datas', [RegisterCotroller::class, 'datas'])->name('datas');

Route::post('register/pssword/form', [RegisterCotroller::class, 'passwordForm'])->name("registerPasswordForm");

Route::post('register/datas/form', [RegisterCotroller::class, 'datasForm'])->name("registerDatasForm");

Route::get('register/success', [RegisterCotroller::class, 'success'])->name("successRegister");

Route::get('users', [UserMainController::class, 'index'])->name('indexUsers');

Route::get('users/contacts', [UserMainController::class, 'contacts'])->name('uContacts');

Route::get('users/notifications', [NotificationController::class, 'index'])->name('listNotifications');
Route::get('users/publications', [PublicationController::class, 'index'])->name('listPublications');
Route::get('users/messages', [MessageController::class, 'index'])->name('listMessages');

Route::get('users/profile', [ProfileController::class, 'index'])->name('uProfile');
Route::post('users/profile/{id}/update', [ProfileController::class, 'update'])->name('uProfileUpdate');

Route::get('users/{id}/publication', [ProfileController::class, 'foreign'])->name('uForeign');
Route::get('users/{id}/profile/other', [ProfileController::class, 'other'])->name('otherProfile');

// Route::post('users/login', [UserMainController::class, 'loginForm'])->name('loginForm');
Route::post('users/login', [MainController::class, 'loginForm'])->name('loginForm');

Route::get('logout', [UserMainController::class, 'logout'])->name('logout');

Route::post('users/publications/store', [PublicationController::class, 'store'])->name('storePublication');

Route::get('users/publications/{id}/edit', [PublicationController::class, 'edit'])->name('editPublication');
Route::post('users/publications/{id}/update', [PublicationController::class, 'update'])->name('updatePublication');
Route::get('users/publications/{id}/destroy', [PublicationController::class, 'destroy'])->name('destroyPublication');

Route::get("users/updates/visible", [ProfileController::class, 'visible'])->name('updateVisible');

Route::get('users/comments/store', [CommentaireController::class, 'store'])->name('storeComment');

Route::get('users/notifications/count', [NotificationController::class, 'count'])->name('getBadgeNotifications');
Route::get('users/publications/{publication_id}/notifications/{id}/show', [NotificationController::class, 'show'])->name('showComment');
Route::get('users/publications/all', [PublicationController::class, 'all'])->name('allPublications');

Route::get('users/publiations/answer/store', [ReponseCommentaireController::class, 'store'])->name('storeAnswerComment');
Route::get('users/publiations/{id}/show', [PublicationController::class, 'show'])->name('showPublications');

Route::get('users/publications/{publication_id}/comments/{commentaire_id}/answer/{id}/show', [CommentaireController::class, 'answer'])->name('showAnswerComment');
Route::post('users/avatar/post', [ProfileController::class, 'avatar'])->name('updateAvatar');

Route::get('cubebooks/{nom}/{id}/commander', [CubeStoreController::class, 'commander'])->name('usersCubeStoreCommander');
Route::get('users/cubebooks', [CubeStoreController::class, 'cubeStore'])->name('cubeStore');

Route::get('admins/urb/cubebooks/produits/list', [CubeStoreController::class, 'liste'])->name('adminCubeStoreListeProduits');
Route::get('admins/urb/cubebooks/produits/{id}/edit', [CubeStoreController::class, 'edit'])->name('adminCubeStoreEditProduit');

Route::post('admins/urb/cubebooks/produits/store', [CubeStoreController::class, 'store'])->name('adminCubeStoreStoreProduit');
Route::post('admins/urb/cubebooks/produits/{id}/update', [CubeStoreController::class, 'update'])->name('adminCubeStoreUpdateProduit');

Route::get('admins/urb/cubebooks/produits/{id}/destroy', [CubeStoreController::class, 'destroy'])->name('adminCubeStoreDestroyProduit');

Route::get('users/manuscrits/list', [ManuscritController::class, 'index'])->name('userManuscrit');
Route::post('users/manuscrits/store', [ManuscritController::class, 'store'])->name('userStoreManuscrit');
Route::get('users/manuscrits/{id}/destroy', [ManuscritController::class, 'destroy'])->name('userDestroyManuscrit');

Route::get('users/livres/{id}/edit', [CubeStoreController::class, 'uEdit'])->name('usersCubeStoreEditProduit');
Route::get('users/user_livres', [ProfileController::class, 'livres'])->name('usersCubeStoreListeProduits');

Route::get('admins/urb/cubebooks/users/list', [UsersController::class, 'liste'])->name('adminCubeStoreListeUsers');
Route::get('admins/urb/cubebooks/users/{id}/show', [UsersController::class, 'show'])->name('adminShowUser');

Route::get('admins/urb/cubebooks/login', [LoginController::class, 'login'])->name('adminUrbLogin');
Route::post('admins/urb/cubebooks/login/form', [LoginController::class, 'loginForm'])->name('gerantLoginForm');

Route::get('admins/urb/cubebooks/users/{id}/block', [UsersController::class, 'block'])->name('adminBlockUser');
Route::get('admins/urb/cubebooks/users/{id}/unBlock', [UsersController::class, 'unBlock'])->name('adminUnBlockUser');

Route::get('admins/urb/cubebooks/users/search/result', [UsersController::class, 'search'])->name('getAdminsUsersResultSearch');

Route::get('admins/urb/cubebooks/notifications/list', [NotificationController::class, 'liste'])->name('adminCubeStoreListeNotifications');
Route::get('admins/urb/cubebooks/notifications/list/read/all', [NotificationController::class, 'readAll'])->name('adminCubeStoreReadAllNotifications');

Route::get('admins/urb/cubebooks/manuscrits/list', [ManuscritController::class, 'liste'])->name('adminCubeStoreListeManuscrits');

Route::get('admins/urb/cubebooks/search/livres/result', [CubeStoreController::class, 'resultSearch'])->name('getLivresAdminResultSearch');

Route::get('admins/urb/cubebooks/messages/liste', [MessageController::class, 'liste'])->name('adminLiseMessages');

Route::get('users/message/send/store/', [MessageController::class, 'store'])->name('usersSendMessage');
Route::get('users/message/send/body', [MessageController::class, 'body'])->name('usersGetMessages');

Route::get('users/messages/count/unread', [MessageController::class, 'count'])->name('usersGetCountMessages');

Route::get('users/cubebooks/search/livres/result', [CubeStoreController::class, 'resultSearch'])->name('usersGetResultSearch');

Route::get('users/list/all', [UserMainController::class, 'allUsers'])->name('allUsers');

Route::get('users/search/result', [UserMainController::class, 'resultSearch'])->name('usersResultSearch');


Route::get('admis/urb/cubestore/publicites/all', [MainController::class, 'allPublicites'])->name('allPublicites');

Route::post('admis/urb/cubestore/publicites/store', [MainController::class, 'storePublicite'])->name('adminCubeStorePublicite');

Route::get('admis/urb/cubestore/publicites/{id}/destroy', [MainController::class, 'destroyPublicite'])->name('adminCubeStoreDestroyPublicite');

Route::get('users/livres-gratuits', [CubeStoreController::class, 'livreGratuit'])->name('usersLivreGratutis');

Route::get('users/livres-gratuits/{nom}/{id}/telecharger', [CubeStoreController::class, 'DownloadLivreGratuit'])->name('usersDownloadLivreGratutis');
Route::post('admins/urb/cubebooks/livres-gratuits/store', [CubeStoreController::class, 'storeLivreGratuit'])->name('adminStoreLivreGratuit');

Route::get('auteurs/list', [MainController::class, 'listAuteurs'])->name('ListeAuteurs');

Route::get('users/auteurs/list', [AuteurController::class, 'index'])->name('usersListeAuteurs');
Route::post('users/auteurs/store', [AuteurController::class, 'store'])->name('usersStoreAuteurs');
Route::post('users/auteurs/{id}/update', [AuteurController::class, 'update'])->name('usersUpdateAuteurs');
Route::get('users/auteurs/{id}/edit', [AuteurController::class, 'edit'])->name('usersEditAuteur');
Route::get('users/auteurs/{id}/destroy', [AuteurController::class, 'destroy'])->name('usersDestroyAuteur');

Route::get('livres-gratuits/telechargement/{id}/count',function($id) {

    $livres = \DB::table('livres_gratuits')->where('id', $id)->get();

    \DB::insert('INSERT INTO livre_gratuits (livre_id) VALUES (?) ', [$id]);

    foreach($livres as $livre) {
        return redirect("https://cubebooks.saeicube.com/$livre->pdf");
    }

})->name('countLivresGratuitsDownload');

Route::get('users/librairie/{id}/{nom}', [UserMainController::class, 'librairie'])->name('usersShowLibrairie');

Route::post('resset/password/form', function(Request $request) {
    if(count(App\User::where('email', $request->email)->get()) == 0) {
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
