<?
$gram_id = $gram["gram_id"];
$response_type = $gram["response_type"];
if (!function_exists("pad_zero"))
{
  function pad_zero($val, $cnt)
  {
    $str = $val . "";
    while (strlen($str) < $cnt)
    {
      $str = "0" . $str;
    }
    return $str;
  }
}
?>
<div class="gram">
  <div style="display: none;" class="gram_id"><?=$gram["gram_id"]?></div>
  <div class="gram_message">
    <? if ($response_type == "boolean") { ?>
    I want to <input type="text" value="<?=$gram["message"]?>" id="gram_<?=$gram_id?>_message" name="gram_<?=$gram_id?>_message" class="gram_boolean" /> at 
    <? } else { ?>
    Ask me: <input type="text" value="<?=$gram["message"]?>" id="gram_<?=$gram_id?>_message" name="gram_<?=$gram_id?>_message" class="gram_amount" /> at 
    <? } ?>
    <select id="gram_<?=$gram_id?>_hour" name="gram_<?=$gram_id?>_hour">
      <?
      $hours = floor($gram["time_of_day"]/3600);
      $minutes = floor(($gram["time_of_day"]-$hours*3600)/60);
      $ampm = $hours < 12 ? "am" : "pm";
      $hours = $hours < 12 ? $hours : $hours - 12;
      $hours = $hours == 0 ? 12 : $hours;
    
      //$midnight = strtotime(date("n/j/Y", time()));
      for ($i=0; $i<12; $i++)
      {
        echo "<option value=\"" . $i . "\"".($i == $hours ? " selected" : "").">" . ($i==0 ? 12 : $i) . "</option>\n";
      }
      ?>
    </select>
    <select id="gram_<?=$gram_id?>_minute" name="gram_<?=$gram_id?>_minute">
      <?
      //$midnight = strtotime(date("n/j/Y", time()));
      $interval = 15;
      for ($i=0; $i<60; $i+=$interval)
      {
        echo "<option value=\"" . pad_zero($i, 2) . "\"".($i == $minutes ? " selected" : "").">" . pad_zero($i, 2) . "</option>\n";
      }
      ?>
    </select>
    <select id="gram_<?=$gram_id?>_ampm" name="gram_<?=$gram_id?>_ampm">
      <option value="am"<? echo ($ampm == "am" ? " selected" : "") ?>>am</option>
      <option value="pm"<? echo ($ampm == "pm" ? " selected" : "") ?>>pm</option>
    </select>
  </div>
  <a href="#" onclick="return DeleteGram<?=$gram_id?>();" class="deletebutton" title="Delete this gram"><img src="/public/images/x.gif" alt="Delete" /></a>
    
  <script>
  
  function DeleteGram<?=$gram_id?> () {
    $.post("/api/gram/delete/<?=$gram_id?>", null,
       function(data){
         $("#div_gram<?=$gram_id?>").remove();
       });
    return false;
  }
  // Each keystroke adds an element to an array which gets removed after a delay
  // When the last one is removed, the Gram will be autosaved
  autosave_delay<?=$gram_id?> = [];
  function UpdateGramText<?=$gram_id?> () {
    autosave_delay<?=$gram_id?>.push(1);
    setTimeout(CheckQueue<?=$gram_id?>, 700);
  }
  function CheckQueue<?=$gram_id?> () {
    autosave_delay<?=$gram_id?>.pop();
    if (autosave_delay<?=$gram_id?>.length == 0)
    {
      UpdateGram<?=$gram_id?>();
    }
  }
  function UpdateGram<?=$gram_id?> () {
    message = $("#gram_<?=$gram_id?>_message").val();
    time = $("#gram_<?=$gram_id?>_hour").val() + ":" + $("#gram_<?=$gram_id?>_minute").val() + $("#gram_<?=$gram_id?>_ampm").val();
    
    $.post("/api/gram/update/<?=$gram_id?>", { message: message, time_of_day: time},
       function(data){
       });
  }
  function GramPopup<?=$gram_id?>() {
    var strContent = "<? if ($response_type == "boolean") { 
      ?><span class=\"CronosProBold\">Vivagrams will send you:</span><br /><p>&nbsp;&nbsp;&nbsp;<em>\"Did you <u>{message}</u>\"</em></span></p><span class=\"CronosProBold\">And you'll respond with a yes/no answer:</span><br /><p style=\"margin-bottom: 0px\">&nbsp;&nbsp;&nbsp;<em>\"Yes\"</em> or <em>\"no\"</em> or <em>\"y\"</em> etc.</p><? 
      } else {
        ?><span class=\"CronosProBold\">Vivagrams will send you:</span><br /><p>&nbsp;&nbsp;&nbsp;<em>\"<u>{message}</u></em>\"</em></span></p><span class=\"CronosProBold\">And you'll respond with a number:</span><br /><p style=\"margin-bottom: 0px\">&nbsp;&nbsp;&nbsp;<em>\"8\"</em> or <em>\"1.5\"</em> etc.<?
      } ?>";
    var msg = $("#gram_<?=$gram_id?>_message").val();
    if (msg.charAt(msg.length-1) != "?") { msg += "?"; }
    strContent = strContent.replace("{message}", msg);
    strContent += "<div style=\"clear: both; height: 1px;\"><!-- --></div>";
    $("#gram_<?=$gram_id?>_message").ShowWidePopup(strContent);
  }
  function InitGram<?=$gram_id?>() {
    $('#gram_<?=$gram_id?>_message').keyup(GramPopup<?=$gram_id?>);
    $('#gram_<?=$gram_id?>_message').focus(GramPopup<?=$gram_id?>);
    $('#gram_<?=$gram_id?>_message').blur(function () { $("#gram_<?=$gram_id?>_message").HideWidePopup(); });
    $('#gram_<?=$gram_id?>_hour').change(UpdateGram<?=$gram_id?>);
    $('#gram_<?=$gram_id?>_minute').change(UpdateGram<?=$gram_id?>);
    $('#gram_<?=$gram_id?>_ampm').change(UpdateGram<?=$gram_id?>);
    $('#gram_<?=$gram_id?>_message').keyup(UpdateGramText<?=$gram_id?>);
    $('#gram_<?=$gram_id?>_message').change(UpdateGramText<?=$gram_id?>);
  }
  InitGram<?=$gram_id?>();
  </script>
</div>