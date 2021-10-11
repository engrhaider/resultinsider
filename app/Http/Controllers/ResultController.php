<?php

namespace App\Http\Controllers;

use App\Models\Mdcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use KubAT\PhpSimple\HtmlDomParser;

class ResultController extends Controller
{
    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function getMdcatResultByRollNoAction(Request $request)
    {

        $response = array('success' => false, 'data' => array());

        try {

            $rollNo = $request->get('roll_no');
            $html = file_get_contents("https://www.pmc.gov.pk/Results/ResultsInfo?rollNo={$rollNo}&session=2021");

            if (strlen($html) > 50) {
                $studentData = array();

                $emailBodyDOMParser = \KubAT\PhpSimple\HtmlDomParser::str_get_html($html);


                if (isset($emailBodyDOMParser->find('h5[id=name]')[0])) {
                    $studentData['rollNo'] = $rollNo;
                    $studentData['name'] = $emailBodyDOMParser->find('h5[id=name]')[0]->innertext;
//                $studentData[] = $emailBodyDOMParser->find('h5[id=cnic]')[0]->innertext;
                    $studentData['marks'] = $emailBodyDOMParser->find('h5[id=omarks]')[0]->innertext;
                    $studentData['remarks'] = ($studentData['marks'] > 136) ? 'PASS' : 'FAIL';

                    $response['success'] = true;
                    $response['data'] = $studentData;
                }


                return $response;

            }
        } catch (Exception $exception) {
            $response['message'] = 'There was an issue fetching the result, please try again';
        }

        return $response;
    }

    public function getMarksDistributionResultAction(Request $request)
    {
        $provincesMapping = array(
            1 => 'Khyber Pukhtoonkhwa',
            2 => 'FATA',
            3 => 'Punjab',
            4 => 'Sindh',
            5 => 'Balochistan',
            6 => 'Islamabad',
            7 => 'Gilgit Baltistan',
        );
        $response = array('success' => false, 'data' => '');

        $marksFrom = $request->get('marks_from', 1);
        $marksTo = $request->get('marks_to', 210);
        $province = $request->get('province', null);

        try {
            $query = Mdcat::query();

            if ($marksFrom != null) {
                $query->where('marks', '>=', $marksFrom);
            } else {
                $marksFrom = 1;
            }

            if ($marksTo != null) {
                $query->where('marks', '<=', $marksTo);
            } else {
                $marksTo = 210;
            }

            if ($province != null && $province != '') {
                $query->where('cnic', 'like', "{$province}%");

                $province = "domiciled in <strong>{$provincesMapping[$province]}</strong>";
            }

            $result = $query->select('id as total_count')->get()->count();

            $response['success'] = true;
            $response['data'] = "<strong>{$result}</strong> students {$province} have secured marks in the <strong>range {$marksFrom} to {$marksTo}</strong>";
        } catch (\Exception $exception) {
            $response['data'] = "Couldn't fetch the result, please try again later!";
        }

        return $response;
    }

    public function getImportResultAction() {
//        $file = public_path('db_import/result.csv');
//
//        $resultsArray = $this->csvToArray($file);
//
//        $noOfRecordsInChunk = 2000;
//
//        $chunks = ceil(count($resultsArray) / $noOfRecordsInChunk);
//
//        $chunkStart = 0;
//        for ($j = 1; $j <= $chunks; $j++ ) {
//            $data = array();
//            $chunkEnd = $chunkStart + $noOfRecordsInChunk;
//            for ($i = $chunkStart; $i < $chunkEnd; $i++)
//            {
//                if (isset($resultsArray[$i])) {
//                    $data[] = [
//                        'roll_no' => $resultsArray[$i]['Roll No'],
//                        'name' => $resultsArray[$i]['Name'],
//                        'cnic' => $resultsArray[$i]['CNIC'],
//                        'marks' => $resultsArray[$i]['Marks']
//                    ];
//                }
//            }
//
//            if (count($data)) {
//                DB::table('mdcats')->insertOrIgnore($data);
//            }
//            $chunkStart += $noOfRecordsInChunk;
//        }

        ini_set('max_execution_time', '0');

        $rollNoFrom = 1000001;
        $rollNoTo = 1250000;

        for ($i = $rollNoFrom; $i <= $rollNoTo; $i++) {
            try {
                $mdcatResult = Mdcat::where('roll_no', '=', $i)->get();

                if ($mdcatResult->isEmpty()) {
                    $html = file_get_contents("https://www.pmc.gov.pk/Results/ResultsInfo?rollNo=$i&session=2021");

                    if (strlen($html) > 50) {
                        $studentData = array();
                        $emailBodyDOMParser = HtmlDomParser::str_get_html($html);

                        if (isset($emailBodyDOMParser->find('h5[id=name]')[0])) {
                            $studentData['roll_no'] = $i;
                            $studentData['name'] = $emailBodyDOMParser->find('h5[id=name]')[0]->innertext;
                            $studentData['cnic'] = $emailBodyDOMParser->find('h5[id=cnic]')[0]->innertext;
                            $studentData['marks'] = $emailBodyDOMParser->find('h5[id=omarks]')[0]->innertext;

                            DB::table('mdcats')->insertOrIgnore($studentData);
                        }

                    }
                }
            } catch (\Exception $exception) {
            }
        }

        echo "all done";
    }

    public function getProvinceMarkdsDistributionAction(Request $request, $province)
    {
        //echo $province;exit;
        $provincesMapping = array(
            'khyber-pukhtoonkhwa' => 1,
            'fata' => 2,
            'punjab' => 3,
            'sindh' => 4,
            'balochistan' => 5,
            'islamabad' => 6,
            'gilgit-baltistan' => 7
        );

        $provincesMappingHumanReadable = array(
            1 => 'Khyber Pukhtoonkhwa',
            2 => 'FATA',
            3 => 'Punjab',
            4 => 'Sindh',
            5 => 'Balochistan',
            6 => 'Islamabad',
            7 => 'Gilgit Baltistan',
        );

        $totalMarks = 210;

        $chunks = $totalMarks / 5;
        $resultSet = array();
        $marksFrom = 1;

        $provinceDetail = '';
        $studentsAppeared = 0;
        $studentsPassed = 0;
        $studentsFailed = 0;

        if (isset($provincesMapping[$province])) {
            for ($i = 1; $i <= $chunks; $i++) {

                $query = Mdcat::query();

                $marksFrom = $marksFrom;
                $marksTo = $marksFrom + 4;

                $query->where('marks', '>=', $marksFrom)
                    ->where('marks', '<=', $marksTo)
                    ->where('cnic', 'like', "{$provincesMapping[$province]}%");

                $range = "$marksFrom - $marksTo";
                $resultSet[$range] = $query->select('id')->get()->count();
                $marksFrom += 5;

                $provinceDetail = $provincesMappingHumanReadable[$provincesMapping[$province]];
            }

            $studentsAppeared = Mdcat::query()->where('cnic', 'like', "{$provincesMapping[$province]}%")->get()->count();
            $studentsPassed = Mdcat::query()->where('marks', '>', 136)->where('cnic', 'like', "{$provincesMapping[$province]}%")->get()->count();
            $studentsFailed = $studentsAppeared - $studentsPassed;
        }

        $resultSet = array_reverse($resultSet);

        return view('mdcat.provincial-analysis', array(
            'resultSet' => $resultSet,
            'province' => $provinceDetail,
            'appeared' => $studentsAppeared,
            'passed' => $studentsPassed,
            'fail' => $studentsFailed
        ));
    }
}
