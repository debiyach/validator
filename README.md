# Simple PHP Validation

This project was created to minimize dependencies. It also saves time thanks to its fast and simple installation. You
can use it only if you want to check the data. For advanced systems, the project will continue to evolve.

Install:

    composer require debiyach/validation
E.g

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
      
    $s = new \Debiyach\Validation\Validator($data, $filter, $config);  
      
    if ($s->validate()){  
      echo 'No problem, go out!';  
    }else{  
      echo 'Tyler Durden: Shut up!';  
    }

If you want to look at the errors;

    echo $s;

This returns you an JSON.