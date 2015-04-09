<?php
    class Boss
    {
        private static $myPDO=null;
        public function __construct()
        {
            echo '!';
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

            try
            {
            $sql = "SELECT account FROM user WHERE account = :account";
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':account'=>$account));
            }
            catch(PDOException $e)
            {
                return false;
            }
            if($run->rowCount())
            {
                return False;
            }
            return true;
        }
        public function BossRegister($account,$password,$phone,$email)
        {
            try
            {
                $sql = "INSERT INTO employer (account,password,phone,email) VALUES (:account,:password,:phone,:email)";
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':account'=>$account,
                                    ':password'=>hash('sha256',$password),
                                    ':phone'=>$phone,
                                    ':email'=>$email));
            } catch (PDOException $e)
            {
                echo 'Register failed!' . $e->getMessage();
                return False;
            }
            return True;

        }
        public function DropdownValue($attr)
        {
            try
            {
                $sql="SELECT * from $attr";
                $run=self::$myPDO->prepare($sql);
                $run->execute();
                $res=$run->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e)
            {
                echo 'Can\'t find ' . $attr . $e->getMessage();
                return false;
            }
            if($res)
            {
                return $res;
            }
            return false;

        }
        public function PostJob($employer_id,$occupation_id,$location_id,$working_time,$education,$experience,$salary)
        {
            try
            {
                $sql = "INSERT INTO `recruit` (`employer_id`, `occupation_id`, `location_id`, `working_time`, `education`, `experience`, `salary`) VALUES (:employer_id, :occupation_id, :location_id, :working_time, :education, :experience, :salary)";
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':employer_id'=>$employer_id,
                                    ':occupation_id'=>$occupation_id,
                                    ':location_id'=>$location_id,
                                    ':working_time'=>$working_time,
                                    ':education'=>$education,
                                    ':experience'=>$experience,
                                    ':salary'=>$salary
                                ));
            } catch (PDOException $e)
            {
                echo 'Post failed!' . $e->getMessage();
                return False;
            }
            return True;

        }
#
#        public function UpdateJob($occupation,$location,$working_time,$experience,$salary)
#        {
#        }
#
#        public function RemoveJob()
#        {
#        }
#
#
#    }
#    class jobseeker
#    {
#
#        public function JobSeekerRegister($account,$password,$education,$expected_salary,$phone,$gender,$age,$email)
#        {
#        }
    }
?>
