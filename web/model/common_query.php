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
            die();
        }
        //create the view
        try
        {
            $sql="select * FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_NAME='recruit_table_view'";
            $run=self::$myPDO->prepare($sql);
            $run->execute();
            $res=$run->fetchAll(PDO::FETCH_ASSOC);
            if(!$res){
                $sql="
CREATE VIEW recruit_table_view AS
SELECT recruit.id,occupation,location,working_time,education,experience,salary,
employer.id AS employer_id,
occupation.id AS occupation_id,
location.id AS location_id
FROM `recruit`
INNER JOIN `employer` ON recruit.employer_id=employer.id
INNER JOIN `location`ON recruit.location_id=location.id
INNER JOIN `occupation` ON recruit.occupation_id=occupation.id
";
                $run=self::$myPDO->prepare($sql);
                $run->execute();
                $res=$run->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e)
        {
            echo 'Can\'t find ' . $attr . $e->getMessage();
            return false;
        }
    }

    public function searchJob($occupation=null,$location=null,
        $worktime=null,$education=null,$experience=null,$salary=0,$sort="")
    {
        $sql="SELECT * FROM recruit_table_view WHERE";
        if($occupation!=null){
            $sql.=" occupation =:occupation";
        }
        else{
            $sql.=" (occupation IS NOT NULL  OR occupation !=:occupation)";
        }
        if($location!=null){
            $sql.=" AND location =:location";
        }
        else{
            $sql.=" AND (location IS NOT NULL OR location !=:location)";
        }
        if($worktime!=null){
            $sql.=" AND working_time =:worktime";
        }
        else{
            $sql.=" AND (working_time IS NOT NULL OR working_time !=:worktime)";
        }
        if($education!=null){
            $sql.=" AND education =:education";
        }
        else{
            $sql.=" AND (education IS NOT NULL OR education !=:education)";
        }
        if($experience!=null){
            $sql.=" AND experience =:experience";
        }
        else{
            $sql.=" AND (experience IS NOT NULL OR experience !=:experience)";
        }
        $sql.=" AND salary >=:salary";
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
            $run->execute(array(':location'=>$location,
                                ':worktime'=>$worktime,
                                ':occupation'=>$occupation,
                                ':education'=>$education,
                                ':experience'=>$experience,
                                ':salary'=>$salary
            ));
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
