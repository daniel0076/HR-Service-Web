<?php
    class commonQuery
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
        public function searchJob($sort=null)
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
    }
?>
