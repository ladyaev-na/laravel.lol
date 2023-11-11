<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Создание маршрута /test с выводом сообщения Тестовая страница! */
Route::get('/test',function (){
    return "Тестовая страница!";
});
Route::get('/test/1',function (){
    return "Тестовая страница 1!";
});
Route::get('/test/2',function (){
    return "Тестовая страница 2!";
});

/* Параметры маршрута */
Route::get('/post/{id}', function ($id){
    return "Пост " . $id;
});
Route::get('/user/{name}', function ($name){
    return "Привет, " . $name;
});

/* Несколько параметров в маршруте */
Route::get('/post/{cardId}/{postId}', function ($cardId, $postId){
    return $cardId . " - " .$postId;
});
Route::get('/user/{surname}/{name}', function ($surname, $name){
    return "Привет, " . $surname . "  " .$name . "!";
});

/* Не обязательные параметры - ?*/
Route::get('/posts/page/{page?}', function ($page = 1){
    return "Номер страницы: " . $page;
});
Route::get('/city/{city?}', function ($city = "Томск"){
    return "Город: " . $city;
});

/* Ограничение параметров */
Route::get('/users/{age}', function ($age){
   return "Возраст: " . $age;
})->where('age', '[0-9]+');

Route::get('/govsing/{sign}/{id}', function ($sign, $id){
   return "Номер: " . $sign . ". Регион: " . $id . ".";
})->where('sign', '[a-z]+')->where('id', '[0-9]+');

/*
 * whereAlpha - ограничение на буквы.
 * whereNumber - ограничение на цифры.
 * whereAlphaNumeric - ограничение на буквы и цифры.
 * ограничение на id сделано глобально на все маршруты в файле App/Providers/RouteServiceProvider.php*/
Route::get('/govsing/{sign}/{id}', function ($sign, $id){
   return "Номер: " . $sign . ". Регион: " . $id . ".";
})->whereAlpha('sign');

/*
 * Разрешение конфликтов в маршрутах
 * Сначало указываем частные случаи, потом общие
 */
Route::get('/test2/all',function (){
    return "Все тесты: ";
});
Route::get('/test2/{n}',function ($n){
    return "Тест - " . $n;
});

/* Групировка маршрутов */
Route::prefix('/test3')->group( function (){

    Route::get('/all',function (){
        return "Все тесты: ";
    });

    Route::get('/{n}',function ($n){
        return "Тест - " . $n;
    });

});

/*
 * Маршрут использующий контроллер
 * Route::get('/маршрут',['полное имя контроллера', 'имя действия']);
*/
Route::get('/hi', ['App\Http\Controllers\PostController','hello']);

/* Если мы заюзали имя контроллера, то можем писать так ...*/
Route::get('/hello', [PostController::class,'hello']);

/* Передача параметра маршрута в контроллер */
Route::get('/hi/{name}', [PostController::class, 'hello2']);

/* Применение параметров к маршруту */
Route::get('/hello/{id}', [PostController::class, 'hello3'])-> where('id', '[1-4]');

Route::get('/hello5/{name}', [PostController::class, 'hello5']);


/* Представление */
Route::get('/hello6', [PostController::class, 'hello6']);

Route::get('/hello7/{name}', [PostController::class, 'hello7']);
