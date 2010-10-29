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
#create_gram_popup a {
  text-decoration: none;
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
<a href="#" onclick="return ($('#create_gram_popup').hide() === false);" class="deletebutton" style="float: right;" title="Close Popup"><img src="/public/images/x.gif" alt="Close" /></a>
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
function CreateGram ()
{
  $("#create_gram_popup").show();
  $("#create_gram_popup").center();
  return false;
  $.post("/api/gram/create/", null,
     function(data){
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       newid = $("#div_gramtmp .gram_id").html();
       newdiv.attr("id", "div_gram"+newid);
       $("#gram_"+newid+"_hour").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_minute").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_ampm").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").keyup(eval("UpdateGramText"+newid));
       $("#gram_"+newid+"_message").change(eval("UpdateGramText"+newid));
       $("#gram_"+newid+"_message").focus();
     });
  return false;
}
function CreateBooleanGram ()
{
  $.post("/api/gram/create/boolean", null,
     function(data){
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       newid = $("#div_gramtmp .gram_id").html();
       newdiv.attr("id", "div_gram"+newid);
       $("#gram_"+newid+"_hour").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_minute").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_ampm").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").keyup(eval("UpdateGramText"+newid));
       $("#gram_"+newid+"_message").change(eval("UpdateGramText"+newid));
       $("#gram_"+newid+"_message").focus();
       $("#create_gram_popup").hide();
     });
  return false;
}
function CreateAmountGram ()
{
  $.post("/api/gram/create/amount", null,
     function(data){
       newdiv = $("<div>");
       newdiv.html(data);
       newdiv.attr("id", "div_gramtmp");
       $("#gramholder").append(newdiv);
       newid = $("#div_gramtmp .gram_id").html();
       newdiv.attr("id", "div_gram"+newid);
       $("#gram_"+newid+"_hour").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_minute").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_ampm").change(eval("UpdateGram"+newid));
       $("#gram_"+newid+"_message").keyup(eval("UpdateGramText"+newid));
       $("#gram_"+newid+"_message").change(eval("UpdateGramText"+newid));
       $("#gram_"+newid+"_message").focus();
       $("#create_gram_popup").hide();
     });
  return false;
}
</script>
<p class="footnote">Note: No need to press Save! Your changes are saved as you make them.</p>
<? if (isset($first_use) && $first_use == true) { ?>
  <div id="welcome_message" style="display: none;">
  <?
  $str = <<<endpopup
  <a href="#" onclick="return CloseWelcomePopup();" class="deletebutton" style="float: right;" title="Close Popup"><img src="/public/images/x.gif" alt="Close" /></a>
  <h3>Welcome to Vivagrams!</h3>
  <p>
    Welcome message...
  </p>
endpopup;
  echo $this->load->view('widgets/popup', array("content"=>$str), true);
  ?>
  </div>
  <script>
  $('#welcome_message').show();
  $('#welcome_message').center();
  function CloseWelcomePopup() {
    $('#welcome_message').hide();
    $.post("/api/user/dismiss_welcome");
  }
  </script>
<? } ?>
</div>
</div>
