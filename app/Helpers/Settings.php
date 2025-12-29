<?php

namespace App\Helpers;

use App\Models\Setting;
use App\Models\Aminitie;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Banquet;
use App\Models\Venue;
use Image;
use Illuminate\Support\Facades\File;
class Settings
{

    public static function getSetting($setting_key)
    {
        $settingData = Setting::Select('setting_value')->where("setting_key", $setting_key)->first();
        return $settingData->setting_value;
    }
    public static function getBanquet()
    {
        return $settingData = Banquet::select('id','banquet_name','rate')->where('status',0)->where('is_deleted',0)->get();
    }
    public static function getvenue()
    {
        return $settingData = Venue::select('id','name','price')->where('status',0)->where('is_deleted',0)->get();
    }
    public static function getAminitiese($aminitiese)
    {
        $aminitiese = explode(",", $aminitiese);
        $aminitieseData = Aminitie::Select('id', 'name', 'image')->whereIn("id", $aminitiese)
            ->where('is_deleted', '0')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        return $aminitieseData;
    }

    public static function getFoodMenu($food_menu)
    {
        $food_menu = explode(",", $food_menu);
        $food_menuData = Menu::whereIn("id", $food_menu)
            ->where('is_deleted', '0')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        return $food_menuData;
    }

    public static function getFoodMenuItem($menu_id)
    {
        $foodItemData = MenuItem::where("menu_id", $menu_id)
            ->where('is_deleted', '0')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $variation = [];
        $addon = [];

        foreach ($foodItemData as $item) {
            if ($item['menu_item_type'] == "variation") {
                $variation[] = $item;
            } else {
                $addon[] = $item;
            }
        }

        $aggregatedData = [
            'variation' => $variation,
            'addon' => $addon
        ];

        return $aggregatedData;
    }


    public static function downloadpdf($pdf)
    {
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(500, 10, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        $pdf->setPaper('L', 'landscape');
        return $pdf;
    }
    public static function downloadlandscapepdf($pdf)
    {
        $pdf->setPaper('a4', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(760, 10, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf;
    }
	
	public static function getPunchIn($attendanceData,$staffId,$monthdate, $csvornot = 1){
        $punchInDate = ''; 
        $br  = '<br>';  
        if($csvornot == 0){
            $br  = "\n";
        }     
        foreach($attendanceData as $atttendanceRecord){
            if(($atttendanceRecord->staff_id ==$staffId) && (date('Y-m-d',strtotime($atttendanceRecord->punch_in_date)) ==  date('Y-m-d',strtotime($monthdate))) ){
                $punchInDate = 'Punch-In '.$br.'('.date(\Config::get('constants.dateformat.dmy'),strtotime($atttendanceRecord->punch_in_date)).')';
            }
        }
		return $punchInDate;
	}

    public static function getPunchOut($attendanceData,$staffId,$monthdate, $csvornot = 1){
        $punchOutDate = ''; 
        $br  = '<br>';  
        if($csvornot == 0){
            $br  = "\n";
        }          
        foreach($attendanceData as $atttendanceRecord){
            if(($atttendanceRecord->staff_id ==$staffId) && (date('Y-m-d',strtotime($atttendanceRecord->punch_out_date)) ==  date('Y-m-d',strtotime($monthdate))) ){
                $punchOutDate = 'Punch-Out '.$br.'('.date(\Config::get('constants.dateformat.dmy'),strtotime($atttendanceRecord->punch_out_date)).')';
            }
        }
		return $punchOutDate;
	}
	
	public static function formatDate($date,$format){
		if (strpos($date, '/') !== false) {
			return date($format, strtotime(str_replace('/', '-', $date)));
		} else {
			return date($format, strtotime($date));
		}	
		
	} 

        public static function getEncodeCode($data){
            return  (!empty($data))? substr(str_shuffle("123456789"), 0, 5).$data:'';
        }
        public static function getDecodeCode($encodedCode){
        return  (!empty($encodedCode))? substr($encodedCode,5):'';
        }
        public static function getFormattedDate($date){		
        return (!empty($date)) ? date(\Config::get('constants.dateformat.slashdmyonly'),strtotime($date)):'';
        //App\Helpers\Settings::getFormattedDate($account->created_at)
        }
        public static function getFormattedDatetime($date){		
        return (!empty($date)) ? date(\Config::get('constants.dateformat.slashdmy'),strtotime($date)):'';
        //App\Helpers\Settings::getFormattedDate($account->created_at)
        }

    public static function  custom_format($amount) {
		 return number_format($amount, 2);
        $parts = explode('.', number_format($amount, 2, '.', ''));
        $intPart = $parts[0];
        
        if (strlen($intPart) > 4) {
            $firstPart = substr($intPart, 0, 2);
            $lastPart = substr($intPart, 2);
            $formatted = $firstPart . ',' . $lastPart;
        } else {
            $formatted = $intPart;
        }
    
        return $formatted . '.' . $parts[1];
    }

    public static function downloadcsvfile($data, $fileName)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=$fileName");
        $fp = fopen('php://output', 'w');
        foreach ($data as $row) {
            fputcsv($fp, $row);
            ob_flush();
            flush(); // Push output to browser
        }
        fclose($fp);
        exit;
    }

    public static function uploadimage($request,$fieldname,$pathname){
        $filename = '';
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $originalImagePath = public_path('uploads/staff/original/' . $filename);
            Image::make($image)->save($originalImagePath);
            $sizes = [
                'small' => [100, 100],
                'medium' => [300, 300],
                'large' => [600, 600],
            ];
            foreach ($sizes as $folder => $size) {
                $path = public_path('uploads/staff/' . $folder . '/' . $filename);
                Image::make($image)
                    ->fit($size[0], $size[1])
                    ->save($path);
            }
            return $filename;
    }

    public static function uploadimagenew($request, $fieldname, $pathname, $oldFilename = null){
		$filename = '';
		if ($request->hasFile($fieldname)) {
			$ds = DIRECTORY_SEPARATOR;
			$folderpath = 'uploads' . $ds . $pathname . $ds;
			$image = $request->file($fieldname);
			$filename = time() . '.' . $image->getClientOriginalExtension();

			// Ensure directories exist
			$folders = ['original', 'small', 'medium', 'large'];
			foreach ($folders as $folder) {
				$dir = public_path($folderpath . $folder . $ds);
				if (!File::exists($dir)) {
					File::makeDirectory($dir, 0755, true);
				}
			}
			
			// Delete old files if old filename is provided
			if ($oldFilename) {
				foreach ($folders as $folder) {
					$oldFilePath = public_path($folderpath . $folder . $ds . $oldFilename);
					if (File::exists($oldFilePath)) {
						File::delete($oldFilePath);
					}
				}
			}

			// Save original and resized images
			Image::make($image)->save(public_path($folderpath . 'original' . $ds . $filename));

			$sizes = [
				'small' => [100, 100],
				'medium' => [300, 300],
				'large' => [600, 600],
			];
			foreach ($sizes as $folder => $size) {
				Image::make($image)
					->fit($size[0], $size[1])
					->save(public_path($folderpath . $folder . $ds . $filename));
			}
		}

		return $filename;
	}
    
    
}
