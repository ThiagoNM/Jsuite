<?php 

require_once __DIR__ . "/../../vendor/autoload.php";

use Rakit\Validation\Validator;

$validator = new Validator;

$validation = $validator->validate($_POST + $_FILES, [
//    'nom'                   => 'required|min:6',
    'email'                 => 'required|email',
    'contrasenya'           => 'required|min:8|regex: /\d/',
    'contrasenya2'          => 'required|same:contrasenya',
//    'avatar'                => 'uploaded_file:0,1000K,png,jpg,gif',
]);

if ($validation->fails()) {

	My\Helpers::flash("Dades incorrectes");
	$url = My\Helpers::url("/user/profile.php");
	My\Helpers::redirect($url);

} else {
	// validation passes
	echo "Success!";
}
