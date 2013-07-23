<?

/*
*
*	@param
*	@return XtrArray
*/
function xtrarray( $default = NULL ){
	return new XtrArray( $default );
}

/*
*	extended Array Object
*	useful for not having to check if keys exist,
*	and accessing values through object style $xtrarray->foo or array style $xtrarray['foo']
*	@version 1.0
*	@access public
*	@return new XtrArray
*	@see function xtrarray()
*	@see http://www.php.net/manual/en/class.arrayobject.php#103508
*/
class XtrArray extends ArrayObject implements IteratorAggregate{
	private $storage = array();
	
	/*
	*
	*	@param array|object|NULL
	*/
	public function __construct( $default = null ){
		if( !is_null($default) )
			$this->storage = (array) $default;
			
		parent::setFlags( parent::ARRAY_AS_PROPS );
		parent::setFlags( parent::STD_PROP_LIST );
	}
	
	/*
	*	object style get
	*	@param
	*	@return
	*/
	public function __get( $k ){
		return isset($this->storage[$k]) ? $this->storage[$k] : NULL;
	}
	
	/*
	*	array style get
	*	@param
	*	@return
	*/
	public function offsetGet( $k ){
		return isset( $this->storage[$k] ) ? $this->storage[$k] : NULL;
	}
	
	/*
	*	object style set
    *	called on $mt->k = v
    *	@param
	*	@return
    */ 
	public function __set( $k, $v ){
		$this->storage[$k] = $v;
	}
	
	/*
	*	array style set
    *	called on $mt[k] = v 
    *	@param
	*	@return
    */ 
	public function offsetSet( $k, $v ){
		is_null( $k ) ? array_push( $this->storage, $v ) : $this->storage[$k] = $v;
	}
	
	/*
	*
	*	@return int
	*/
	public function count(){
		return count( $this->storage );
	}
	
	/*
	*
	*	@return NULL
	*/
	public function asort(){
		asort( $this->storage );
	}
	
	/*
	*
	*	@return NULL
	*/
	public function ksort(){
		ksort( $this->storage );
	}
	
	/*
	*
	*	@param
	*	@return
	*/
    public function offsetUnset( $name ){
		unset( $this->storage[$name] );
	}
     
    /*
    *	called on foreach()
    *	@param
	*	@return
    */  
	public function getIterator(){
        return new ArrayIterator( $this->storage );
    }
}
