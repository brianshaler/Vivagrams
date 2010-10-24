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
  <? echo "<pre>" . print_r($gram, true) . "</pre>"; ?>
  I want to <input type="text" id="gram_<?=$gram_id?>_message" /> at 
  <select id="gram_<?=$gram_id?>_hour" name="gram_<?=$gram_id?>_hour">
    <?
    //$midnight = strtotime(date("n/j/Y", time()));
    for ($i=0; $i<12; $i++)
    {
      echo "<option value=\"" . $i . "\">" . ($i==0 ? 12 : $i) . "</option>\n";
    }
    ?>
  </select>
  <select id="gram_<?=$gram_id?>_minute" name="gram_<?=$gram_id?>_minute">
    <?
    //$midnight = strtotime(date("n/j/Y", time()));
    $interval = 15;
    for ($i=0; $i<60; $i+=$interval)
    {
      echo "<option value=\"" . pad_zero($i, 2) . "\"".().">" . pad_zero($i, 2) . "</option>\n";
    }
    ?>
  </select>
  <select id="gram_<?=$gram_id?>_ampm" name="gram_<?=$gram_id?>_ampm">
    <option value="am">am</option>
    <option value="pm">pm</option>
  </select>
  <script>
  
  function UpdateGram<?=$gram_id?> () {
    message = $("#gram_<?=$gram_id?>_message").val();
    time = $("#gram_<?=$gram_id?>_hour").val() + ":" + $("#gram_<?=$gram_id?>_minute").val() + $("#gram_<?=$gram_id?>_ampm").val();
    console.log("message: "+message+"; time: "+time);
    
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