<?php
    class Boss
    {
        private static $myPDO=null;
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
        public function make_user_table_query()
        {
            try
            {
                $sql="SELECT * FROM user";
                $run=self::$myPDO->prepare($sql);
                $run->execute();
                $res=$run->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e)
            {
                echo "<script>alert($e->getMessage());</script>";
                return false;
            }
            if($res)
            {
                return $res;
            }
            return false;

        }
        public function make_table_query($sort=null)
        {
            if ($sort=="desc"){
                $sql="SELECT recruit.*, location.location, occupation.occupation FROM recruit,location,occupation WHERE recruit.location_id=location.id and recruit.occupation_id=occupation.id ORDER BY `salary` DESC, `id` ASC ";
            }
            else if($sort=="asc"){
                $sql="SELECT recruit.*, location.location, occupation.occupation FROM recruit,location,occupation WHERE recruit.location_id=location.id and recruit.occupation_id=occupation.id ORDER BY `salary` ASC,`id` ASC ";
            }else{
                $sql="SELECT recruit.*, location.location, occupation.occupation FROM recruit,location,occupation WHERE recruit.location_id=location.id and recruit.occupation_id=occupation.id ORDER BY `id` ASC";
            }
            try
            {
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
        public function PostJob($boss_id,$occupation_id,$location_id,$working_time,$education,$experience,$salary)
        {
            try
            {
                $sql = "INSERT INTO `recruit` (`employer_id`, `occupation_id`, `location_id`, `working_time`, `education`, `experience`, `salary`) VALUES (:employer_id, :occupation_id, :location_id, :working_time, :education, :experience, :salary)";
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':employer_id'=>$boss_id,
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
        public function checkPermission($id,$boss_id)
        {
            try
            {
                $sql="SELECT id,employer_id FROM recruit where id = :id";
                $run=self::$myPDO->prepare($sql);
                $run->execute(array(':id'=>$id));

            }catch (PDOException $e)
            {
                echo 'Can\'t check permission' . $e->getMessage();
                return false;
            }
            $res=$run->fetchAll(PDO::FETCH_ASSOC);
            if($boss_id==$res[0]['employer_id']){
                return true;
            }
            return false;
        }
        public function deletePost($recruit_id)
        {
            try
            {
                $sql="DELETE from recruit where id = :id";
                $run=self::$myPDO->prepare($sql);
                $run->execute(array(':id'=>$recruit_id));
            } catch(PDOException $e)
            {
                echo 'Delete failed' . $e->getMessage();
                return false;
            }
            return true;
        }

        public function UpdateJob($recruit_id,$occupation_id,$location_id,$working_time,$education,$experience,$salary)
        {
            try
            {
                $sql = "UPDATE recruit SET occupation_id = :occupation_id, location_id = :location_id, working_time = :working_time, education = :education, experience = :experience, salary = :salary WHERE id = :id";
                $run = self::$myPDO->prepare($sql);
                $run->execute(array(':occupation_id'=>$occupation_id,
                                    ':location_id'=>$location_id,
                                    ':working_time'=>$working_time,
                                    ':education'=>$education,
                                    ':experience'=>$experience,
                                    ':salary'=>$salary,
                                    ':id'=>$recruit_id));
            } catch(PDOException $e)
            {
                echo 'Update failed' . $e->getMessage();
                return false;
            }
            return true;
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
    }
?>
