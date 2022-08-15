<?php namespace App\Validation;

    class Valid{

        private $er;
        public function __construct(private $email=null,private $password=null,private $name=null,private $username=null)
        { $this->er = new ErrorHandle();}
        
        public function register_isvalid()
        {
            //validation name
            if(trim($this->name) == null) $this->er->set_error('name',ConstValid::NAME_EMP_ERR);
            else{
                if(strlen(trim($this->name))<3) $this->er->set_error('name',ConstValid::NAME_MIN_ERR);
            }
            if(!ctype_alpha(trim($this->name))) $this->er->set_error('name',ConstValid::NAME_LET_ERR);

            //validation username
            if(trim($this->username) == null) $this->er->set_error('username',ConstValid::USERNAME_EMP_ERR);
            else{
                if(strlen(trim($this->username))<6) $this->er->set_error('username',ConstValid::USERNAME_MIN_ERR);
            }
            if(!ctype_alnum(trim($this->username))) $this->er->set_error('username',ConstValid::USERNAME_NUMLET_ERR);

            $this->login_isvalid();
        
        }
        public function login_isvalid()
        {
            //validation password
            if(trim($this->password) == null) $this->er->set_error('password',ConstValid::PASS_EMP_ERR);
            else{
                if(strlen($this->password)<6) $this->er->set_error('password',ConstValid::PASS_MIN_ERR);
            }
            if(!ctype_alnum(trim($this->password))) $this->er->set_error('password',ConstValid::PASS_NUMLET_ERR);

           //validation email
           if(!(str_contains($this->email,"@gmail.com")||str_contains($this->email,"@yahoo.com"))){
            $this->er->set_error('email',ConstValid::EMAIL_VALID_ERR);
        }
        }
        public function get_error(string $field):array
        {
            return $this->er->get_error($field);
        }
        
        public function add_error(string $field,string $errormsg)
        {
            $this->er->set_error($field,$errormsg);
        }

        public function count_error():int
        {
            return $this->er->countall();
        }
        
    
    }