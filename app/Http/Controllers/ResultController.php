<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
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
        if (!$request->isMethod('POST'))
            return redirect('/');
    }
}
