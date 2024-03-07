<?php

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
Route::post('/verify', function (Request $request) {
    $user = User::where('mobile', $request->mobile)->first();
    $password = rand(1111, 9999);
    if ($user) {
        $user->password = $password;
    } else {
        $user = new User();
        $user->mobile = $request->mobile;
        $user->password = $password;
        $user->save();
    }
    $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
    $user = "ahmadsadati";
    $pass = "A123$!123";
    $fromNum = "+98100009";
    $toNum = array($request->mobile);
    $pattern_code = "139";
    $input_data = array("tracking-code" => "1054 4-41", "name" => "PAnel");

    echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
    return response()->json(['status' => true, 'user' => $user]);
});
