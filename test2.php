<?php 
header("Content-Type:text/html; charset=utf-8");
class a
{
    public $num = 0;
    public $row;
    public $origin = array(
    array(1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
    array(1, 1, 0, 1, 1, 0, 0, 0, 0, 0),
    array(1, 0, 0, 1, 1, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 1, 1, 1, 0, 0),
    array(1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
    array(1, 0, 0, 0, 1, 0, 0, 1, 1, 1),
    array(1, 0, 0, 0, 1, 0, 0, 1, 1, 1),
    array(1, 0, 0, 0, 1, 0, 0, 1, 1, 1),
    array(1, 1, 0, 1, 1, 0, 0, 0, 0, 1)
    );

    function find($x,$y)
    {
        if( $this->origin[$y][$x] == 1)
        {
            $this->row[$this->num]["y"] =$y;
            $this->row[$this->num]["x"] =$x;
            $this->num += 1;
        }
        if($x<count($this->origin))
        {
            $this->find($x + 1,$y);
        }
        return $this->row;
    }
}
//將1的座標抓出來
$a = new a;
for($y=0;$y<10;$y++)
{
    $test = $a->find(0,$y);
}

//輸出元圖形
echo "<hr>";
echo "原圖形<br>";

locat($test);
function locat($arr)
{
    $a = new a;
    $a->origin;
    $num = 0;
    for($o=0;$o<10;$o++)
    {
        for($p=0;$p<10;$p++)
        {
            if($arr[$num]["y"] == $o && $arr[$num]["x"] ==$p )
            {
                echo "1.";
                $num++;
            }
            else
            {
                echo"0.";
            }
        }
        echo "<br>";
    }
    
}

echo "<hr>";

//判斷座標相鄰並將相鄰座標存成陣列
//1個陣列為一區塊
$newarray ;
$ar = $test;
$num = 0;
$save = 0;
$nu2;


for($gg=0;$gg<sizeof($test);$gg++)
{
    if($test[$gg] == null)
    {
        continue;
    }
    else
    {
        //判斷區塊起始點座標的上下左右
        for($gg2=0,$nu=0;$gg2<sizeof($test);$gg2++)
        {
            if($test[$gg2] == null)
            {
                continue;
            }
            else
            {
                if($ar[$gg]["y"] == $test[$gg2]["y"] && ($ar[$gg]["x"] + 1) == $test[$gg2]["x"])
                {
                    $newarray[$save][$nu] = $test[$gg2];
                    $test[$gg2] = null;
                    $nu++;
                }
                else if($ar[$gg]["y"] == $test[$gg2]["y"] && ($ar[$gg]["x"] - 1) == $test[$gg2]["x"])
                {
                    $newarray[$save][$nu] = $test[$gg2];
                    $test[$gg2] = null;
                    $nu++;
                }
                else if(($ar[$gg]["y"] + 1) == $test[$gg2]["y"] && $ar[$gg]["x"]  == $test[$gg2]["x"])
                {
                    $newarray[$save][$nu] = $test[$gg2];
                    $test[$gg2] = null;
                    $nu++;
                }
                else if(($ar[$gg]["y"] - 1) == $test[$gg2]["y"] && $ar[$gg]["x"]  == $test[$gg2]["x"])
                {
                    $newarray[$save][$nu] = $test[$gg2];
                    $test[$gg2] = null;
                    $nu++;
                }
                else if($ar[$gg]["y"] == $test[$gg2]["y"] && $ar[$gg]["x"] == $test[$gg2]["x"])
                {
                    $newarray[$save][$nu] = $test[$gg];
                    $test[$gg] = null;
                    $nu++;
                }
                
            }
            $nu2 = $nu;
        }
        $row = li($test,$newarray,$save,$nu2);
        $test = $row[0];
        $newarray = $row[1];
        
        
    }
    $save++;
}

//判斷區塊內現有座標的上下左右並將座標存入
function li($test,$newarray,$save,$nu,$l = 0)
{
    for($g2=0;$g2<sizeof($test);$g2++)
    {
        if($test[$g2] == null)
        {
            continue;
        }
        else
        {
            if($newarray[$save][$l]["y"] == $test[$g2]["y"] && ($newarray[$save][$l]["x"] + 1) == $test[$g2]["x"])
            {
                $newarray[$save][$nu] = $test[$g2];
                $test[$g2] = null ;
                $nu++;
            }
            else if($newarray[$save][$l]["y"] == $test[$g2]["y"] && ($newarray[$save][$l]["x"] - 1) == $test[$g2]["x"])
            {
                $newarray[$save][$nu] = $test[$g2];
                $test[$g2] = null ;
                $nu++;
            }
            else if(($newarray[$save][$l]["y"] + 1) == $test[$g2]["y"] && $newarray[$save][$l]["x"]  == $test[$g2]["x"])
            {
                $newarray[$save][$nu] = $test[$g2];
                $test[$g2] = null ;
                $nu++;
            }
            else if(($newarray[$save][$l]["y"] - 1) == $test[$g2]["y"] && $newarray[$save][$l]["x"]  == $test[$g2]["x"])
            {
                $newarray[$save][$nu] = $test[$g2];
                $test[$g2] = null ;
                $nu++;
            }
        }
    }
    if($newarray[$save][$l] != null)
    {
        $l++;
        $row = li($test,$newarray,$save,$nu,$l);
        
    }
    else
    {
        $row[0] = $test;
        $row[1] = $newarray;
        //return $row;
    }
    
   return $row;
    
}

//比對區塊大小
for($p = 0;$p<count($newarray);$p++)
{
    $maxbluck ;
    $maxnum = count($maxbluck) ;
    $bors;
    $RA;
    if($maxnum  < count($newarray[$p]))
    {
        $maxbluck = $newarray[$p];
        $RA = "false";
     
    }
    else if($maxnum == count($newarray[$p]))
    {
        if($RA == "false")
        {
            $bors = $maxnum;
            $ag = array_merge($maxbluck,$newarray[$p]);
            $RA = "true";
        }
        else if($RA == "true")
        {
             $ag = array_merge($ag,$newarray[$p]);
        }
    }
    
}
//最大區塊不只一塊將輸
if($bors > count($maxbluck))
{
    $maxbluck = $ag;
}

//將最大區塊輸出
$ag = null;
echo"<hr>";
echo "最大區域<br>";
$ge;
for($or=0;$or<10;$or++)
{
    for($pr=0;$pr<10;$pr++)
    {
        $ge = "false";
        for($mm = 0;$mm<count($maxbluck);$mm++)
        {
            
            if($maxbluck [$mm]["y"] == $or && $maxbluck [$mm]["x"] ==$pr )
            {
                echo "1.";
                $ge = "true";
            }
        }
        if($ge != "true")
        {
            echo"0.";
        }
        
    }
    echo "<br>";
}
?>
