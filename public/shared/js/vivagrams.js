jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ( $(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
    this.css("left", ( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");
    return this;
}

jQuery.fn.ShowWidePopup = function (content) {
  $("#wide_popup").show();
  $("#wide_popup > .wide_popup > .wide_popup_content").html(content);
  $("#wide_popup").css("position", "absolute");
  $("#wide_popup").css({left: this.offset().left+this.outerWidth()/2-$("#wide_popup").outerWidth()/2, top: this.offset().top+this.outerHeight()});
  return this;
}
jQuery.fn.HideWidePopup = function () {
  $("#wide_popup").hide();
  return this;
}

