<?php
    class JobSeeker
    {
        private static $myPDO = null;
        public function __construct()
        {
            if(isset($GLOBALS['db']))
            {
                self::$myPDO = $GLOBALS['db'];
            }
            else
            {
                echo "Please require admin/auth/db_auth.php\n";
            }
        }
        public function checkAvail($account)
        {
            $sql = "SELECT account FROM user WHERE account = :account";
            try{
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':account'=>$account));
            }
            catch(PDOException $e){
                return false;
            }
            if($run->rowCount())
            {
                return False;
            }
            return true;
        }
        public function JobSeekerRegister($account,$password,$education,$expected_salary,$phone,$gender,$age,$email,$specialty)
        {
            try
            {
                $sql_user = "INSERT INTO user (account,password,education,expected_salary,phone,gender,age,email) VALUES (:account,:password,:education,:expected_salary,:phone,:gender,:age,:email)";
                $sql_specialty="INSERT INTO user_specialty (user,specialty_id) VALUES (:user,:specialty_id)";
                $run = self::$myPDO->prepare($sql_user);
                $is_success1=$run->execute(array(':account'=>$account,
                                    ':password'=>hash('sha256',$password),
                                    ':education'=>$education,
                                    ':expected_salary'=>$expected_salary,
                                    ':phone'=>$phone,
                                    ':gender'=>$gender,
                                    ':age'=>$age,
                                    ':email'=>$email));
                $is_success2=true;
                foreach ($specialty as $x)
                {
                    $run=self::$myPDO->prepare($sql_specialty);
                    $success=$run->execute(array(':user'=>$account,
                                                 ':specialty_id'=>$x));
                    if(!$success)
                    {
                        $is_success2=false;
                    }
                }
            } catch (PDOException $e)
            {
                echo 'Register failed!' . $e->getMessage();
                return False;
            }
            return $is_success1 && $is_success2;
        }
    }
