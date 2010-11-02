  <div id="welcome_message" style="display: none;">
  <?
  $str = <<<endpopup
  <a href="#" class="deletebutton welcome_popup_close" style="float: right;" title="Close Popup"><img src="/public/images/x.gif" alt="Close" /></a>
  <h3>Welcome to Vivagrams!</h3>
  <p>
    With our simple plan builder, you can have Vivagrams ask you simple questions throughout the day.
  </p>
  <p>
    You don't have to go out of your way to save your results.
    We will ask you the questions in your plan at the requested times, and all you have to do is respond with a short answer.
  </p>
  <p>
    You will then be able to view your Reports. How consistant are you?
    Are you making progress on your dieting or work-out goals? How do you feel throughout the day and week?
  </p>
  <p>
    Vivagrams makes it easier than ever to track and monitor your daily habits!
  </p>
endpopup;
  echo $this->load->view('widgets/popup', array("content"=>$str), true);
  ?>
  </div>
  <script>
  function OpenWelcomePopup() {
    $('#welcome_message').show();
    $('#welcome_message').center();
  }
  function CloseWelcomePopup(e) {
    e.preventDefault();
    $('#welcome_message').hide();
    $.post("/api/user/dismiss_welcome");
  }
  OpenWelcomePopup();
  $(".welcome_popup_close").click(CloseWelcomePopup);
  </script>
