_____________________________________________________commands

./vendor/bin/phpunit --bootstrap ./vendor/autoload.php --debug --testdox tests



/*_____________________________files
rename('tempfile', 'source'); 

strlen('how much length');

file_put_contents("test.txt","Hello World ");
file_get_contents("test.txt");

explode(" ", $pizza);
substr("Hello world",10);//d

str_replace(['a'], ['b'], 'a'); 
preg_replace(['/a/i'],['ss'],'a');


$matches = array();
preg_match_all('/[0-9]{2,}/','fdsf 12324 43 3453 t3 4 76 ', $matches);


/*____________________________________________________numbers

0xf;//15
bindec('11') ;//3

round(1.95583, 2);  // 1.96
ceil(4.3);          // 5
floor(9.999);       // 9

/*___________________________________________________array
sort()  - small to big
rsort() - big to small
asort() - by value.
ksort() - by key.


array_keys(['key1'=>'v','key2'=>'v']);// ['key1','key2']
array_unique(["a" => "green", "red", "b" => "green", "blue", "red"]);//[green,red,blue]

/*________________write to file

$myfile = fopen("newfile.txt", "w");
fwrite($myfile, "John Doe\n");

/*________________read from file

$sp = fopen('source', 'r');
while (!feof($sp)) {
   $fileData = fread($sp, 512);  
}


fclose($myfile);

/*_____________________________________________database*/
$mysqli = new \mysqli("localhost", "root", "", "shopify");
$mysqli->query('insert into user(name,email,password) values ("first","email","password")');
