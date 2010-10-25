<h3>Dashboard</h3>
<div id="gramholder">
<? foreach($grams as $gram) {
  echo "<div id=\"div_gram".$gram["gram_id"]."\">" . $this->load->view('widgets/editgram', array("gram"=>$gram), true) . "</div>";
} ?>
</div>
<a href="#" onclick="return CreateGram();">Add new gram</a>
<script>
function CreateGram ()
{
  $.post("/api/gram/create/", null,
     function(data){
       console.log("Created. "+data);
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       console.log($("#div_gramtmp > .gram_id"));
       newdiv.attr("id", "div_gram"+$("#div_gramtmp .gram_id").html());
     });
  return false;
}
</script>