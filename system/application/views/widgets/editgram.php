<?
$gram_id = $gram["gram_id"];
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
  I want to <input type="text" value="<?=$gram["message"]?>" id="gram_<?=$gram_id?>_message" /> at 
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
  <a href="#" onclick="return DeleteGram<?=$gram_id?>();" style="float: right;"><img src="/public/images/x.gif" border=0 /></a>
  <script>
  
  function DeleteGram<?=$gram_id?> () {
    $.post("/api/gram/delete/<?=$gram_id?>", null,
       function(data){
         console.log("Deleted. "+data);
         $("#div_gram<?=$gram_id?>").remove();
       });
    return false;
  }
  function UpdateGram<?=$gram_id?> () {
    message = $("#gram_<?=$gram_id?>_message").val();
    time = $("#gram_<?=$gram_id?>_hour").val() + ":" + $("#gram_<?=$gram_id?>_minute").val() + $("#gram_<?=$gram_id?>_ampm").val();
    if (console) console.log("message: "+message+"; time: "+time);
    
    $.post("/api/gram/update/<?=$gram_id?>", { message: message, time_of_day: time},
       function(data){
         console.log("Saved. "+data);
       });
  }
  $('#gram_<?=$gram_id?>_hour').change(UpdateGram<?=$gram_id?>);
  $('#gram_<?=$gram_id?>_minute').change(UpdateGram<?=$gram_id?>);
  $('#gram_<?=$gram_id?>_ampm').change(UpdateGram<?=$gram_id?>);
  $('#gram_<?=$gram_id?>_message').keyup(UpdateGram<?=$gram_id?>);
  
  </script>
</div>