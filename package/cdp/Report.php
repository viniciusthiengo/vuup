<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/ReportData.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Report extends Common {
		private $title;
		private $subTitle;
		private $titleXAxis;
		private $titleYAxis;
		private $labelData;
		private $xAxisLabels;
		private $yAxisLabels;
		private $reportData;
		private $arrayReportData;
		private $data;
		
		
		public function __construct($title='', $subTitle='', $titleXAxis='', $titleYAxis='', $labelData='', $xAxisLabels=array(), $yAxisLabels=array(), $data=array()){
			$this->title = $title;
			$this->subTitle = $subTitle;
			$this->titleXAxis = $titleXAxis;
			$this->titleYAxis = $titleYAxis;
			$this->labelData = $labelData;
			$this->xAxisLabels = $xAxisLabels;
			$this->yAxisLabels = $yAxisLabels;
			$this->reportData = $reportData;
			$this->arrayReportData = $arrayReportData;
			$this->data = $data;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getTitle(){
			return($this->title);
		}
		public function setTitle($title){
			$this->title = $title;
		}
		
		
		public function getSubTitle(){
			return($this->subTitle);
		}
		public function setSubTitle($subTitle){
			$this->subTitle = $subTitle;
		}
		
		
		public function getTitleXAxis(){
			return($this->titleXAxis);
		}
		public function setTitleXAxis($titleXAxis){
			$this->titleXAxis = $titleXAxis;
		}
		
		
		public function getTitleYAxis(){
			return($this->titleYAxis);
		}
		public function setTitleYAxis($titleYAxis){
			$this->titleYAxis = $titleYAxis;
		}
		
		
		public function getLabelData(){
			return($this->labelData);
		}
		public function setLabelData($labelData){
			$this->labelData = $labelData;
		}
		
		
		public function getXAxisLabels(){
			return($this->xAxisLabels);
		}
		public function setXAxisLabels($xAxisLabels){
			$this->xAxisLabels = $xAxisLabels;
		}
		public function generateXAxisLabels(){
			$this->xAxisLabels = array();
			for($i = 1, $tamI = $this->getAmountMonthDays(); $i <= $tamI; $i++){
				$this->xAxisLabels[] = $i;
			}
		}
		public function getAmountMonthDays(){
			$year = date('Y',$this->reportData->getTime());
			$month = (int)date('m',$this->reportData->getTime());
			
			if(preg_match('/^(1|3|5|7|8|10|12){1}$/', $month)){
				return(31);
			}
			else if(preg_match('/^(4|6|9|11){1}$/', $month)){
				return(30);
			}
			else{
				if($year % 4 == 0 && $year % 100 == 0 && $year % 400 == 0){ // LEAP YEAR
					return(29);
				}
				else{
					return(28);
				}
			}
		}
		
		
		public function getYAxisLabels(){
			return($this->yAxisLabels);
		}
		public function setYAxisLabels($yAxisLabels){
			$this->yAxisLabels = $yAxisLabels;
		}
		
		
		public function getReportData(){
			return($this->reportData);
		}
		public function setReportData($reportData){
			$this->reportData = $reportData;
		}
		
		
		public function getArrayReportData(){
			return($this->arrayReportData);
		}
		public function setArrayReportData($arrayReportData){
			$this->arrayReportData = $arrayReportData;
		}
		public function getArrayReportTicketByType(){
			$auxArray = array();
			
			if(count($this->arrayReportData) > 0){
				$ticketDay = $this->arrayReportData[0]->getTicketDay();
				$ticket = $this->arrayReportData[0]->getTicket();
				
				for($i = $j = $c = 0, $tamI = count($this->arrayReportData); $i < $tamI; $i++){
					if($ticketDay->getId() == $this->arrayReportData[$i]->getTicketDay()->getId()
						&& $ticket->getId() == $this->arrayReportData[$i]->getTicket()->getId()){
						
						$auxArray[$j] = is_array($auxArray[$j]) ? $auxArray[$j] : array();
						$auxArray[$j][$c] = $this->arrayReportData[$i];
						$c++;
					}
					else{
						$ticketDay = $this->arrayReportData[$i]->getTicketDay();
						$ticket = $this->arrayReportData[$i]->getTicket();
						
						$j++;
						$c = 0;
						$auxArray[$j] = is_array($auxArray[$j]) ? $auxArray[$j] : array();
						$auxArray[$j][$c] = $this->arrayReportData[$i];
						$c++;
					}
				}
			}
			return($auxArray);
		}
		
		
		public function getData(){
			if(is_array($this->data) && is_object($this->data[0])){
				$aux = array();
				for($i = 0, $tam = count($this->data); $i < $tam; $i++){
					$aux[] = $this->data[$i]->getDataJSON();
				}
				return($aux);
			}
			return($this->data);
		}
		public function setData($data){
			$this->data = $data;
		}
		public function initData($dimensions=1){
			$data = array();
			for($i = 0, $tamI = $this->getAmountMonthDays(); $i < $tamI; $i++){
				$data[$i] = $dimensions == 1 ? 0 : array(''.($i+1), 0);
			}
			return($data);
		}
		public function generateData($dimensions=1, $title=''){
			$this->data = !is_array($this->data) ? array() : $this->data;
			$auxData = $this->initData($dimensions);
			
			for($i = 0, $tamI = $this->getAmountMonthDays(); $i < $tamI; $i++){
				$day = $i + 1;
				$auxTime = mktime(0,0,0,date('m', $this->reportData->getTime()), $day, date('Y', $this->reportData->getTime()));
				for($j = 0, $tamJ = count($this->arrayReportData); $j < $tamJ; $j++){
					if($this->arrayReportData[$j]->getTime() == $auxTime){
						$auxData[$i] = $dimensions == 1 ? (int)$this->arrayReportData[$j]->getAmount() : array(''.($i+1), (int)$this->arrayReportData[$j]->getAmount());
						break;
					}
					else{
						$auxData[$i] = $dimensions == 1 ? 0 : array(''.($i+1), 0);
					}
				}
			}
			
			// IT'S NECESSARY IF THERE IS MORE THAN ONE DATA TO BE DISPLAYED IN THE SAME GRAPH
				$title = empty($title) ? $this->labelData : $title;
				$this->data[] = new ReportData(0, $title, 0, NULL, NULL, NULL, 0, $auxData);
		}
		public function generateDataPie(){
			$auxArray = array();
			
			if(count($this->arrayReportData) > 0){
				$ticketDay = $this->arrayReportData[0]->getTicketDay();
				$ticket = $this->arrayReportData[0]->getTicket();
				
				$title = $ticket->getName().' (';
				$title .= $ticketDay->getDayPage(false).', '.$ticketDay->getDaySeccondsToBrazilDate();
				$title .= ' às '.$ticketDay->getTimeSeccondsToBrazilDate().')';
				
				$auxArray[] = array($title, 0);
				
				for($i = $j = $c = 0, $tamI = count($this->arrayReportData); $i < $tamI; $i++){
					if($ticketDay->getId() == $this->arrayReportData[$i]->getTicketDay()->getId()
						&& $ticket->getId() == $this->arrayReportData[$i]->getTicket()->getId()){
						
						$auxArray[$j][1] += (int)$this->arrayReportData[$i]->getAmount();
					}
					else{
						$ticketDay = $this->arrayReportData[$i]->getTicketDay();
						$ticket = $this->arrayReportData[$i]->getTicket();
						
						$title = $ticket->getName().' (';
						$title .= $ticketDay->getDayPage(false).', '.$ticketDay->getDaySeccondsToBrazilDate();
						$title .= ' às '.$ticketDay->getTimeSeccondsToBrazilDate().')';
						
						$j++;
						$auxArray[$j] = array($title, (int)$this->arrayReportData[$i]->getAmount());
					}
				}
			}
			
			// PIE DATA CHART
				$this->data = $auxArray;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'title'=>		$this->getTitle(),
					'subTitle'=>	$this->getSubTitle(),
					'titleXAxis'=>	$this->getTitleXAxis(),
					'titleYAxis'=>	$this->getTitleYAxis(),
					'labelData'=>	$this->getLabelData(),
					'xAxisLabels'=>	$this->getXAxisLabels(),
					'yAxisLabels'=>	$this->getYAxisLabels(),
					'data'=>		$this->getData());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>