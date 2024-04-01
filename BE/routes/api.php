<?php

use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', function (Request $request) {
    if (Auth::check()) {
        // true
        return response()->json(['status' => false, 'authanticated' => true]);
    } else {
        //false
        $user = User::create($request->all());
        if ($user) {
            return response()->json(['status' => true, 'user' => $user]);
        } else {
            return response()->json(['status' => false]);
        }
    }
});
Route::post('/login', function (Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // The user is active.
        return Auth::check();
    } else {
        return Auth::check();
    }
});
// function sendSms($mobile, $password)
// {
// $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
// $user = "ahmadsadati";
// $pass = "A123$!123";
// $fromNum = "+983000505";
// $toNum = array($request->mobile);
// $pattern_code = "dil2eofzq9pmznf";
// $input_data = array("code" => $password);

// echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
// }
Route::post('/verify', function (Request $request) {
    $user = User::where('mobile', $request->mobile)->first();
    $password = rand(1111, 9999);
    if ($user) {
        $user->password = $password;
        $user->save();
    } else {
        $user = new User;
        $user->mobile = $request->mobile;
        $user->password = $password;
        $user->save();
    }
    // sendSms($request-> mobile, $password)
    // $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
// $user = "ahmadsadati";
// $pass = "A123$!123";
// $fromNum = "+983000505";
// $toNum = array($request->mobile);
// $pattern_code = "dil2eofzq9pmznf";
// $input_data = array("code" => $password);

// echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);

    return response()->json(['status' => true, 'user' => $user, 'password' => $password]);
});
Route::middleware('auth:api')->apiResource('posts', PostController::class);
Route::get('my-posts', [PostController::class, 'mypost']);
