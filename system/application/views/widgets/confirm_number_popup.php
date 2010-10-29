  <div id="confirm_message" style="display: none;">
  <?
  $vivagrams_number = vivagrams_number();
  $str = <<<endpopup
  <a href="#" class="deletebutton confirm_popup_close" style="float: right;" title="Close Popup"><img src="/public/images/x.gif" alt="Close" /></a>
  <h3>Confirm Your Number</h3>
  <p>
    Text the word <strong>GO</strong> to <strong>{$vivagrams_number}</strong>
  </p>
  <p>
    Wait a few moments, and then refresh this page. Once your number is confirmed, you can enabled notifications!
  </p>
endpopup;
  echo $this->load->view('widgets/popup', array("content"=>$str), true);
  ?>
  </div>
  <script>
  function OpenConfirmPopup(e) {
    e.preventDefault();
    $('#confirm_message').show();
    $('#confirm_message').center();
  }
  function CloseConfirmPopup(e) {
    e.preventDefault();
    $('#confirm_message').hide();
  }
  $(".confirm_popup_close").click(CloseConfirmPopup);
  </script>
