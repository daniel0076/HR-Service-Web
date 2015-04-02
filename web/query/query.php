<?php
    class boss
    {
        private static $db=null;
        public function __construct()
        {
            try
            {
                self::$db= new PDO('mysql:host=localhost;dbname=db-lab1;charset=utf8', 'db-lab1', "adgjl';khfs");
            } catch (PDOException $e)
            {
                echo 'Connection failed!' . $e->getMessage() ;
            }
        }

        public function BossRegister($account,$password,$phone,$email)
        {
            try
            {
                $sql = "SELECT account FROM employer WHERE account = :account";
                $run = self::$db->prepare($sql);
                $run->execute(array(':account'=>$account));
                if($run->rowCount())
                {
                    echo "account exist";
                    return False;
                }
                $sql = "INSERT INTO employer (account,password,phone,mail) VALUES (:account,:password,:phone,:email)";
                $run = self::$db->prepare($sql);
                $run->execute(array(':account'=>$account,
                                    ':password'=>$password,
                                    ':phone'=>$phone,
                                    ':email'=>$email));
            } catch (PDOException $e)
            {
                echo 'Register failed!' . $e->getMessage();
                return False;
            }

        }
        public function PostJob($employer,$occupation,$location,$working_time,$experience,$salary)
        {
            try
            {
                $sql = "INSERT INTO "
            }
        }

        public function UpdateJob($occupation,$location,$working_time,$experience,$salary)
        {
        }

        public function RemoveJob()
        {
        }


    }
#    class jobseeker
#    {
#
#        public $db = new PDO('mysql:host=localhost;dbname=db-lab1;charset=utf8', 'db_lab1', 'LYftspRzKPyCaVXj');
#        public function JobSeekerRegister($account,$password,$education,$expected_salary,$phone,$gender,$age,$email)
#        {
#        }
#    }
?>
