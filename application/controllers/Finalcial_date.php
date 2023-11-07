<?php
function calculateFiscalYearForDate($month)
{
	if($month > 4)
	{
		$y = date('Y');
		$pt = date('Y', strtotime('+1 year'));
		$fy = $y."/04/01".",".$pt."/03/31";
	}
	else
	{
		$y = date('Y', strtotime('-1 year'));
		$pt = date('Y');
		$fy = $y."/04/01".",".$pt."/03/31";
	}
	return $fy;
}
?>