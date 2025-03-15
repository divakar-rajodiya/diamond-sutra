<?php

namespace App\Models\Admin;

use App\Http\Controllers\WelcomeController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use \App\Lib\General;
use Illuminate\Support\Facades\DB;

class SolitaireData extends Model
{
    protected $table = 'solitaire_data';
    protected $fillable = [];
    protected $hidden = [];

    public static function update_data($apiName, $data, $dataType)
    {
        try {
            $res = General::error_res('Something went wrong');
            $sol = new self;

            return General::success_res("$apiName Data stored in chunks successfully");
        } catch (\Exception $e) {
            \Log::info($e);
            return General::error_res('Something went wrong');
        }
    }

    public static function update_parishi_data($apiData)
    {
        $res = General::error_res('Something went wrong with parishi api');
        try {
            $settings = app('settings');
            // $apiData = '[
            //             {
            //                 "RefNo": "255099",
            //                 "Availability": "AVAILABLE",
            //                 "CutName": "OV",
            //                 "Weight": 1.500,
            //                 "ColorCode": "L",
            //                 "ClarityName": "SI1",
            //                 "PropCode": "-",
            //                 "PolishName": "EX",
            //                 "SymName": "EX",
            //                 "FLName": "NONE",
            //                 "FLColor": null,
            //                 "Diameter": "8.73*6.17*3.99",
            //                 "CertName": "GIA",
            //                 "CertNo": "1478726551",
            //                 "Treatment": "",
            //                 "RapRate": 3300.0,
            //                 "RapDown": -55.05,
            //                 "Rate": 1483.35,
            //                 "FancyColor": null,
            //                 "FancyIntensity": null,
            //                 "FancyOvertone": null,
            //                 "TotDepth": 64.80,
            //                 "Table": 59.00,
            //                 "BGM": "-",
            //                 "GirdleMinMs": 0.00,
            //                 "GirdleMaxMs": 0.00,
            //                 "GirdlePer": 0.00,
            //                 "GirdleCondition": "",
            //                 "Culet": "N",
            //                 "CuletCondition": "",
            //                 "CH": 17.40,
            //                 "CA": 40.50,
            //                 "PavilionPer": 38.90,
            //                 "PA": 38.00,
            //                 "LaserInscription": "",
            //                 "Comments": "Additional clouds are not shown. Pinpoints are not shown.",
            //                 "Location": "INDIA",
            //                 "KeyToSymbols": "FeatherCloudCrystalCavityIndented NaturalNeedle",
            //                 "ColorShade": "YL",
            //                 "Strln": 0.00,
            //                 "BIT": "BT1",
            //                 "BIC": "BC0",
            //                 "WIT": "NV",
            //                 "WIC": "WC2",
            //                 "ImagePath": "https://videop.co.in/imaged/255099/255099.jpg",
            //                 "VideoPath": "https://videop.co.in/imaged/255099/255099.mp4",
            //                 "CertificatePath": "https://www.parishidiamond.com/pages/CertificatePDF?reportno=255099|1.500",
            //                 "EyeClean": "0",
            //                 "Luster": "EX",
            //                 "Ratio": 1.41,
            //                 "HA": "NO",
            //                 "IP": "C1",
            //                 "Girdle": "THK-ETK",
            //                 "CO": "VS",
            //                 "GO": "VS",
            //                 "PO": "VS",
            //                 "TO": "NN"
            //             },
            //             {
            //                 "RefNo": "257934",
            //                 "Availability": "AVAILABLE",
            //                 "CutName": "RD",
            //                 "Weight": 0.800,
            //                 "ColorCode": "L",
            //                 "ClarityName": "VVS2",
            //                 "PropCode": "EX",
            //                 "PolishName": "EX",
            //                 "SymName": "EX",
            //                 "FLName": "NONE",
            //                 "FLColor": null,
            //                 "Diameter": "5.86-5.89*3.73",
            //                 "CertName": "GIA",
            //                 "CertNo": "2467203942",
            //                 "Treatment": "",
            //                 "RapRate": 1900.0,
            //                 "RapDown": -49.17,
            //                 "Rate": 965.77,
            //                 "FancyColor": null,
            //                 "FancyIntensity": null,
            //                 "FancyOvertone": null,
            //                 "TotDepth": 63.40,
            //                 "Table": 56.00,
            //                 "BGM": "-",
            //                 "GirdleMinMs": 3.39,
            //                 "GirdleMaxMs": 4.00,
            //                 "GirdlePer": 3.50,
            //                 "GirdleCondition": "",
            //                 "Culet": "N",
            //                 "CuletCondition": "",
            //                 "CH": 16.50,
            //                 "CA": 36.50,
            //                 "PavilionPer": 43.50,
            //                 "PA": 41.00,
            //                 "LaserInscription": "",
            //                 "Comments": null,
            //                 "Location": "INDIA",
            //                 "KeyToSymbols": "Pinpoint Cloud",
            //                 "ColorShade": "MT1",
            //                 "Strln": 55.00,
            //                 "BIT": "BT0",
            //                 "BIC": "BC0",
            //                 "WIT": "NV",
            //                 "WIC": "NV",
            //                 "ImagePath": "https://videop.co.in/imaged/257934/257934.jpg",
            //                 "VideoPath": "https://videop.co.in/imaged/257934/257934.mp4",
            //                 "CertificatePath": "https://www.parishidiamond.com/pages/CertificatePDF?reportno=257934|0.800",
            //                 "EyeClean": "0",
            //                 "Luster": "EX",
            //                 "Ratio": 0.00,
            //                 "HA": "NO",
            //                 "IP": "NN",
            //                 "Girdle": "MED-STK",
            //                 "CO": "NN",
            //                 "GO": "NN",
            //                 "PO": "NN",
            //                 "TO": "NN"
            //             }
            //             ]';
            // $apiData = json_decode($apiData,true);
            $api_name = 'parishi';
            self::where('apiName', $api_name)->delete();

            foreach ($apiData as $data) {
                $check = false;
                $displayShape = WelcomeController::changeShapeValue($data['CutName']);
                $displayCut = WelcomeController::changeCutValue($data['PropCode']);
                $displayPol = WelcomeController::changePolishValue($data['PolishName']);
                $displayFl = WelcomeController::changeFlourescenceValue($data['FLName']);

                // filter section
                if (
                    isset($data['CertificatePath']) &&
                    isset($displayShape)
                ) {
                    if (
                        $data['CertificatePath'] != "" &&
                        in_array($data['CertName'], ['GIA', 'IGI']) &&
                        in_array($data['Availability'], ['S', 'I', 'AVAILABLE', 'Available', 'Avail']) &&
                        in_array($data['Location'], ['India', 'INDIA', 'IND', 'Ind', 'IN']) &&
                        in_array($data['ColorCode'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']) &&
                        in_array($displayShape, ['Round', 'Cushion', 'Emerald', 'Heart', 'Marquise', 'Oval', 'Pear', 'Princess', 'Radiant', 'Trilliant']) &&
                        $data['CertNo'] !== ""
                    ) {
                        $check = true;
                    }
                }



                if ($check) {
                    $newObj = new self;
                    $newObj->RefNo = $data['RefNo'];
                    $newObj->Weight = $data['Weight'];
                    $newObj->Diameter = $data['Diameter'];
                    $newObj->CertNo = $data['CertNo'];
                    $newObj->Table = $data['Table'];
                    $newObj->Location = 'India';
                    $newObj->apiName = $api_name;
                    $newObj->Shape = $data['CutName'];
                    $newObj->Color = $data['ColorCode'];
                    $newObj->Clarity = $data['ClarityName'];
                    $newObj->Cut = $data['PropCode'];
                    $newObj->Cert = $data['CertName'];
                    $newObj->TopDepth = $data['TotDepth'];
                    $newObj->Pol = $data['PolishName'];
                    $newObj->Sym = $data['SymName'];
                    $newObj->FL = $data['FLName'];
                    $newObj->status = 'Available';
                    $newObj->CertLink = $data['CertificatePath'];

                    $newObj->ImageLink = config('constant.DEFAULT_SOLITAIRE_PATH').'/'.$displayShape.'.jpg';
                    if (isset($data['ImagePath'])) {
                        if ($data['ImagePath'] != "" && $data['ImagePath'] != "-") {
                            $newObj->ImageLink = $data['ImagePath'];
                        }
                    }
                    $newObj->VideoLink = null;
                    if (isset($data['VideoPath'])) {
                        if ($data['VideoPath'] != "") {
                            $newObj->VideoLink = $data['VideoPath'];
                        }
                    }
                    $newObj->CanvaLink = null;

                    $newObj->CAmount = $data['Rate'];


                    $newObj->DisplayShape = $displayShape;
                    $newObj->DisplayCut = $displayCut;
                    $newObj->DisplayPol = $displayPol;
                    $newObj->DisplayFl = $displayFl;

                    $newObj->Girdle = $data['Girdle'] ?? null;
                    $newObj->Culet = $data['Culet'] ?? null;
                    $price = round(General::addCommission(($newObj->CAmount * $newObj->Weight) * $settings['usd_to_inr_rate']));
                    
                    $gst = round(($price * 3) / 100);
                    $buy_price = round($gst + $price);
                    $newObj->Price = $price;
                    $newObj->gst = $gst;
                    $newObj->product_buy_price = $buy_price;
                    
                    if ($newObj->save()) {
                        echo "<br> inserted $newObj->RefNo";
                        $res = General::success_res('Success');
                    }
                }
            }

            return $res;
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    public static function update_starrays_data($apiData)
    {
        $res = General::error_res('Something went wrong with parishi api');
        try {
            $settings = app('settings');
           
            $api_name = 'starrays';
            self::where('apiName', $api_name)->delete();

            foreach ($apiData as $data) {
                $check = false;
                $displayShape = WelcomeController::changeShapeValue($data['Shape']);
                $displayCut = WelcomeController::changeCutValue($data['Cut']);
                $displayPol = WelcomeController::changePolishValue($data['Pol']);
                $displayFl = WelcomeController::changeFlourescenceValue($data['FL']);

                // filter section
                if (
                    isset($data['CertLink']) &&
                    isset($displayShape)
                ) {
                    if (
                        $data['CertLink'] != "" &&
                        in_array($data['Cert'], ['GIA', 'IGI']) &&
                        in_array($data['Status'], ['S', 'I', 'AVAILABLE', 'Available', 'Avail']) &&
                        in_array($data['Location'], ['India', 'INDIA', 'IND', 'Ind', 'IN']) &&
                        in_array($data['Color'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']) &&
                        in_array($displayShape, ['Round', 'Cushion', 'Emerald', 'Heart', 'Marquise', 'Oval', 'Pear', 'Princess', 'Radiant', 'Trilliant']) &&
                        $data['CertNo'] !== ""
                    ) {
                        $check = true;
                    }
                }



                if ($check) {
                    $newObj = new self;
                    $newObj->RefNo = $data['RefNo'];
                    $newObj->Weight = $data['Weight'];
                    $newObj->Diameter = $data['Diameter'];
                    $newObj->CertNo = $data['CertNo'];
                    $newObj->Table = $data['Table'];
                    $newObj->Location = 'India';
                    $newObj->apiName = $api_name;
                    $newObj->Shape = $data['Shape'];
                    $newObj->Color = $data['Color'];
                    $newObj->Clarity = $data['Clarity'];
                    $newObj->Cut = $data['Cut'];
                    $newObj->Cert = $data['Cert'];
                    $newObj->TopDepth = $data['TopDepth'];
                    $newObj->Pol = $data['Pol'];
                    $newObj->Sym = $data['Sym'];
                    $newObj->FL = $data['FL'];
                    $newObj->status = 'Available';
                    $newObj->CertLink = $data['CertLink'];

                    $newObj->ImageLink = config('constant.DEFAULT_SOLITAIRE_PATH').'/'.$displayShape.'.jpg';
                    if (isset($data['ImageLink'])) {
                        if ($data['ImageLink'] != "" && $data['ImageLink'] != "-") {
                            $newObj->ImageLink = $data['ImageLink'];
                        }
                    }
                    $newObj->VideoLink = null;
                    if (isset($data['VideoLink'])) {
                        if ($data['VideoLink'] != "") {
                            $newObj->VideoLink = $data['VideoLink'];
                        }
                    }
                    $newObj->CanvaLink = null;

                    $newObj->CAmount = $data['CAmount'];


                    $newObj->DisplayShape = $displayShape;
                    $newObj->DisplayCut = $displayCut;
                    $newObj->DisplayPol = $displayPol;
                    $newObj->DisplayFl = $displayFl;

                    $newObj->Girdle = $data['Girdle'] ?? null;
                    $newObj->Culet = $data['Culet'] ?? null;
                    $price = round(General::addCommission(($newObj->CAmount * $settings['usd_to_inr_rate'])));
                    $gst = round(($price * 3) / 100);
                    $buy_price = round($gst + $price);
                    $newObj->Price = $price;
                    $newObj->gst = $gst;
                    $newObj->product_buy_price = $buy_price;
                    if ($newObj->save()) {
                        echo "<br> inserted $newObj->RefNo";
                        $res = General::success_res('Success');
                    }
                }
            }

            return $res;
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    public static function update_sanghvi_data($apiData)
    {
        $res = General::error_res('Something went wrong with parishi api');
        try {
            $settings = app('settings');
           
            $api_name = 'sanghvi';
            self::where('apiName', $api_name)->delete();

            foreach ($apiData as $data) {
                $check = false;
                $displayShape = WelcomeController::changeShapeValue($data['Shape']);
                $displayCut = WelcomeController::changeCutValue($data['Cut']);
                $displayPol = WelcomeController::changePolishValue($data['Polish']);
                $displayFl = WelcomeController::changeFlourescenceValue($data['Flour']);

                // filter section
                if (
                    isset($data['Certi Img']) &&
                    isset($displayShape)
                ) {
                    if (
                        $data['Certi Img'] != "" &&
                        in_array($data['Certificate'], ['GIA', 'IGI']) &&
                        in_array($data['AVAILABILITY'], ['S', 'I', 'AVAILABLE', 'Available', 'Avail']) &&
                        in_array($data['Country'], ['India', 'INDIA', 'IND', 'Ind', 'IN']) &&
                        in_array($data['Color'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']) &&
                        in_array($displayShape, ['Round', 'Cushion', 'Emerald', 'Heart', 'Marquise', 'Oval', 'Pear', 'Princess', 'Radiant', 'Trilliant']) &&
                        $data['Cert No'] !== ""
                    ) {
                        $check = true;
                    }
                }

                if ($check) {
                    $newObj = new self;
                    $newObj->RefNo = $data['Stock No'];
                    $newObj->Weight = $data['Weight'];
                    $newObj->Diameter = $data['Measurment'];
                    $newObj->CertNo = $data['Cert No'];
                    $newObj->Table = $data['Table %'];
                    $newObj->Location = 'India';
                    $newObj->apiName = $api_name;
                    $newObj->Shape = $data['Shape'];
                    $newObj->Color = $data['Color'];
                    $newObj->Clarity = $data['Clarity'];
                    $newObj->Cut = $data['Cut'];
                    $newObj->Cert = $data['Certificate'];
                    $newObj->TopDepth = $data['Depth %'];
                    $newObj->Pol = $data['Polish'];
                    $newObj->Sym = $data['Symm'];
                    $newObj->FL = $data['Flour'];
                    $newObj->status = 'Available';
                    $newObj->CertLink = $data['Certi Img'];

                    $newObj->ImageLink = config('constant.DEFAULT_SOLITAIRE_PATH').'/'.$displayShape.'.jpg';
                    if (isset($data['Diam Img'])) {
                        if ($data['Diam Img'] != "" && $data['Diam Img'] != "-") {
                            $newObj->ImageLink = $data['Diam Img'];
                        }
                    }
                    $newObj->VideoLink = null;
                    if (isset($data['Diam Video'])) {
                        if ($data['Diam Video'] != "") {
                            $newObj->VideoLink = $data['Diam Video'];
                        }
                    }
                    $newObj->CanvaLink = null;
                    $newObj->CAmount = $data['Net Amount'];

                    $newObj->DisplayShape = $displayShape;
                    $newObj->DisplayCut = $displayCut;
                    $newObj->DisplayPol = $displayPol;
                    $newObj->DisplayFl = $displayFl;

                    $newObj->Girdle = $data['Girdle %'] ?? null;
                    $newObj->Culet = $data['Culet'] ?? null;
                    $price = round(General::addCommission(($newObj->CAmount * $settings['usd_to_inr_rate'])));

                    $gst = round(($price * 3) / 100);
                    $buy_price = round($gst + $price);
                    $newObj->Price = $price;
                    $newObj->gst = $gst;
                    $newObj->product_buy_price = $buy_price;
                    if ($newObj->save()) {
                        echo "<br> inserted $newObj->RefNo";
                        $res = General::success_res('Success');
                    }
                }
            }

            return $res;
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    public static function update_asianstars_data($apiData)
    {
        $res = General::error_res('Something went wrong with parishi api');
        try {
            $settings = app('settings');
           
            $api_name = 'asianstars';
            self::where('apiName', $api_name)->delete();

            foreach ($apiData as $data) {
                $check = false;
                $displayShape = WelcomeController::changeShapeValue($data['SHAPE']);
                $displayCut = WelcomeController::changeCutValue($data['FINAL_CUT']);
                $displayPol = WelcomeController::changePolishValue($data['POLISH']);
                $displayFl = WelcomeController::changeFlourescenceValue($data['FLUOR_INT']);

                // filter section
                if (
                    isset($data['CERTY_PATH']) &&
                    isset($displayShape)
                ) {
                    if (
                        $data['CERTY_PATH'] != "" &&
                        in_array($data['LAB'], ['GIA', 'IGI']) &&
                        in_array($data['STATUS'], ['S', 'I', 'AVAILABLE', 'Available', 'Avail']) &&
                        in_array($data['LOC_CD'], ['India', 'INDIA', 'IND', 'Ind', 'IN']) &&
                        in_array($data['COLOR'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']) &&
                        in_array($displayShape, ['Round', 'Cushion', 'Emerald', 'Heart', 'Marquise', 'Oval', 'Pear', 'Princess', 'Radiant', 'Trilliant']) &&
                        $data['REPORT_NO'] !== ""
                    ) {
                        $check = true;
                    }
                }



                if ($check) {
                    $newObj = new self;
                    $newObj->RefNo = $data['STONE_ID'];
                    $newObj->Weight = $data['WEIGHT'];
                    $newObj->Diameter = $data['MEASUREMENTS'];
                    $newObj->CertNo = $data['REPORT_NO'];
                    $newObj->Table = $data['TABLE_PER'];
                    $newObj->Location = 'India';
                    $newObj->apiName = $api_name;
                    $newObj->Shape = $data['SHAPE'];
                    $newObj->Color = $data['COLOR'];
                    $newObj->Clarity = $data['CLARITY'];
                    $newObj->Cut = $data['FINAL_CUT'];
                    $newObj->Cert = $data['LAB'];
                    $newObj->TopDepth = $data['DEPTH_PER'];
                    $newObj->Pol = $data['POLISH'];
                    $newObj->Sym = $data['SYMMETRY'];
                    $newObj->FL = $data['FLUOR_INT'];
                    $newObj->status = 'Available';
                    $newObj->CertLink = $data['CERTY_PATH'];

                    $newObj->ImageLink = config('constant.DEFAULT_SOLITAIRE_PATH').'/'.$displayShape.'.jpg';
                    // if (isset($data['IMAGE_PATH'])) {
                    //     if ($data['IMAGE_PATH'] != "" && $data['IMAGE_PATH'] != "-") {
                    //         $newObj->ImageLink = $data['IMAGE_PATH'];
                    //     }
                    // }
                    $newObj->VideoLink = null;
                   
                    $newObj->CanvaLink = null;

                    $newObj->CAmount = $data['ASK_AMT'];


                    $newObj->DisplayShape = $displayShape;
                    $newObj->DisplayCut = $displayCut;
                    $newObj->DisplayPol = $displayPol;
                    $newObj->DisplayFl = $displayFl;

                    $newObj->Girdle = $data['GIRDLE'] ?? null;
                    $newObj->Culet = $data['CULET'] ?? null;
                    $price = round(General::addCommission(($newObj->CAmount * $settings['usd_to_inr_rate'])));
                  
                    $newObj->Price = $price;
                    $gst = round(($price * 3) / 100);
                    $buy_price = round($gst + $price);
                    $newObj->gst = $gst;
                    $newObj->product_buy_price = $buy_price;
                    if ($newObj->save()) {
                        echo "<br> inserted $newObj->RefNo";
                        $res = General::success_res('Success');
                    }
                }
            }

            return $res;
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    public static function update_dharam_data($apiData)
    {
        $res = General::error_res('Something went wrong with dharam api');
        try {
            $settings = app('settings');
            // $apiData = '[
            //     {
            //         "Shape": "ROUND",
            //         "Size": 0.310,
            //         "Color": "D",
            //         "Clarity": "VS1",
            //         "Cut": "EX",
            //         "Polish": "EX",
            //         "Sym": "EX",
            //         "Flour": "FAINT",
            //         "M1": 4.44,
            //         "M2": 4.41,
            //         "M3": 2.63,
            //         "Depth": 59.4,
            //         "Table": 61.00,
            //         "Ref": "24D019005",
            //         "ReportNo": "1507184841",
            //         "Detail": "VG",
            //         "Cert": "GIA",
            //         "Disc": 44.44,
            //         "Rate": 361.70,
            //         "Location": "BE",
            //         "CertNo": "100760385675",
            //         "Girdle": "MED",
            //         "Natts": "No",
            //         "TableInclusion": "50% on table",
            //         "Milky": "No",
            //         "EyeClean": "Yes",
            //         "Browness": "No",
            //         "Status": "Avail",
            //         "RapRate": 2100.00,
            //         "CertPDFURL": "https://assets.3dvirtualdiamond.com/certificate/4952A4-101?u=KB6dqemWboFhaI2GX5fu1tJE9z5ahAilxEXv1LDHl2zcDAcC1g+0D4Xddhkusing2017VcrBHHLV",
            //         "ImageURL": "https://assets.3dvirtualdiamond.com/image/4952A4-101?u=KB6dqemWboFhaI2GX5fu1tJE9z5ahAilxEXv1LDHl2zcDAcC1g+0D4Xddhkusing2017VcrBHHLV",
            //         "VideoURL": "https://assets.3dvirtualdiamond.com/video/24D019005?u=KB6dqemWboFhaI2GX5fu1tJE9z5ahAilxEXv1LDHl2zcDAcC1g+0D4Xddhkusing2017VcrBHHLV",
            //         "Comment": "Crystal- Feather- Needle",
            //         "LaserInscription": true,
            //         "PavDepth": 43.00,
            //         "CrAng": 33.00,
            //         "GirdlePer": 3.50,
            //         "PavAngle": 40.80,
            //         "GirdleCondition": "Faceted",
            //         "CrHeight": 13.00,
            //         "StarLength": 50.00,
            //         "LowerHalf": 75.00,
            //         "ImageVideoStatus": "Image-Video",
            //         "Price/Carat": 1166.76,
            //         "ColorDescript": "",
            //         "LastChgDate": "2024-09-09T19:57:33.593",
            //         "FCColor": "",
            //         "FCIntensity": "",
            //         "FCOvertone": "",
            //         "Feed": 1
            //     },{
            //         "Shape": "ROUND",
            //         "Size": 0.400,
            //         "Color": "E",
            //         "Clarity": "VVS2",
            //         "Cut": "EX",
            //         "Polish": "EX",
            //         "Sym": "EX",
            //         "Flour": "FAINT",
            //         "M1": 4.77,
            //         "M2": 4.74,
            //         "M3": 2.93,
            //         "Depth": 61.6,
            //         "Table": 59.00,
            //         "Ref": "24D019013",
            //         "ReportNo": "6501184842",
            //         "Detail": "No",
            //         "Cert": "GIA",
            //         "Disc": 44.94,
            //         "Rate": 506.55,
            //         "Location": "IN",
            //         "CertNo": "100760409167",
            //         "Girdle": "MED TO STK",
            //         "Natts": "Minor",
            //         "TableInclusion": "75% on table",
            //         "Milky": "No",
            //         "EyeClean": "Yes",
            //         "Browness": "No",
            //         "Status": "Avail",
            //         "RapRate": 2300.00,
            //         "CertPDFURL": "https://assets.3dvirtualdiamond.com/certificate/4956A4-172?u=KB6dqemWboFhaI2GX5fu1tJE9z5ahAilxEXv1LDHl2zcDAcC1g+0D4Xddhkusing2017VcrBHHLV",
            //         "ImageURL": "",
            //         "VideoURL": "",
            //         "Comment": "Cloud- Pinpoint",
            //         "LaserInscription": true,
            //         "PavDepth": 44.00,
            //         "CrAng": 34.00,
            //         "GirdlePer": 4.00,
            //         "PavAngle": 41.60,
            //         "GirdleCondition": "Faceted",
            //         "CrHeight": 13.50,
            //         "StarLength": 50.00,
            //         "LowerHalf": 75.00,
            //         "ImageVideoStatus": "NoImage",
            //         "Price/Carat": 1266.38,
            //         "ColorDescript": "",
            //         "LastChgDate": "2024-09-13T05:05:05.353",
            //         "FCColor": "",
            //         "FCIntensity": "",
            //         "FCOvertone": "",
            //         "Feed": 1
            //     }
            // ]';
            // $apiData = json_decode($apiData,true);
            $api_name = 'dharam';

            self::where('apiName', $api_name)->delete();

            // $columns = Schema::getColumnListing('solitaire_data');
            // dd($columns);
            foreach ($apiData as $data) {
                $check = false;
                $displayShape = WelcomeController::changeShapeValue($data['Shape']);
                $displayCut = WelcomeController::changeCutValue($data['Cut']);
                $displayPol = WelcomeController::changePolishValue($data['Polish']);
                $displayFl = WelcomeController::changeFlourescenceValue($data['Flour']);

                // filter section
                if (
                    isset($data['CertPDFURL']) &&
                    isset($displayShape)
                ) {
                    if (
                        $data['CertPDFURL'] != "" &&
                        in_array($data['Cert'], ['GIA', 'IGI']) &&
                        in_array($data['Status'], ['S', 'I', 'AVAILABLE', 'Available', 'Avail']) &&
                        in_array($data['Location'], ['India', 'INDIA', 'IND', 'Ind', 'IN']) &&
                        in_array($data['Color'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']) &&
                        in_array($displayShape, ['Round', 'Cushion', 'Emerald', 'Heart', 'Marquise', 'Oval', 'Pear', 'Princess', 'Radiant', 'Trilliant']) &&
                        $data['CertNo'] !== ""
                    ) {
                        $check = true;
                    }
                }



                if ($check) {
                    $newObj = new self;
                    $newObj->RefNo = $data['Ref'];
                    $newObj->Weight = $data['Size'];
                    $newObj->Diameter = $data['M1'] . '*' . $data['M2'] . '*' . $data['M3'];
                    $newObj->CertNo = $data['CertNo'];
                    $newObj->Table = $data['Table'];
                    $newObj->Location = 'India';
                    $newObj->apiName = $api_name;
                    $newObj->Shape = $data['Shape'];
                    $newObj->Color = $data['Color'];
                    $newObj->Clarity = $data['Clarity'];
                    $newObj->Cut = $data['Cut'];
                    $newObj->Cert = $data['Cert'];
                    $newObj->TopDepth = $data['Depth'];
                    $newObj->Pol = $data['Polish'];
                    $newObj->Sym = $data['Sym'];
                    $newObj->FL = $data['Flour'];
                    $newObj->status = 'Available';
                    $newObj->CertLink = $data['CertPDFURL'];

                    $newObj->ImageLink = config('constant.DEFAULT_SOLITAIRE_PATH').'/'.$displayShape.'.jpg';
                    if (isset($data['ImageURL'])) {
                        if ($data['ImageURL'] != "") {
                            $newObj->ImageLink = $data['ImageURL'];
                        }
                    }
                    $newObj->VideoLink = null;
                    if (isset($data['VideoURL'])) {
                        if ($data['VideoURL'] != "") {
                            $newObj->CanvaLink = $data['VideoURL'];
                        }
                    }

                    $newObj->CAmount = $data['Rate'];


                    $newObj->DisplayShape = $displayShape;
                    $newObj->DisplayCut = $displayCut;
                    $newObj->DisplayPol = $displayPol;
                    $newObj->DisplayFl = $displayFl;

                    $newObj->Girdle = $data['Girdle'] ?? null;
                    $newObj->Culet = $data['Culet'] ?? null;
                    $price = round(General::addCommission(($newObj->CAmount * $settings['usd_to_inr_rate'])));

                    $gst = round(($price * 3) / 100);
                    $buy_price = round($gst + $price);
                    $newObj->Price = $price;
                    $newObj->gst = $gst;
                    $newObj->product_buy_price = $buy_price;
                    if ($newObj->save()) {

                        echo "<br> inserted $newObj->RefNo";
                        $res = General::success_res('Success');
                    }
                }
            }

            return $res;
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }

    public static function filter_solitaire($param)
    {
        // dd($param);
        $solitaireQuery = self::where('status', 'Available');

        // Apply filters based on request parameters
        if (isset($param['cut']) && is_array($param['cut'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Cut', $param['cut']);
        }

        if (isset($param['color']) && is_array($param['color'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Color', $param['color']);
        }

        if (isset($param['clarity']) && is_array($param['clarity'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Clarity', $param['clarity']);
        }

        if (isset($param['polish']) && is_array($param['polish'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Pol', $param['polish']);
        }

        if (isset($param['fl']) && is_array($param['fl'])) {
            $solitaireQuery = $solitaireQuery->whereIn('FL', $param['fl']);
        }

        if (isset($param['lab']) && is_array($param['lab'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Cert', $param['lab']);
        }

        if (isset($param['shape']) && is_array($param['shape'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Shape', $param['shape']);
        }

        if (isset($param['sym']) && is_array($param['sym'])) {
            $solitaireQuery = $solitaireQuery->whereIn('Sym', $param['sym']);
        }

        if (isset($param['carat'])) {
            $solitaireQuery = $solitaireQuery->whereBetween('Weight', [$param['carat']['min'], $param['carat']['max']]);
        }

        if (isset($param['price'])) {
            $solitaireQuery = $solitaireQuery->whereBetween('Price', [$param['price']['min'], $param['price']['max']]);
        }

        if (isset($param['table'])) {
            $solitaireQuery = $solitaireQuery->whereBetween('Table', [$param['table']['min'], $param['table']['max']]);
        }

        if (isset($param['depth'])) {
            $solitaireQuery = $solitaireQuery->whereBetween('TopDepth', [$param['depth']['min'], $param['depth']['max']]);
        }

        // Sorting the query based on `orderBy` and `orderByField`
        if (isset($param['orderByField']) && isset($param['orderBy'])) {
            $solitaireQuery = $solitaireQuery->orderBy($param['orderByField'], $param['orderBy']);
        }

        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $count = $solitaireQuery->count();
        $solitaires = $solitaireQuery->skip($start)->take($len)->get()->toArray();
        // dd($solitaires);
        $res = \General::success_res();
        $res['data'] = $solitaires;
        $res['start'] = $start;
        $res['total_record'] = $count;
        return $res;
    }

    public static function filter_and_pair_solitaire($param)
    {
        // $solitaireQuery = self::from('solitaire_data as s1')->where('s1.status', 'Available'); // Use alias for self join

        // // Apply filters based on request parameters
        // if (isset($param['cut']) && is_array($param['cut'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Cut', $param['cut']);
        // }

        // if (isset($param['color']) && is_array($param['color'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Color', $param['color']);
        // }

        // if (isset($param['clarity']) && is_array($param['clarity'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Clarity', $param['clarity']);
        // }

        // if (isset($param['polish']) && is_array($param['polish'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Pol', $param['polish']);
        // }

        // if (isset($param['fl']) && is_array($param['fl'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.FL', $param['fl']);
        // }

        // if (isset($param['lab']) && is_array($param['lab'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Cert', $param['lab']);
        // }

        // if (isset($param['shape']) && is_array($param['shape'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Shape', $param['shape']);
        // }

        // if (isset($param['sym']) && is_array($param['sym'])) {
        //     $solitaireQuery = $solitaireQuery->whereIn('s1.Sym', $param['sym']);
        // }

        // if (isset($param['carat'])) {
        //     $solitaireQuery = $solitaireQuery->whereBetween('s1.Weight', [$param['carat']['min'], $param['carat']['max']]);
        // }

        // if (isset($param['price'])) {
        //     $solitaireQuery = $solitaireQuery->whereBetween('s1.Price', [$param['price']['min'], $param['price']['max']]);
        // }

        // if (isset($param['table'])) {
        //     $solitaireQuery = $solitaireQuery->whereBetween('s1.Table', [$param['table']['min'], $param['table']['max']]);
        // }

        // if (isset($param['depth'])) {
        //     $solitaireQuery = $solitaireQuery->whereBetween('s1.TopDepth', [$param['depth']['min'], $param['depth']['max']]);
        // }

        // if (isset($param['orderByField']) && isset($param['orderBy'])) {
        //     $solitaireQuery = $solitaireQuery->orderBy($param['orderByField'], $param['orderBy']);
        // }

        // // Pagination
        // $len = $param['itemPerPage'];
        // $start = ($param['currentPage'] - 1) * $len;

        // // Self-join to find pairs
        // $pairedQuery = $solitaireQuery->join('solitaire_data as s2', function ($join) {
        //     $join->on('s1.Shape', '=', 's2.Shape')
        //         ->on('s1.Clarity', '=', 's2.Clarity')
        //         ->on('s1.DisplayCut', '=', 's2.DisplayCut')
        //         ->on('s1.Color', '=', 's2.Color')
        //         ->whereRaw('ABS(s1.Weight - s2.Weight) <= 0.1')
        //         ->whereColumn('s1.RefNo', '!=', 's2.RefNo');  // Ensure not pairing the same diamond
        // })
        //     ->select(
        //         's1.*',
        //         's2.RefNo as paired_RefNo',
        //         's2.Weight as paired_Weight',
        //         's2.Price as paired_Price',
        //         's2.Shape as paired_Shape',
        //         's2.Clarity as paired_Clarity'
        //     )
        //     ->skip($start)
        //     ->take($len)
        //     ->get();

        // $pairs = [];
        // foreach ($pairedQuery as $record) {
        //     $pair = [];
        //     // First diamond
        //     $pair[0] = [
        //         'RefNo' => $record->RefNo,
        //         'Weight' => $record->Weight,
        //         'Diameter' => $record->Diameter,
        //         'CertNo' => $record->CertNo,
        //         'Table' => $record->Table,
        //         'Location' => $record->Location,
        //         'apiName' => $record->apiName,
        //         'Shape' => $record->Shape,
        //         'Color' => $record->Color,
        //         'Clarity' => $record->Clarity,
        //         'Cut' => $record->Cut,
        //         'TopDepth' => $record->TopDepth,
        //         'Pol' => $record->Pol,
        //         'Sym' => $record->Sym,
        //         'FL' => $record->FL,
        //         'Status' => $record->Status,
        //         'CertLink' => $record->CertLink,
        //         'ImageLink' => $record->ImageLink,
        //         'VideoLink' => $record->VideoLink,
        //         'CanvaLink' => $record->CanvaLink,
        //         'CAmount' => $record->CAmount,
        //         'DisplayShape' => $record->DisplayShape,
        //         'DisplayCut' => $record->DisplayCut,
        //         'DisplayPol' => $record->DisplayPol,
        //         'DisplayFl' => $record->DisplayFl,
        //         'Girdle' => $record->Girdle,
        //         'Culet' => $record->Culet,
        //         'Price' => $record->Price,
        //     ];

        //     // Paired diamond
        //     $pair[1] = [
        //         'RefNo' => $record->paired_RefNo,
        //         'Weight' => $record->paired_Weight,
        //         'Diameter' => $record->paired_Diameter,
        //         'CertNo' => $record->paired_CertNo,
        //         'Table' => $record->paired_Table,
        //         'Location' => $record->paired_Location,
        //         'apiName' => $record->paired_apiName,
        //         'Shape' => $record->paired_Shape,
        //         'Color' => $record->paired_Color,
        //         'Clarity' => $record->paired_Clarity,
        //         'Cut' => $record->paired_Cut,
        //         'TopDepth' => $record->paired_TopDepth,
        //         'Pol' => $record->paired_Pol,
        //         'Sym' => $record->paired_Sym,
        //         'FL' => $record->paired_FL,
        //         'Status' => $record->paired_Status,
        //         'CertLink' => $record->paired_CertLink,
        //         'ImageLink' => $record->paired_ImageLink,
        //         'VideoLink' => $record->paired_VideoLink,
        //         'CanvaLink' => $record->paired_CanvaLink,
        //         'CAmount' => $record->paired_CAmount,
        //         'DisplayShape' => $record->paired_DisplayShape,
        //         'DisplayCut' => $record->paired_DisplayCut,
        //         'DisplayPol' => $record->paired_DisplayPol,
        //         'DisplayFl' => $record->paired_DisplayFl,
        //         'Girdle' => $record->paired_Girdle,
        //         'Culet' => $record->paired_Culet,
        //         'Price' => $record->paired_Price,
        //     ];

        //     $pairs[] = $pair;
        // }

        // $res = \General::success_res();
        // $res['data'] = $pairs;
        // $res['total_record'] = $pairedQuery->count();  // Count total pairs found
        // $res['start'] = $start;

        // dd($res);
        // return $res;



    }

    public static function getPairdData()
    {
        $diamondQuery = self::query()
            ->whereNotIn('CertNo', function ($query) {
                $query->select('solitaire_cert_no')
                    ->from('ds_order_details')
                    ->where('solitaire_cert_no', '!=', '');
            });

        // Step 1: Fetch relevant diamonds
        $diamonds = $diamondQuery->get()
            ->groupBy(function ($item) {
                return $item->DisplayShape . '-' . $item->Clarity . '-' . $item->DisplayCut . '-' . $item->Color;
            })
            ->toArray();

        // Array to track used diamonds
        $usedDiamonds = [];

        // Step 2: Filter and pair diamonds within the same group
        $pair = [];
        foreach ($diamonds as $group => $diamondGroup) {
            $diamondGroup = collect($diamondGroup)->sortBy('Weight');  // Sort diamonds by weight
            $count = count($diamondGroup);

            for ($i = 0; $i < $count - 1; $i++) {
                $parent = $diamondGroup[$i];

                // Skip this diamond if it's already paired
                // if (in_array($parent['RefNo'], $usedDiamonds)) {
                //     continue;
                // }

                for ($j = $i + 1; $j < $count; $j++) {
                    $child = $diamondGroup[$j];

                    // Skip this diamond if it's already paired
                    // if (in_array($child['RefNo'], $usedDiamonds)) {
                    //     continue;
                    // }

                    // Check pairing criteria
                    if (abs($parent['Weight'] - $child['Weight']) <= 0.1) {
                        // Create the pair
                        $tempPair = [];
                        $tempPair[] = $parent;
                        $tempPair[] = $child;
                        $tempPair['total_price'] = $parent['product_buy_price'] + $child['product_buy_price'];
                        array_push($pair, $tempPair);

                        // Mark both diamonds as used
                        // $usedDiamonds[] = $parent['RefNo'];
                        // $usedDiamonds[] = $child['RefNo'];

                        // Once paired, stop searching for this diamond
                        break;
                    }
                }
            }
        }

        // Step 3: Sort pairs by total price
        usort($pair, function ($a, $b) {
            return $a['total_price'] <=> $b['total_price'];
        });

        // Step 4: Prepare response
        $res = General::success_res();
        $res['data'] = $pair;
        return $res;
    }

    public static function getAllSolitaire()
    {
        $solitaireQuery = self::where('status', 'Available');
        $solitaires = $solitaireQuery->orderBy('product_buy_price','ASC')->get()->toArray();
        $res = \General::success_res();
        $res['data'] = $solitaires;
        return $res;
    }
}
