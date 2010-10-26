<div class="wrapper wrappercontent">
<div class="content">
<h2 class="CronosProBold">Current Plan</h2>
<div id="gramholder">
<? foreach($grams as $gram) {
  echo "<div id=\"div_gram".$gram["gram_id"]."\">" . $this->load->view('widgets/editgram', array("gram"=>$gram), true) . "</div>";
} ?>
</div>
<style>
#create_gram_popup .example {
  font-size: 75%;
  color: #7D7D7D;
  line-height: 1.3em;
}
#create_gram_popup a:link, #create_gram_popup a:active, #create_gram_popup a:visited {
  text-decoration: none;
}
#create_gram_popup a:hover {
  text-decoration: underline;
}
#create_gram_popup .select_div {
  float: left;
  width: 75px;
  padding-top: 4px;
}
#create_gram_popup .text_div {
  float: left; width: 270px;
}
#create_gram_popup strong {
  color: #4D4D4D;
}

</style>
<div id="create_gram_popup" style="display: none;">
<?
$base_url = base_url();
$str = <<<endpopup
<h3>What are we tracking?</h3>
<p>
  <div class="select_div">
    <a href="#" onclick="return CreateAmountGram();"><img src="{$base_url}public/images/selectbutton.png" /></a>
  </div>
  <div class="text_div">
    <a href="#" onclick="return CreateAmountGram();"><strong>Amount - Track progress over time</strong></a>
    <br />
    <a href="#" onclick="return CreateAmountGram();"><span class="example">Vivagram: “How much do you weigh right now?”<br />
    Response: “195 lbs”</span></a>
  </div>
</p>
<p style="clear: left;">
  <div class="select_div">
    <a href="#" onclick="return CreateBooleanGram();"><img src="{$base_url}public/images/selectbutton.png" /></a>
  </div>
  <div class="text_div">
    <a href="#" onclick="return CreateBooleanGram();"><strong>Completion - Day-to-Day Consistency</strong></a>
    <br />
    <a href="#" onclick="return CreateBooleanGram();"><span class="example">Vivagram: “Did you go for a run?”<br />
    Response: “Yes”</span></a>
  </div>
</p>
endpopup;
echo $this->load->view('widgets/popup', array("content"=>$str), true);
?>
</div>
<p style="margin: 10px 0px 20px;">
  <a href="#" onclick="return CreateGram();" title="Add new gram"><img src="<?=base_url()?>public/images/addnew.png" alt="Add new gram" /></a>
</p>
<script>
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ( $(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
    this.css("left", ( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");
    return this;
}

function CreateGram ()
{
  $("#create_gram_popup").show();
  $("#create_gram_popup").center();
  return false;
  $.post("/api/gram/create/", null,
     function(data){
       //console.log("Created. "+data);
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       //console.log($("#div_gramtmp > .gram_id"));
       newid = $("#div_gramtmp .gram_id").html();
       newdiv.attr("id", "div_gram"+newid);
       $("#gram_"+newid+"_hour").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_minute").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_ampm").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").keyup(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").focus();
     });
  return false;
}
function CreateBooleanGram ()
{
  $.post("/api/gram/create/boolean", null,
     function(data){
       //console.log("Created. "+data);
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       //console.log($("#div_gramtmp > .gram_id"));
       newid = $("#div_gramtmp .gram_id").html();
       newdiv.attr("id", "div_gram"+newid);
       $("#gram_"+newid+"_hour").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_minute").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_ampm").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").keyup(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").focus();
       $("#create_gram_popup").hide();
     });
  return false;
}
function CreateAmountGram ()
{
  $.post("/api/gram/create/amount", null,
     function(data){
       //console.log("Created. "+data);
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       //console.log($("#div_gramtmp > .gram_id"));
       newid = $("#div_gramtmp .gram_id").html();
       newdiv.attr("id", "div_gram"+newid);
       $("#gram_"+newid+"_hour").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_minute").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_ampm").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").keyup(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").focus();
       $("#create_gram_popup").hide();
     });
  return false;
}
</script>
<p class="footnote">Note: No need to press Save! Your changes are saved as you make them.</p>
</div>
</div>
