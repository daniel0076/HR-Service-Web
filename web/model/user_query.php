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
        public function make_specialty_table_query()
        {
            try
            {
                $sql = "SELECT * FROM specialty";
                $run = self::$myPDO->prepare($sql);
                $run->execute();
                $res = $run->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e)
            {
                echo 'Query error' . $e->getMessage();
                return false;
            }
            return $res;
        }
        public function fetchUserSpecialty($id)
        {

            try
            {
                $sql = "SELECT user_specialty.*, specialty.specialty FROM user_specialty,specialty WHERE user_id = :id AND user_specialty.specialty_id = specialty.id";
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':id'=>$id));
                $res = $run->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e)
            {
                echo 'Query error' . $e->getMessage();
                return false;
            }
            return $res;
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
                $sql_specialty="INSERT INTO user_specialty (user_id,specialty_id) VALUES (:user_id,:specialty_id)";
                $run = self::$myPDO->prepare($sql_user);
                $is_success1=$run->execute(array(':account'=>$account,
                                    ':password'=>hash('sha256',$password),
                                    ':education'=>$education,
                                    ':expected_salary'=>$expected_salary,
                                    ':phone'=>$phone,
                                    ':gender'=>$gender,
                                    ':age'=>$age,
                                    ':email'=>$email));
                $sql = "SELECT id FROM user WHERE account = :account";
                $getID = self::$myPDO->prepare($sql);
                $getID->execute(array(':account'=>$account));
                $ID=$getID->fetchAll(PDO::FETCH_ASSOC);
                $is_success2=true;
                foreach ($specialty as $x)
                {
                    $run=self::$myPDO->prepare($sql_specialty);
                    $success=$run->execute(array(':user_id'=>$ID[0]['id'],
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
