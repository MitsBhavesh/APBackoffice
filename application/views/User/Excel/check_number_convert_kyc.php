<?php
function check_num_con($amount_type)
{
  if($amount_type >= 0)
  {
    $type = " CR";
    return "<span style='color:#2f8ac6'>".number_format((float)$amount_type, 2, '.', ',').$type."</span>";
  }
  else
  {
    $type = " DR";
    $amount_type = Abs($amount_type);
    return "<span style='color:#b53030'>".number_format((float)$amount_type, 2, '.', ',').$type."</span>";
  }
}

function Ledger_balance($yestarday_balance)
{
  if($yestarday_balance >= 0)
  {
    $type = " DR";
    return "<span style='color:#b53030'>".number_format((float)$yestarday_balance, 2, '.', ',').$type."</sapn>";
  }
  else
  {
    $type = " CR";
    $yestarday_balance = Abs($yestarday_balance);
    return "<span style='color:#2f8ac6'>".number_format((float)$yestarday_balance, 2, '.', ',').$type."</span>";
  }
}

// function check_num($amount_type)
// {
//   if($amount_type >= 0)
//   {
//     return " CR";
//   }
//   else
//   {
//     return " DR";
//   }
// }
?>