<?php

namespace App\Http\Controllers;

use App\PaymentsClass;
use View;

class PaymentsController extends Controller
{
    /**
     *
     * @var PaymentsClass
     */
    private $pc;

    public function __construct() {
        $this->pc = new PaymentsClass();
    }
    
    /**
     * 
     * @param int $id
     * @return View|\Illuminate\View\View
     */
    public function showOne($id) {
        $accountClient = $this->pc->getAccountClientFromID($id);
        $account = $accountClient['cuenta'];
        $client = $accountClient['cliente'];
        $payments = $this->pc->listPayments($id);
        $view = view('pagos')
        ->with('cuenta', $account)
        ->with('cliente', $client)
        ->with('pagos', $payments);
        return $view;
    }
    
    /**
     * 
     * @return View
     */
    public function summary() {
        $resultNow = $this->pc->summaryThisMonth();
        $resultNowAgent = $this->pc->byAgentThisMonth();
        $resultNowDetails = $this->pc->detailsThisMonth();
        $resultPrev = $this->pc->summaryLastMonth();
        $resultPrevAgent = $this->pc->byAgentLastMonth();
        $resultPrevDetails = $this->pc->detailsLastMonth();
        /** @var View $view */
        $view = view('pagosum');
        $view = $view->with('resultAct', $resultNow)
        ->with('resultActGest', $resultNowAgent)
        ->with('resultActDet', $resultNowDetails)
        ->with('resultPrev', $resultPrev)
        ->with('resultPrevGest', $resultPrevAgent)
        ->with('resultPrevDet', $resultPrevDetails);
        return $view;
    }
}
