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
            $sql="
SELECT recruit.id,occupation,location,working_time,education,experience,salary,
employer.id AS employer_id,
occupation.id AS occupation_id,
location.id AS location_id
FROM `recruit`
INNER JOIN `employer` ON recruit.employer_id=employer.id
INNER JOIN `location`ON recruit.location_id=location.id
INNER JOIN `occupation` ON recruit.occupation_id=occupation.id
";
        if ($sort=="desc"){
            $sort=" ORDER BY salary DESC";
        }
        else if($sort=="asc"){
            $sort=" ORDER BY salary ASC";
        }else{
            $sort="";
        }
            $sql.=$sort;
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
    public function searchJob()
    {
        $sql="";
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
