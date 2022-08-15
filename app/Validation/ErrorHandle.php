<?php namespace App\Validation;

    class ErrorHandle{ 

        private $error = [
            'name' =>[],
            'username' => [],
            'email' => [],
            'password' => []
        ];
        public function set_error(string $field,string $error_msg):bool
        {
            if($this->count($field) == -1) return false;
            else{
                array_push($this->error[$field],$error_msg);
                return true;
            }        
        }
        public function get_error(string $field):array
        {
           return $this->error[$field];
        }
        public function count(string $field):int
        {
            if(!$this->key_exist($field)) return -1;
            else return count($this->error[$field]);
        }
        public function key_exist(string $field):bool
        {
            return array_key_exists($field,$this->error);
        }
        public function countall():int
        {
            $c = $this->count('name');
            $c+= $this->count('username');;
            $c+= $this->count('email');
            $c+= $this->count('password');
            return $c;
        }



    }
