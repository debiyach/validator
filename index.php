<?php
/**
 * @author Ömer Faruk GÖL <omerfarukgol@hotmail.com>
 */

require_once './vendor/autoload.php';


$filter = [
    "foo" => "email|required|max:10|min:0",
    "bar" => "required|max:10|min:8",
    "bas" => "required|min:3"
];

$data = [
    "foo" => "foo.com",
    "bar" => 3,
    "bas" => [1, 2, 3, 4, 5]
];

$config = [
    'delimiter' => '|'
];

$s = new \Debiyach\Validation\Validator($data, $filter,$config);

if ($s->validate()){
    echo 'No problem, go out!';
}else{
    echo 'Tyler Durden: Shut up!';
}

echo $s;


