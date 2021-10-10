<?php

namespace App\Http\Controllers;

use App\Models\Mdcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            7 => 'Gilgit Baltitstan',
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

                $province = "domiciled in <strong>{$provincesMapping[$province]}</strong>.";
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
        $file = public_path('db_import/result.csv');

        $resultsArray = $this->csvToArray($file);


        $chunks = ceil(count($resultsArray) / 2000);

        $chunkStart = 1;
        for ($j = 1; $j <= $chunks; $j++ ) {
            $data = array();
            $chunkEnd = $chunkStart + 2000;
            for ($i = $chunkStart; $i < $chunkEnd; $i++)
            {
                $data[] = [
                    'roll_no' => $resultsArray[$i]['Roll No'],
                    'name' => $resultsArray[$i]['Name'],
                    'cnic' => $resultsArray[$i]['CNIC'],
                    'marks' => $resultsArray[$i]['Marks']
                ];
            }
            DB::table('mdcats')->insertOrIgnore($data);
            $chunkStart += 2000;
        }

        return 'Jobi done or what ever';
    }
}
