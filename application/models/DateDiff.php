<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DateDiff extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function CountHour($tgl,$TglPulang,$StartHour,$EndHour)
    {
        $hours_difference_Out =(new DateTime($StartHour))->diff(new DateTime($EndHour)) ; // ngecheck lembur
        $hours_difference_Out = $hours_difference_Out->format('%r%h');
        
        $takedayOnly1 = new DateTime($TglPulang);
				
        $takedayOnly2 = new DateTime($tgl); // tgl masuk
        
        $DateDiff =$takedayOnly1->diff($takedayOnly2); // ngecheck lembur
        $Year_difference = $DateDiff->format('%y');
        $Month_difference = $DateDiff->format('%m');
        $Day_difference = $DateDiff->format('%d');

        $takeyearonly1 = $takedayOnly1->format('Y'); 
        $takemonthonly1 = $takedayOnly1->format('m'); 
        $takedayOnly1 = $takedayOnly1->format('d');

        $takeyearonly2 = $takedayOnly2->format('Y');
        $takemonthonly2 = $takedayOnly2->format('m'); 
        $takedayOnly2 = $takedayOnly2->format('d');
        
        ////////////////////////////////////////////////////////////////////////////////////
        $TotalDaysinMonthandYears =0;
        $totaldaysinmonth2 =0;
        for($ii=0;$ii<=$Year_difference;$ii++)
        {
            if($Year_difference>0)//jika ada perbedaan tahun
            {
                if($ii==0)//jika tahun pertama
                {
                    $MonthRemaining = 12 - $takemonthonly2;
                    $Month_difference =  $MonthRemaining - $takemonthonly2;
                    for($i =0;$i<$MonthRemaining;$i++)//Khusus Bulan
                    {
                        $totaldaysinmonth2 = cal_days_in_month(CAL_GREGORIAN,($takemonthonly2+$i),($takeyearonly2));
                        $TotalDaysinMonthandYears = $TotalDaysinMonthandYears + $totaldaysinmonth2;
                    }
                }else{
                    for($i =0;$i<$Month_difference;$i++)//Khusus Bulan
                    {
                        $totaldaysinmonth2 = cal_days_in_month(CAL_GREGORIAN,(1+$i),($takeyearonly2+$ii));
                        $TotalDaysinMonthandYears = $TotalDaysinMonthandYears + $totaldaysinmonth2;
                    }
                }
            }else{
                for($i =0;$i<$Month_difference;$i++)//Khusus Bulan
                    {
                        $totaldaysinmonth2 = cal_days_in_month(CAL_GREGORIAN,($takemonthonly2+$i),($takeyearonly2));
                        $TotalDaysinMonthandYears = $TotalDaysinMonthandYears + $totaldaysinmonth2;
                    }
            }
            //$TotalDaysinMonthandYears = $TotalDaysinMonthandYears + $totaldaysinmonth2;
        }
        $hours_difference_Out = ($hours_difference_Out + (24 * ($Day_difference+$TotalDaysinMonthandYears)));
        return $hours_difference_Out;
    }                                                              
    
    public function dateDiffInDays($date1, $date2)  
    { 
        // Calculating the difference in timestamps 
        $diff = strtotime($date2) - strtotime($date1); 
        
        // 1 day = 24 hours 
        // 24 * 60 * 60 = 86400 seconds 
        return (floor($diff / 86400)); 
    }
    public function dateDiffInMinute($date1, $date2)  
    { 
        // Calculating the difference in timestamps 
        $diff = strtotime($date2) - strtotime($date1); 
        
        return (floor($diff / 60)); 
    }
    public function dateDiffInHour($date1, $date2)  
    { 
        // Calculating the difference in timestamps 
        $diff = strtotime($date2) - strtotime($date1); 
        //echo $diff.' | '.(round($diff / 3600)); 
        return (floor($diff / 3600)); 
    }

    public function CountMonth($tgl,$TglPulang)
    {
        $takedayOnly1 = new DateTime($TglPulang);
				
        $takedayOnly2 = new DateTime($tgl); // tgl masuk
        
        $DateDiff =$takedayOnly1->diff($takedayOnly2); // ngecheck lembur
        $Year_difference = $DateDiff->format('%y');
        $Month_difference = $DateDiff->format('%m');
        
        $takeyearonly1 = $takedayOnly1->format('Y'); 
        $takemonthonly1 = $takedayOnly1->format('m'); 
        $takedayOnly1 = $takedayOnly1->format('d');

        $takeyearonly2 = $takedayOnly2->format('Y');
        $takemonthonly2 = $takedayOnly2->format('m'); 
        $takedayOnly2 = $takedayOnly2->format('d');
      
        ////////////////////////////////////////////////////////////////////////////////////
        $MonthRange = 0;
        $MonthRemaining=0;
        for($ii=0;$ii<=$Year_difference;$ii++)
        {
            if($ii==0)//jika tahun pertama
            {
                $MonthRange = $Month_difference;
                //$Month_difference =  $MonthRemaining - $takemonthonly2;
                
            }else{

                $MonthRange =  $MonthRange + 12;
            }
            
        }
        return $MonthRange;
    }
    
    public function DateToday($susunan1,$susunan2,$susunan3)
    {
        $date = date("$susunan1-$susunan2-$susunan3");
        return $date;
    }
    public function DateTodaynHour($susunan1,$susunan2,$susunan3)
    {
        $date = date("$susunan1-$susunan2-$susunan3 h:i:s");
        return $date;
    }
}

