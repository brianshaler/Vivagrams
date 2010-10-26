<div class="wrapper wrappercontent">
<div class="content">
<h2 class="CronosProBold">Reports</h2>
<p>Awesome graphs coming soon!</p>
<br />&nbsp;

<style>
.superawesometable {
  border: solid 1px #7D7D7D;
}
.superawesometable td {
  padding: 3px 6px;
  border: solid 1px #999999;
}
</style>
<table class="superawesometable">
  <tr>
    <td colspan=2>
      Message
    </td>
    <td colspan=2>
      Response
    </td>
  </tr>
  <? array_reverse($messages); foreach ($messages as $message) { ?>
  <tr>
    <td>
      <?=$message["sent"]?>
    </td>
    <td>
      <?=$message["message"]?>
    </td>
    <td>
      <?=$message["response"]?>
    </td>
    <td>
      <?=$message["response_text"]?>
    </td>
  </tr>
  <? } ?>
</table>
</div>
</div>