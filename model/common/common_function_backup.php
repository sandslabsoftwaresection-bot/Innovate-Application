<?php //session_start();?>
<?php 

include $_SERVER['DOCUMENT_ROOT']."/model/db_connection/connection.php" ;
abstract class FunctionDefinitions
{
	abstract public function ListFromTable($SQL);
    abstract public function AddToTable($SQL);
    abstract public function ReturnCountValue($SQL);
	abstract public function CreateDropDown($SQL,$value,$text,$controlName,$title);
	abstract public function returnValuefromDB($SQL,$item);
	abstract public function UpdateTable($SQL);
	abstract public function DeleteRow($SQL);
    abstract public function userAuthentication($SQL,$SQL1,$password);
	abstract public function SignOut();
	abstract public function ExecuteProcedure($SQL);
	abstract public function CreateDropDownForSite($SQL,$value,$value1,$value2,$text,$controlName,$title);
	abstract public function ExecuteProcedureForReturnTableFormat($SQL);
	abstract public function ListFromAcntsTable($SQL);
	abstract public function CreateDropDownforProject($SQL,$value,$value1,$value2,$text,$controlName,$title);
	abstract public function CreateDropDownforSubject($SQL,$value,$value1,$text,$controlName,$title);
	
	abstract public function check_user_count($SQL);
	abstract public function ExecuteProcedureReturnMultiplevalues($SQL);
	
}

class CommonModel extends FunctionDefinitions
{
	public $varDBConnection,$varAcntConnection;
	var $result;
	var $flag=0;
	

	function __construct()
	{
		$DBConn = new DBConnection();
		$this->varDBConnection = $DBConn->ConnectToMYSQL();
   //	$ACNTConn= new AcntConnection();
	//	$this->varAcntConnection=$ACNTConn->ConnectToMYSQLAcnts();
	}

	public function ListFromTable($SQL)
	{
	
		$temp = array();
		$this->result = mysqli_query($this->varDBConnection, $SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
		    	
			$temp['data'][] = $row;
		
		}
	
	//	return json_encode($temp);
		echo json_encode($temp);
			$this->flag=1;
	}
	
		public function ListFromAcntsTable($SQL)
	{
		//echo $SQL;
		$temp = array();
		$this->result = mysqli_query($this->varAcntConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
			$temp['data'][] = $row;
		}
		$this->flag=1;
		echo json_encode($temp);
		
	}
  

    function ReturnCountValue($SQL)
	{
			$this->result = mysqli_query($this->varDBConnection,$SQL);
			$affected_status = mysqli_num_rows($this->result);
			$this->flag=1;
			return $affected_status;
	}
	

	public function CreateDropDown($SQL,$value,$text,$controlName,$title)
	{
		
		$str = "<select class='form-control form-control-sm'  id='".$controlName."' name='".$controlName."'><option value=0>".$title."</option>";
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
			$str=$str."<option value='".trim($row[$value])."'>".trim($row[$text])."</option>";
		}

		$str = $str .'</select>';

		$this->flag=1;
		echo $str;
		
	}
	
	
	public function CreateDropDownForPRN($SQL,$value,$text,$controlName,$title,$variable_prn)
	{
		
		
		$str = "<select class='form-control form-control-sm'  id='".$controlName."' name='".$controlName."'><option value=0>".$title."</option>";
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
			$str=$str."<option value='".trim($row[$value])."'>".trim($row[$text])."</option>";
		}

		$str = $str.'</select>';

		$this->flag=1;
		echo $str;
		
	}
	function ExecuteProcedureReturnMultiplevalues($SQL)
	{
			$retval = mysqli_query($this->varDBConnection, $SQL);
			if (!($res = $this->varDBConnection->query("SELECT @msg as msg,@msg1 as msg1"))) {
				echo "Fetch failed: (" . $this->varDBConnection->errno . ") " . $this->varDBConnection->error;
			}
			$row = $res->fetch_assoc();
			$this->flag=0;
            
			echo json_encode($row);

	}
	
	
	
	
	public function CreateDropDownForSite($SQL,$value,$value1,$value2,$text,$controlName,$title)
	{
	
		$str = "<select class='form-control'  id='".$controlName."' name='".$controlName."'><option value='0'>".$title."</option>";
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
		   
			//$str=$str."<option value=".$row[$value]."-".$row[$value1]."-".$row[$value2].">".$row[$text]."</option>";
			$str=$str."<option value=".$row[$value].">".$row[$text]."</option>";	
		}

		$str = $str .'</select>';

		$this->flag=1;
		echo $str;
		
	}
	
	
	public function CreateDropDownForSubject($SQL,$value,$value1,$text,$controlName,$title)
	{
	
		$str = "<select class='form-control'  id='".$controlName."' name='".$controlName."'><option value='0'>".$title."</option>";
	
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
		   
		$str=$str."<option value=".trim($row[$value])."-".trim($row[$value1]).">".trim($row[$text])."</option>";
			//$str=$str."<option value=".$row[$value].">".$row[$text]."</option>";	
		}

		$str = $str .'</select>';

		$this->flag=1;
		echo $str;
		
	}

		public function CreateDropDownforProject($SQL,$value,$value1,$value2,$text,$controlName,$title)
	{
	
		$str = "<select class='form-control form-control-sm'  id='".$controlName."' name='".$controlName."'><option value='0'>".$title."</option>";
		$this->result = mysqli_query($this->varAcntConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
		   
			$str=$str."<option value=".trim($row[$value])."/".trim($row[$value1]).">".$row[$text]." ( ".trim($row[$value1])." )"."</option>";
			//$str=$str."<option value=".$row[$value].">".$row[$text]."</option>";	
		}

		$str = $str .'</select>';

		$this->flag=1;
		echo $str;
		
	}
	
	
	public function returnValuefromDB($SQL,$item)
	{
		
		$res=0;
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		while($row=mysqli_fetch_assoc($this->result)) {
			$res=$row[$item];
		}

		$this->flag=0;
		echo $res;
		return $res;
		
	}
    
   
	
  
	public function userAuthentication($SQL,$SQL1,$password)
	{
	
		$user_name; 
		$user_contact_number ;
		$user_address;
		$user_whatsapp_no;
		$user_email_id;
		$user_type_id;
        $user_type_name;
        $user_username;
		$user_password;
		$user_image;
        $user_status;
        $$user_id;
        
        $privilege;
        
           

       
        
        $return_string="";
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		$row_count = mysqli_num_rows($this->result);
		
		if($row_count>=1)
		{

            while($row=mysqli_fetch_assoc($this->result))
             {
			
				$user_id =$row['users_id'];
			 
                $user_username =$row['user_username'];
        		$user_password =$row['user_password'];
        	
                $user_status =$row['status'];
				}
			
			if($user_status=='Active')
			{
				if($password==$user_password)
				{
					session_start();
					
					                $this->result = mysqli_query($this->varDBConnection,$SQL1);
                            		$row_count = mysqli_num_rows($this->result);
                            		
                            		if($row_count>=1)
                            		{
                                    $temp = array();
                            	
                            		while($row=mysqli_fetch_assoc($this->result)) {
                            			$temp['data'][] = $row;
                            		}
                            		
                                     $_SESSION['privilege']  = json_encode($temp);
                                         
                            		}  
					              
									
									// Store data in session variables
									
									
									$_SESSION["loggedin"] = "true";
									$_SESSION["user_id"] = $user_id;
									$_SESSION["user_name"] = $user_name; 
								 
									$_SESSION["user_username"] = $user_username;
									$_SESSION["user_password"] = $user_password; 
									
									$_SESSION["user_status"] = $user_status;
									$_SESSION['LOGINSTATUS']='true';
								
									
								
										$return_string="quotation_new.php?m=7&sm=2";
									
									
									
									
									
									
									return 'true'.'#'.$return_string;
				}
				else
				{
					return 'Please provide correct password...!';
				}

			}
			else
			{
				return 'Your Login is not active, Please contact your administrator..!';
			}
			
		
		}
		else
		{
			return 'Username does not Exists...!';
		}
		
		
		
		$this->flag=1;
		
		
	}


	
	
	function AddToTable($SQL)
	{
		try { 
				mysqli_query($this->varDBConnection, $SQL);
				$inserted_id = mysqli_insert_id($this->varDBConnection);
				$this->flag=0;
				echo $inserted_id;
				return $inserted_id;
		}
		catch (mysqli_sql_exception $e) { 
			return $e->errorMessage(); 
		} 
		//exit();
		
	}

	function UpdateTable($SQL)
	{
			$retval = mysqli_query($this->varDBConnection, $SQL);
			$affected_status = mysqli_affected_rows($this->varDBConnection);
			$this->flag=0;
			return $affected_status;
	}




	function DeleteRow($SQL)
	{
			$retval = mysqli_query($this->varDBConnection, $SQL);
			$affected_status = mysqli_affected_rows($this->varDBConnection);
			$this->flag=0;
			echo $affected_status;
	}
	

	
    
	public function SignOut()
	{
	
		session_start();
		$_SESSION = array();
		session_destroy();
	}

   public function ExecuteProcedure($SQL)
	{
			$retval = mysqli_query($this->varDBConnection, $SQL);
			if (!($res = $this->varDBConnection->query("SELECT @msg as _p_out"))) {
				echo "Fetch failed: (" . $this->varDBConnection->errno . ") " . $this->varDBConnection->error;
			}
			$row = $res->fetch_assoc();
			$this->flag=0;
			
			echo $row['_p_out'];
		
			
	}
	
	
	function ExecuteProcedureForReturnTableFormat($SQL) 
	{	
			$temp = array();
			$this->result = mysqli_query($this->varDBConnection,$SQL);
			while($row=mysqli_fetch_assoc($this->result)) {
			
				$temp['data'][] = $row;
			}
	
			$this->flag=1;
			
			echo json_encode($temp);

	}
	
	public function check_user_count($SQL)
	{
		
		$this->result = mysqli_query($this->varDBConnection,$SQL);
		
		while($row=mysqli_fetch_assoc($this->result)) {
			$card_count=$row['count'];
		}
		
		echo $card_count;
			
		
	}
	

	function __destruct() {
		if($this->flag==1)
		{
			mysqli_free_result($this->result);
		}
		
		mysqli_close($this->varDBConnection);
		mysqli_close($this->varAcntConnection);
		//print "Destroying " . __CLASS__ . "\n";
		
    }
	
	

}

?>