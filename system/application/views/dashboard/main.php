<h3>Dashboard</h3>
<? foreach($grams as $gram) {
  echo "Gram: ".$gram["gram_id"]."<br />\n";
  echo $this->load->view('widgets/editgram', array("gram"=>$gram), true);
} ?>