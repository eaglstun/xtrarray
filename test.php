<?

error_reporting( E_ALL | E_STRICT );
ini_set( 'display_errors', TRUE );

require 'xtrarray.php';

$x = xtrarray( array(
	'foo' => 'bar',
	'test' => 123,
	456 => 'what what',
	10 => array(
		'hello' => 'there'
	)
) );

var_dump( $x->foo );
var_dump( $x['foo'] );

//var_dump( $x->456 );
var_dump( $x['456'] );

var_dump( $x->monkeys );
var_dump( $x['monkeys'] );

// what shoud this do?
//$x[array(123)] = 456;

foreach( $x as $k=>$v ){
	var_dump( $k );
}