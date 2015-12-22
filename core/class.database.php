<?php
	// Cargar script guardado en un archivo desde terminal (por si el importador de cliente peta):   
	// mysql -h localhost -u root bd_name -p < ruta_archivo_a_cargar
	
	class db{
		private $host 	= DB_HOST;
		private $user 	= DB_USER;
		private $pass 	= DB_PASS;
		private $dbname = DB_NAME;
		private $dbtype = DB_TYPE;
		
		private $dbh;
    	private $error;
    	private $stmt;
    	private $bindParams = array();
 
	    public function __construct($db=null){
	    	if (isset($db)) {
		    	switch ($db) {
		    		case 'blog':
		    			$this->host = "obesity.es";
			    		$this->user = "wordpress_e";
			    		$this->pass = "OK4!t2sJ3l";
			    		$this->dbname = "wordpress_7";
			    		break;
		    		case 'panel':
		    			$this->host = "localhost";
			    		$this->user = "userbd";
			    		$this->pass = "root";
			    		$this->dbname = "imeo_panel";
			    		break;
		    	}
	    	}
	        // Creamos la DSN en función del tipo de base de datos
	        switch ($this->dbtype){
	        	case 'mysql':
	        		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
	        	break;
	        	case 'sqlsvr':
	        		$dsn = 'sqlsrv:Server=' . $this->host . ';Database=' . $this->dbname;
	        	break;
	        }
	        // Habilitamos las opciones
	        $options = array(
	            PDO::ATTR_PERSISTENT    => false,
	            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
	        );
	        // Creamos la instancia pdo
	        try{
	            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
	        }catch(PDOException $e){// Catch any errors
	            die($e->getMessage());
	        }
	    }

	    /**
	     * Corta la conexi�n con la base de datos
	     */
	    public function discconnect(){
	    	$this->dbh = null;
	    }
	    
	    /**
	     * Prepara la query que se va a ejecutar
	     * @param unknown_type $query
	     */
		public function query($query){
			$desarrollo = unserialize (DEVELOPMENT);
			
			//querys
			if($desarrollo['enabled'] && $desarrollo['querys']){
				show_query($query,$desarrollo['query_result'],$desarrollo['query_params']);
			}
			
		    $this->stmt = $this->dbh->prepare($query);
		}
		
		/**
		 * hace los bind de los datos de la query, recibe un array
		 * @param $array el array que se recibe es del tipo [key] => valor 
		 * donde la key lleva la misma key que hemos usado en la query
		 * ej: [':nombre'] => 'javier'
		 */
		public function prebind($array){
			if (is_array($array)) {
				foreach($array as $key=>$value){
					$this->bind($key, $value);
				}
			}
		}
		
		/**
		 * prepara los par�metros que vamos a usar en la query
		 * @param string $param es el valor de marcador de posici�n que vamos a utilizar en nuestra query, ejemplo :nombre.
		 * @param string $value es el valor que le vamos a dar al marcador de posicion de la query, ej Javier.
		 * @param string $type es el tipo de par�metro, example string.
		 */
		public function bind($param, $value, $type = null){
			$desarrollo = unserialize (DEVELOPMENT);
			
		    if (is_null($type)) {
		        switch (true) {
		            case is_int($value):
		                $type = PDO::PARAM_INT;
		                break;
		            case is_bool($value):
		                $type = PDO::PARAM_BOOL;
		                break;
		            case is_null($value):
		                $type = PDO::PARAM_NULL;
		                break;
		            default:
		                $type = PDO::PARAM_STR;
		        }
		    }
		    
		    $this->bindParams[$param] = $value;
		    $this->stmt->bindValue($param, $value, $type);
		}
		
		/**
		 * Ejecuta todo lo preparado previamente
		 */
		public function execute(){
			$desarrollo = unserialize (DEVELOPMENT);
			try{
				//querys
				if($desarrollo['enabled'] && $desarrollo['query_params']){
					show_query_params($this->bindParams);
				}
				
				//reinicio los parametros de la query
				$this->bindParams = array();
				return $this->stmt->execute();
			}catch(PDOException $e){// Catch any errors
	            die($e->getMessage());
	        }
		}
		
		/**
		 * devuelve un array del resultado de la query
		 */
		public function resultset(){
			$desarrollo = unserialize (DEVELOPMENT);
		    $this->execute();
		    
		    $rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		    
			//querys
			if($desarrollo['enabled'] && $desarrollo['query_result']){
				show_query_result($rows);
			}
		    
		    return $rows;
		}
		
		/**
		 * devuelve un solo resultado de la query preparada
		 */
		public function single(){
		    $desarrollo = unserialize (DEVELOPMENT);
		    $this->execute();
		    
		    $rows = $this->stmt->fetch(PDO::FETCH_ASSOC);
		    
			//querys
			if($desarrollo['enabled'] && $desarrollo['query_result']){
				show_query_result($rows);
			}
		    
		    return $rows;
		}
		
		/**
		 * devuelve el count de la query
		 */
		public function rowCount(){
		    return $this->stmt->rowCount();
		}
		
		/**
		 * Devuelve el �ltimo id insertado
		 */
		public function lastInsertId(){
		    return $this->dbh->lastInsertId();
		}
		
		/**
		 * Empieza una transacci�n a la que podemos volver atr�s si algo falla
		 */
		public function beginTransaction(){
		    return $this->dbh->beginTransaction();
		}
		
		/**
		 * Da por buena la transaccion
		 */
		public function endTransaction(){
		    return $this->dbh->commit();
		}
		
		/**
		 * Vuelve atr�s por si algo falla
		 */
		public function cancelTransaction(){
		    return $this->dbh->rollBack();
		}
		
		/**
		 * Realiza una inserci�n o un update de manera autom�tica
		 * en la tabla deseada en funci�n de si se env�a la pk o no
		 * @param array $datos 
		 * @param string $tabla con la que se interact�a
		 * @param array $pks primary keys que afectan a la tabla (por si la tabla tiene más de una) ** solo mysql
		 */
		public function stor($datos, $tabla, $pks = null){
			switch ($this->dbtype){
	        	case 'mysql':
	        		return $this->mysql_stor($datos, $tabla, $pks);
	        	break;
	        	case 'sqlsvr':
	        		//por problemas de estructura de tabla, no se puede tener la funcionalidad de las pks en mssql
	        		if(!is_null($pks)) die("En mssql no se pueden enviar pks de esa manera");
	        		return $this->mssql_stor($datos, $tabla);
	        	break;
	        }
		}
		
		/**
		 * Te da la informaci��n de una tabla.
		 * Uso exclusivo de la funci��n stor de mysql
		 * @param unknown_type $tabla
		 */
		private function get_table_info($tabla){
		    //preparo y ejecuto la query
			$query = $this->dbh->prepare("desc $tabla ;");
		    $query->execute();
			$datos = $query->fetchAll(PDO::FETCH_ASSOC);
		    
		    $cont=0;
		    
		    //me quedo con los datos que quiero
		    foreach($datos as $row){
		    	$campos[$cont] = array();
		        $campos[$cont]['COLUMN_NAME'] = $row['Field'];
		        $campos[$cont]['COLUMN_KEY']  = $row['Key'];
		        $campos[$cont]['IS_NULLABLE'] = $row['Null'];
		        $campos[$cont]['COLUMN_TYPE'] = $row['Type'];
		        $cont++;
		    }
		    
		    return $campos;
		}
		
		/**
		 * stor asociado a las bases de datos mysql, mira descripcion de la funci�n stor para saber qu� hace y los par�metros
		 */
		private function mysql_stor($datos, $tabla, $pks=null){
			$get = new stdClass();
			$get->insert = false;
			$get->null	 = false;
			
			//obtengo la info de la tabla
		    $campos = $this->get_table_info($tabla);
		    
		    //si no la consigo
		    if($campos==null || sizeof($campos)==0){
		    	//peto
				die ("La tabla enviada ".$tabla." no existe en el modelo o no tiene campos");
			}
			
			//preparo las pks
			$primarys 	 = array();
		    
		    //puede que la tabla tenga m�s de una pk, si me lo pasan por par�metro hago caso a lo que me dicen
		    if(is_array($pks)){
		        //recorro las pks que me env�an
		        foreach($pks as $pk){
		            
		        	$fill_pk = false;
		            
		            //recorro los datos que me envían
		            foreach($datos as $key=>$valor){
		            	//si me envian la pk
		                if($pk == $key){
		                	//si est� vac�o y no tenemos una de las pks rellenas
		                    if( ( is_null($valor) || $valor == "") && !$fill_pk ){
		                        $fill_pk=false; // no puedo hacer update
		                    }else{
		                        $fill_pk=true; // puedo hacer update
		                    }

		                    //me guardo los datos de la primary_key
		                    $primarys[]	  = $key;
		                    
		                    break;
		                }
		            }
		            
		            //si me env�an una pk puedo al menos hacer un update, si no
		            if($fill_pk == false){
		                $get->insert= true;
		            }
		        }
		    //si no me envían las primary keys, las busco yo
		    }else{
		    	//recorro todos los campos
	    		foreach($campos as $row){
	    			//presupongo que no me env�an una pk
		            $fill_pk=false;
		            //si lo que encuentro es una pk
		            if($row['COLUMN_KEY'] == "PRI"){
		            	//recorro todos los datos que me env�an
		            	foreach($datos as $row2=>$valor){
		            		//si coinciden las keys
		                    if(":".$row['COLUMN_NAME'] == $row2){
		                    	//si el valor est� a null
		                        if(is_null($valor) || $valor == ""){
		                            $fill_pk=false;// es un insert
		                        }else{
		                            $fill_pk=true;//es un update
		                        }
		                        //me guardo la primary key
		                        $primarys[]=$row2;
		                        break;
		                    }
		                }
		                
		                if($fill_pk == false){
		                    $get->insert= true;
		                }
		            }
		        }
		    }
		    
		    //en funci�n de si me viene o no es un insert o un update
	        if($get->insert){
	        	$query 	= "insert into ".$tabla." (";
	        }else{
	        	$query  = "update ".$tabla." set ";
	        }
	        
	        
	        //guardo las keys recibidas porque son las que me interesan
			$campos_recibidos = array();		
			foreach($datos as $key=>$value){
				array_push($campos_recibidos, $key);
			}
			
			//compongo el update o los parametros del insert con los campos que he recibido
			$values = array();
			//recorro todos los campos de la tabla
			foreach($campos as $campo){
				if(in_array(":".$campo['COLUMN_NAME'], $campos_recibidos)){
					if(!$get->insert){
						if(!in_array(":".$campo['COLUMN_NAME'], $primarys)){
							$query .= $campo['COLUMN_NAME']." = :".$campo['COLUMN_NAME'].", ";
						}
					}else{
						array_push($values, ":".$campo['COLUMN_NAME']);
						$query .= $campo['COLUMN_NAME'].", ";
					}
				}
			}
			
			//en pongo el where o los values en funcion de insert/update
			if(!$get->insert){
				$query .= "where ";
				
				//recorro todas las primarys para el where
				foreach($primarys as $primary){
					$query .= str_replace(":","",$primary)." = ".$primary." and ";	
				}
				
				$query .= " ;";
				$query = str_replace(", where", " where", $query);//quito la coma final
				$query = str_replace("and  ;", " ;", $query);//quito el and final
			}else{
				$query .= ") values (";
				foreach($values as $value){
					if(!is_null($datos[$value])){				
						$query .= $value.", ";
					}else{
						$query .= "NULL, ";
					}
				}
				
				$query .= ") ";
				$query = str_replace(", ) ", ") ", $query).";";//quito la coma final
			}
			//preparo la query
			$this->query($query);
			//a�ado los datos
			$this->prebind($datos);
			//ejecuto la query
			return $this->execute();
			
		}
		
		/**
		 * stor asociado a las bases de datos mssql, mira descripcion de la funci�n stor para saber qu� hace y los par�metros
		 */
		private function mssql_stor($datos, $tabla){
			$this->query("SELECT name, is_nullable, is_identity FROM sys.columns WHERE (object_id = OBJECT_ID(:tabla))");
			$this->bind(":tabla", $tabla);
	        $campos=$this->resultset();
	        
			if($campos==null || sizeof($campos)==0){
				die ("La tabla enviada ".$tabla." no existe en el modelo o no tiene campos");
			}
	        
	        $insert = true;
	        $query  = "";
	        
	        //busco los campos primary key
	        foreach($campos as $campo){
	        	if($campo['is_identity']){
	        		$pk = ":".$campo['name'];		
	        	}
	        }
	        
	        //en funci�n de si me viene o no es un insert o un update
	        if($datos[$pk] !=null){
	        	$insert = false;
	        	$query  = "update ".$tabla." set ";
	        }else{
	        	$query 	= "insert into ".$tabla." (";
	        }
	        
	        
	        //guardo las keys recibidas porque son las que me interesan
			$campos_recibidos = array();		
			foreach($datos as $key=>$value){
				array_push($campos_recibidos, $key);
			}
			
			//compongo el update o los parametros del insert
			$values = array();
			foreach($campos as $campo){
				if(in_array(":".$campo['name'], $campos_recibidos)){
					if(!$insert){
						if(":".$campo['name']!= $pk){
							$query .= $campo['name']." = :".$campo['name'].", ";
						}
					}else{
						array_push($values, ":".$campo['name']);
						$query .= $campo['name'].", ";
					}
				}
			}
			
			//en pongo el where o los values en funcion de insert/update
			if(!$insert){
				$query .= "where ".str_replace(":","",$pk)." = ".$pk." ;";
				$query = str_replace(", where", " where", $query);//quito la coma final
			}else{
				$query .= ") values (";
				foreach($values as $value){
					if(!is_null($datos[$value])){				
						$query .= $value.", ";
					}else{
						$query .= "NULL, ";
					}
				}
				
				$query .= ") ";
				$query = str_replace(", ) ", ") ", $query).";";//quito la coma final
			}
			
			//preparo la query
			$this->query($query);
			//a�ado los datos
			$this->prebind($datos);
			//ejecuto la query
			return $this->execute();
		}
	} 
?>