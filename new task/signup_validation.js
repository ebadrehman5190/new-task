 function validation()
    {
        
        var validate= true;
        var letters = /^[A-Za-z]+$/;  
        var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;    
        var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
        
            if(document.getElementById("user").value == ""){
                    document.getElementById("var_user").innerHTML="please enter username";
                    validate = false;
                }else{
                    document.getElementById("var_user").innerHTML="";
                }
                
            if(document.getElementById("name").value == ""){
                    document.getElementById("var_name").innerHTML="please enter your name";
                    validate = false;
                }else{
                    document.getElementById("var_name").innerHTML="";
                }
                
            if(document.getElementById("email").value == ""){
                    document.getElementById("var_email").innerHTML="please enter your email";
                    validate = false;
                }else{
                    document.getElementById("var_email").innerHTML="";
                }
            
            
            if(document.getElementById("password").value == ""){
                    document.getElementById("var_password").innerHTML="please enter password";
                    validate = false;
                }else{
                    document.getElementById("var_password").innerHTML="";
                }
                
           	if(document.getElementById("cpassword").value == ""){
			    	document.getElementById("var_cpassword").innerHTML="please enter the Confirm Password";
				    validate = false;
    			}else if(document.getElementById("cpassword").value != document.getElementById("cpwd").value){
	    			document.getElementById("var_cpassword").innerHTML="Password must be same";
		    		validate = false;
			    }else{
				    document.getElementById("var_cpassword").innerHTML="";
		    	}    
                
           if(document.getElementById("gender").checked == false && document.getElementById("gender1").checked == false){
			    	document.getElementById("var_gender").innerHTML="Gender must be required";
		    		validate = false;
			    }else{
				    document.getElementById("var_gender").innerHTML="";
		    	}
            
            if(document.getElementById("admin").checked == false && document.getElementById("admin2").checked == false){
	    			document.getElementById("var_admin").innerHTML="Admin type must be required";
		    		validate = false;
			    }else{
				    document.getElementById("var_admin").innerHTML="";
			    }
                
                
                if(validate == false){
                    return(false);
                }else{
                    return(true);
                }
    }		
            
   